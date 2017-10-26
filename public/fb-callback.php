<?php
    if(!session_id()) {
      session_start();
    }

    require_once '../vendor/facebook/graph-sdk/src/Facebook/autoload.php';

    $fb = new Facebook\Facebook([
        'app_id' => '1740475666257031', // Replace {app-id} with your app id
        'app_secret' => '7f9b272bcfbc372d00f071c967ea8be3',
        'default_graph_version' => 'v2.2',
        ]);

    $helper = $fb->getRedirectLoginHelper();

    try {
      $accessToken = $helper->getAccessToken();
    } catch(Facebook\Exceptions\FacebookResponseException $e) {
      // When Graph returns an error
      echo 'Graph returned an error: ' . $e->getMessage();
      exit;
    } catch(Facebook\Exceptions\FacebookSDKException $e) {
      // When validation fails or other local issues
      echo 'Facebook SDK returned an error: ' . $e->getMessage();
      exit;
    }

    if (! isset($accessToken)) {
      if ($helper->getError()) {
        header('HTTP/1.0 401 Unauthorized');
        echo "Error: " . $helper->getError() . "\n";
        echo "Error Code: " . $helper->getErrorCode() . "\n";
        echo "Error Reason: " . $helper->getErrorReason() . "\n";
        echo "Error Description: " . $helper->getErrorDescription() . "\n";
      } else {
        header('HTTP/1.0 400 Bad Request');
        echo 'Bad request';
      }
      exit;
    }

    // Logged in
    //echo '<h3>Access Token</h3>';
    //var_dump($accessToken->getValue());

    // The OAuth 2.0 client handler helps us manage access tokens
    $oAuth2Client = $fb->getOAuth2Client();

    // Get the access token metadata from /debug_token
    $tokenMetadata = $oAuth2Client->debugToken($accessToken);
    //echo '<h3>Metadata</h3>';
    //var_dump($tokenMetadata);

    // Validation (these will throw FacebookSDKException's when they fail)
    $tokenMetadata->validateAppId('1740475666257031'); // Replace {app-id} with your app id
    // If you know the user ID this access token belongs to, you can validate it here
    //$tokenMetadata->validateUserId('123');
    $tokenMetadata->validateExpiration();

    if (! $accessToken->isLongLived()) {
      // Exchanges a short-lived access token for a long-lived one
      try {
        $accessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);
      } catch (Facebook\Exceptions\FacebookSDKException $e) {
        echo "<p>Error getting long-lived access token: " . $helper->getMessage() . "</p>\n\n";
        exit;
      }
    }
    try {
          $profile_request = $fb->get('/me?fields=name,first_name,last_name,email', $accessToken);
          $requestPicture = $fb->get('/me/picture?redirect=false&height=100', $accessToken); //getting user picture
          $picture = $requestPicture->getGraphUser();
          $profile = $profile_request->getGraphUser();
          $fbid = $profile->getProperty('id');
          $fbfullname = $profile->getProperty('name');
          $fbemail = $profile->getProperty('email');
          $fbfirstname = $profile->getProperty('first_name');
          $fblastname = $profile->getProperty('last_name');
          $fbgender = $profile->getProperty('gender');
          $fblocale = $profile->getProperty('locale');
          $fblink = $profile->getProperty('link');
          $fbpic = "<img src='".$picture['url']."' class='img-fluid rounded-circle z-depth-0' height='42' width='42'/>";
          
          # save the user nformation in session variable
          $_SESSION['oauth_uid'] = $fbid;
          $_SESSION['oauth_provider'] = "facebook";
          $_SESSION['fb_name'] = $fbfullname.'</br>';
          $_SESSION['fb_email'] = $fbemail.'</br>';
          $_SESSION['picture'] = $fbpic;
          $_SESSION['fb_firstname'] = $fbfirstname.'</br>';
          $_SESSION['fb_lastname'] = $fblastname.'</br>';
          $_SESSION['fb_gender'] = $fbgender.'</br>';
          $_SESSION['fb_locale'] = $fblocale.'</br>';
          $_SESSION['fb_link'] = $fblink.'</br>';
          

          // check if user exists in the database
          // if user exists in the data base then need not add new record
          $service_url = "http://localhost/socialapp/public/api/users/facebook/" ."'$fbid'";
          //$service_url = "http://localhost/socialapp/public/api/users";
          $curl = curl_init($service_url);
          curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
          $curl_response = curl_exec($curl);

          if ($curl_response === false) {
              $info = curl_getinfo($curl);
              curl_close($curl);
              die('error occured during curl exec. Additioanl info: ' . var_export($info));
          }
          curl_close($curl);
          $decoded = json_decode($curl_response);
          if (isset($decoded->response->status) && $decoded->response->status == 'ERROR') {
              die('error occured: ' . $decoded->response->errormessage);
          }
          echo '<pre>'; print_r($decoded); echo '</pre>';
          
          if (empty($decoded))
          {
              //next example will insert new conversation
            $service_url = 'http://localhost/socialapp/public/api/users/add';
            $curl = curl_init($service_url);
            $curl_post_data = array(
                    'email' => $fbemail,
                    'first_name' => $fbfirstname,
                    'last_name' => $fblastname,
                    'hybridauth_provider_name' => 'facebook',
                    'hybridauth_provider_uid' => $fbid,
            );
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $curl_post_data);
            $curl_response = curl_exec($curl);
            if ($curl_response === false) {
                $info = curl_getinfo($curl);
                curl_close($curl);
                die('error occured during curl exec. Additioanl info: ' . var_export($info));
            }
            curl_close($curl);
            $decoded = json_decode($curl_response);
            if (isset($decoded->response->status) && $decoded->response->status == 'ERROR') {
                die('error occured: ' . $decoded->response->errormessage);
            }
            echo 'response ok!';
            echo 'empty';
          }

          // If user not existing in the database insert new record
  } catch(Facebook\Exceptions\FacebookResponseException $e) {
  
  // When Graph returns an error
    echo 'Graph returned an error: ' . $e->getMessage();
    session_destroy();
    // redirecting user back to app login page
    header("Location: ./");
    exit;
    } catch(Facebook\Exceptions\FacebookSDKException $e) {
     // When validation fails or other local issues
    echo 'Facebook SDK returned an error: ' . $e->getMessage();
    exit;
    }

$_SESSION['fb_access_token'] = (string) $accessToken;

// User is logged in with a long-lived access token.
// You can redirect them to a members-only page.
header('Location: http://localhost/socialapp/public/home.php');
?>