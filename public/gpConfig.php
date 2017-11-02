<?php
if(!session_id()) {
    session_start();
 }

//Include Google client library 
require_once '../vendor/autoload.php';

/*
 * Configuration and setup Google API
 */
$clientId = '33713521143-3srbgn8vf3e6ntcfihnopnehrh5jie25.apps.googleusercontent.com';
$clientSecret = 'tqOt8Dg67gkxQFi-7ZYRFSUH';
$redirectURL = 'http://localhost/socialapp/public/google-callback.php';

//Call Google API
$gClient = new Google_Client();
$gClient->setApplicationName('Login to CodexWorld.com');
$gClient->setClientId($clientId);
$gClient->setClientSecret($clientSecret);
$gClient->setRedirectUri($redirectURL);
$gClient->addScope(Google_Service_Oauth2::USERINFO_PROFILE);
$gClient->addScope(Google_Service_Oauth2::USERINFO_EMAIL);
$loginGoogleURL = $gClient->createAuthUrl();

?>