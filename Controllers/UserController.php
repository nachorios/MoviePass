<?php namespace Controllers;

    use Daos\UserDAO as UserDAO;
    use Models\User as User;

    class UserController{
        private $userDAO;

        public function __construct(){
            $this->userDAO = new UserDAO();
        }

        public function Add($name, $lastName, $dni, $mail, $pass, $role){
            $user = new User($name, $lastName, $dni, $mail, $pass, $role);
            
            $this->userDAO->Add($user);
        }
    }
    