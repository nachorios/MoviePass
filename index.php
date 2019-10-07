<?php
    require "Config/Autoload.php";
    require "Config/Config.php";

    use Config\Autoload as Autoload;
    Autoload::start();
    
    $var = new Controllers\PersonController();
    $var->Add('holis');