<?php namespace Controllers;

use Daos\CinemaDAO as CinemaDAO;
use Models\Cinema as Cinema;

class CinemaController{
    private $cinemaDAO;

    public function __construct(){
        $this->cinemaDAO = new CinemaDAO();
    }

    public function ShowCinemasList()
    {
      require_once( VIEWS_PATH . 'header.php');
      require_once( VIEWS_PATH . 'navbar.php');
      require_once(VIEWS_PATH . "cinemas-list.php");
    }

    public function Add($name, $capacity, $adress, $value){
        $cinema = new Cinema($name, $capacity, $adress, $value);

        $this->cinemaDAO->Add($cinema);
    }
}
