<?php namespace Controllers;

use Daos\CinemaDAO as CinemaDAO;
use DaosJson\CinemaJson as CinemaJson;
use Models\Cinema as Cinema;
use Controllers\ViewController as ViewC;

class CinemaController{
    private $cinemaDAO;
    private $cinemaDAOJson;
    private $viewController;


    public function __construct(){
        $this->cinemaDAO = new CinemaDAO();
        $this->cinemaDAOJson = new CinemaJson();
        $this->viewController = new ViewC();
    }

    public function ShowCinemasList()
    {
      require_once(VIEWS_PATH . 'navbar.php');
//      $arrayCinemas = $this->cinemaDAOJson->GetAll();
      $cinemasDao = $this->cinemaDAOJson; //probando
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
      $this->ShowCinemasList(); //cambiar por viewcontroller
      //$this->viewController->ShowCinemasList();
    }

    public function deleteCinema($name){
        $this->cinemaDAOJson->Delete($name);
    }

    public function allCinema(){
        return $this->cinemaDAOJson->GetAll();
    }
}
