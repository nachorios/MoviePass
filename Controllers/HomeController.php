<?php
    namespace Controllers;
    class HomeController
    {
        public function Index($message = "")
        {
            //if(!empty(debo traer una variables $funcion)){}else{}
            require_once(VIEWS_PATH.'navbar.php');
            require_once(VIEWS_PATH."home.php");
        }
        public function Login($message = "")
        {
            require_once(VIEWS_PATH.'navbar.php');
            require_once(VIEWS_PATH."login.php");
        }
    }
?>
