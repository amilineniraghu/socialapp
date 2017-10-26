<?php
// Remove access token from session
unset($_SESSION['facebook_access_token']);

// Redirect to the homepage
header("Location:login.php");
?>