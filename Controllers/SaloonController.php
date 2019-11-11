<?php namespace Controllers;

use Daos\SaloonDAO as SaloonDAO;
use Models\Saloon as Saloon;

class SaloonController{
    private $saloonDAO;


    public function __construct(){
        $this->saloonDAO = new SaloonDAO();
    }

  public function ShowCinemasList()
  {
    require_once(VIEWS_PATH . 'navbar.php');
    require_once(VIEWS_PATH . "cinemas-list.php");
  }

}



?>
