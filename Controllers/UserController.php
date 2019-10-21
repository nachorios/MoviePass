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

        public function register($dni, $pass, $name, $lastName, $mail, $role) {
            $userRegistered = $this->AddJson($name, $lastName, $dni, $mail, $pass, $role);
            require_once(VIEWS_PATH . 'header.php');
            require_once(VIEWS_PATH . 'navbar.php');
            require_once(VIEWS_PATH . "login.php");
        }

        public function login($mail, $pass) {
            $userList = $this->userDAOJson->GetAll();
            $logeado = false;
            foreach($userList as $user) {
                if($mail == $user->getMail() && $pass == $user->getPass()) {
                    $_SESSION['loggedUser'] = $user;
                    $logeado = true;
                    break;
                }
            }
            require_once(VIEWS_PATH . 'header.php');
            require_once(VIEWS_PATH . 'navbar.php');
            if ($logeado) {
                require_once(VIEWS_PATH . "index.php");
            } else {
                require_once(VIEWS_PATH . "login.php");
            }
        }

        public function logout() {
            unset($_SESSION['loggedUser']);
            require_once(VIEWS_PATH . 'header.php');
            require_once(VIEWS_PATH . 'navbar.php');
            require_once(VIEWS_PATH . "index.php");
        }

        public function AddJson($name, $lastName, $dni, $mail, $pass, $role){
            $user = new User($name, $lastName, $dni, $mail, $pass, $role);

            $registered = $this->userDAOJson->Add($user);
            return $registered;
        }

    }
