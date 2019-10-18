<?php
    namespace Controllers;
    class HomeController
    {
        public function Index($message = "")
        {
            require_once(VIEWS_PATH."index.php");
        }
        public function Login($message = "")
        {
            require_once(VIEWS_PATH."login.php");
        }
    }
?>