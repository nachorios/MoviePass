<?php
    $fb = new Facebook\Facebook([
        'app_id' => '2550344978530540', 
        'app_secret' => '6cecedabf07875edab72ddec8cdf7e50',
        'default_graph_version' => 'v4.0',
        ]);
    
    $helper = $fb->getRedirectLoginHelper();
    
    $permissions = ['email']; // Optional permissions
    $loginUrl = $helper->getLoginUrl(URL.'/User/facebookLogin', $permissions);
?>