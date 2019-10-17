<?php namespace Controllers;

    use Daos\UserDAO as UserDAO;
    use DaosJson\UserJson as UserJson;
    use Models\User as User;

    class UserController{
        private $userDAO;
        private $userDAOJson;

        public function __construct(){
            $this->userDAO = new UserDAO();
            $this->userDAOJson = new UserJson();
        }

        public function Add($name, $lastName, $dni, $mail, $pass, $role){
            $user = new User($name, $lastName, $dni, $mail, $pass, $role);
            
            $this->userDAO->Add($user);
        }

        public function register() {
            var_dump($_POST);
        }

        public function AddJson($name, $lastName, $dni, $mail, $pass, $role){
            $user = new User($name, $lastName, $dni, $mail, $pass, $role);
            
            $this->userDAOJson->Add($user);
        }

    }
    