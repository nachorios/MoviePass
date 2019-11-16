<?php namespace Controllers;

    use Daos\BuyoutDAO as BuyoutDAO;
    use Models\Buyout as Buyout;
    use Models\User as User;
    use Daos\UserDAO;

    class BuyoutController{
        private $buyOutDAO;

        public function __construct(){
            $this->buyOutDAO = new BuyoutDAO();
        }

        public function Add($cant, $desc, $date, $total, $id_movie, $mail){
            $buy = new Buyout($cant, $desc, $date, $id_movie, $total);
            
            $this->buyOutDAO->Add($buy, $mail);
            require_once(VIEWS_PATH . 'header.php');
            require_once(VIEWS_PATH . 'navbar.php');
        }
    }
    