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
            $userRegistered = false;
            if (isset($_POST)){
                $name = $_POST['name'];
                $lastName = $_POST['last-name'];
                $dni = $_POST['dni'];
                $mail = $_POST['mail'];
                $pass = $_POST['pass'];
                $role = $_POST['role'];
                $this->AddJson($name, $lastName, $dni, $mail, $pass, $role);
                $userRegistered =true;
            }
            require_once(VIEWS_PATH . 'header.php');
            require_once(VIEWS_PATH . "index.php");
        }

        public function AddJson($name, $lastName, $dni, $mail, $pass, $role){
            $user = new User($name, $lastName, $dni, $mail, $pass, $role);
            
            $this->userDAOJson->Add($user);
        }

    }
    