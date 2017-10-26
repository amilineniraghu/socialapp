<?php

require_once "gpConfig.php";
if(isset($_GET['code'])){
    $token = $gClient->fetchAccessTokenwithAuthCode($_GET['code']);
    $_SESSION['access_token'] = $token;
}

if (isset($_SESSION['access_token'])) {
    $gClient->setAccessToken($_SESSION['access_token']);
}

$oAuth = new Google_Service_Oauth2($gClient);
$gpUserProfile = $oAuth->userinfo_v2_me->get();

//Insert or update user data to the database
$gpUserData = array(
    'oauth_provider'=> 'google',
    'oauth_uid'     => $gpUserProfile['id'],
    'first_name'    => $gpUserProfile['given_name'],
    'last_name'     => $gpUserProfile['family_name'],
    'email'         => $gpUserProfile['email'],
    'gender'        => $gpUserProfile['gender'],
    'locale'        => $gpUserProfile['locale'],
    'picture'       => $gpUserProfile['picture'],
    'link'          => $gpUserProfile['link']
);

 # save the user nformation in session variable
 $_SESSION['oauth_provider'] = "google";
 $_SESSION['oauth_uid'] = $gpUserProfile['id'];
 $_SESSION['email'] = $gpUserProfile['email'];
 $_SESSION['picture'] = "<img src='".$gpUserProfile['picture']."' class='img-fluid rounded-circle z-depth-0' height='42' width='42'/>";
 $_SESSION['first_name'] = $gpUserProfile['given_name'];
 $_SESSION['last_name'] = $gpUserProfile['family_name'];
 $_SESSION['gender'] = $gpUserProfile['gender'];
 $_SESSION['locale'] =$gpUserProfile['locale'];
 $_SESSION['link'] = $gpUserProfile['link'];

// check if user exists in the database
          // if user exists in the data base then need not add new record
          $service_url = "http://localhost/socialapp/public/api/users/google/" .$gpUserData['oauth_uid'];
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

          if (empty($decoded))
          {
              //next example will insert new conversation
            $service_url = 'http://localhost/socialapp/public/api/users/add';
            $curl = curl_init($service_url);
            $curl_post_data = array(
                    'email' => $gpUserData['email'],
                    'first_name' => $gpUserData['first_name'],
                    'last_name' => $gpUserData['last_name'],
                    'hybridauth_provider_name' => 'google',
                    'hybridauth_provider_uid' => $gpUserData['oauth_uid'],
            );
            var_dump($curl_post_data);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $curl_post_data);
            $curl_response = curl_exec($curl);
            var_dump( $curl_response);
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
          }

            // User is logged in with a long-lived access token.
            // You can redirect them to a members-only page.
            header('Location: http://localhost/socialapp/public/home.php');
?>