<?php
    $fb = new Facebook\Facebook([
        'app_id' => '1159169104466589', 
        'app_secret' => '6e110cd63134279282bb452d7a7908e0',
        'default_graph_version' => 'v4.0',
        ]);
    
    $helper = $fb->getRedirectLoginHelper();
    
    $permissions = ['email']; // Optional permissions
    $loginUrl = $helper->getLoginUrl(URL.'/User/facebookLogin', $permissions);
?>