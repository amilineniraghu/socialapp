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
  
  $permissions = ['email']; // Optional permissions
  $loginUrl = $helper->getLoginUrl('http://localhost/socialapp/public/fb-callback.php', $permissions);
 
?>
