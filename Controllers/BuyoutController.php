<?php namespace Controllers;

    use Daos\BuyoutDAO as BuyoutDAO;
    use Models\Buyout as Buyout;

    class BuyoutController{
        private $buyOutDAO;

        public function __construct(){
            $this->buyOutDAO = new BuyoutDAO();
        }

        public function Add($cant, $desc, $date, $total){
            $buy = new Buyout($cant, $desc, $date, $total);
            
            $this->buyOutDAO->Add($buy);
        }
    }
    