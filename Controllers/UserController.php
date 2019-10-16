<?php namespace Controllers;

    use Daos\UserDAO as UserDAO;
    use Models\User as User;

    class UserController{
        private $userDAO;

        public function __construct(){
            $this->userDAO = new UserDAO();
        }

        public function Add($name, $lastName, $dni, $mail, $pass){
            $user = new User($name, $lastName, $dni, $mail, $pass);
            
            $this->userDAO->Add($user);
        }
    }
    