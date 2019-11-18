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

/*        public function Add($name, $lastName, $dni, $mail, $pass, $role){
            $user = new User($name, $lastName, $dni, $mail, $pass, $role);

            $this->userDAO->Add($user);
        }*/

        public function register($mail, $pass, $replyPass, $name, $lastName, $dni, $role) {
            //$userRegistered = $this->AddJson($name, $lastName, $dni, $mail, $pass, $role);

            $newUser = new User($name, $lastName, $dni, $mail, $pass, $role = 1);
            $userRegistered = $this->userDAO->Add($newUser);

            require_once(VIEWS_PATH . 'navbar.php');
            require_once(VIEWS_PATH . "login.php");
        }

        public function login($mail, $pass) {
            $logged = false;

            /*$userList = $this->userDAOJson->GetAll();            
            foreach($userList as $user) {
                if($mail == $user->getMail() && $pass == $user->getPass()) {
                    $_SESSION['loggedUser'] = $user;
                    $logged = true;
                    break;
                }
            }*/

            /**********parte pdo*********/

            // se retorna el objeto que se encontro (ya se verifica que esta en la bbdd), si no null
            $userFound = $this->userDAO->getUserByMailPass($mail, $pass);
            //echo "usuario:";
            //var_dump($userFound);

            if($userFound != NULL)
            {
               $_SESSION['loggedUser'] = $userFound;
               $logged = true;
            }

            require_once(VIEWS_PATH . 'navbar.php');
            if ($logged) {
                require_once(VIEWS_PATH . "home.php");
            } else {
                require_once(VIEWS_PATH . "login.php");
            }
        }

        public function facebookLogin() {

        include('Config/fb-config.php');

            try{
                $accessToken = $helper->getAccessToken();

            } catch (\Facebook\Exceptions\FacebookResponseException $e) {
                echo "Exception: " . $e->getMessage();
                exit();
            } catch (\Facebook\Exceptions\FacebookSDKException $e) {
                echo "Exception: " . $e->getMessage();
                exit();
            }

            if(!$accessToken) {

                require_once(VIEWS_PATH . 'navbar.php');
                require_once(VIEWS_PATH . "login.php");
                exit();
            }

            $oAuth2Client = $fb->getOAuth2Client();
            if (!$accessToken->isLongLived()) {
                $accessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);
            }
            $response = $fb->get("/me?fields=id, first_name, last_name, email, birthday, picture.type(large)", $accessToken);
            $userData = $response->getGraphNode()->asArray();
            $date = $userData['birthday'];
            $_SESSION['loggedUser'] = new User($userData['first_name'], $userData['last_name'], null, $userData['email'], null, 1, $userData['picture']['url'], $date);

            require_once(VIEWS_PATH . 'navbar.php');
            require_once(VIEWS_PATH . "home.php");
        }

        public function logout() {
            unset($_SESSION['loggedUser']);

            require_once(VIEWS_PATH . 'navbar.php');
            require_once(VIEWS_PATH . "home.php");
        }

        public function profile() {

            $disable_cache = true;
            require_once(VIEWS_PATH . 'navbar.php');
            require_once(VIEWS_PATH . "profile.php");
        }

        public function AddJson($name, $lastName, $dni, $mail, $pass, $role){
            $user = new User($name, $lastName, $dni, $mail, $pass, $role);

            $registered = $this->userDAOJson->Add($user);
            return $registered;
        }

    }
