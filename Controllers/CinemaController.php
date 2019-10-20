<?php namespace Controllers;

use Daos\CinemaDAO as CinemaDAO;
use DaosJson\CinemaJson as CinemaJson;
use Models\Cinema as Cinema;

class CinemaController{
    private $cinemaDAO;
    private $cinemaDAOJson;

    public function __construct(){
        $this->cinemaDAO = new CinemaDAO();
        $this->cinemaDAOJson = new CinemaJson();
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

    public function AddJson($name, $capacity, $adress, $value){
        $cinema = new Cinema($name, $capacity, $adress, $value);

        $this->cinemaDAOJson->Add($cinema);
    }

    public function registerCinema($name, $capacity, $adress, $value)
    {
      $cinemaRegistered = $this->AddJson($name, $capacity, $adress, $value);
      require_once(VIEWS_PATH . 'header.php'); // no se porque no muestra el navar y no me lleva a cinemas-list
      require_once(VIEWS_PATH . "cinemas-list.php");
    }

    public function deleteCinema($name){
        $this->cinemaDAOJson->Delete($name);
    }

    public function allCinema(){
        return $this->cinemaDAOJson->GetAll();
    }
}
