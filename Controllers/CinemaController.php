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

    public function Add($name, $capacity, $adress, $value){
        $cinema = new Cinema($name, $capacity, $adress, $value);

        $this->cinemaDAO->Add($cinema);
    }

    public function AddJson($name, $capacity, $adress, $value){
        $cinema = new Cinema($name, $capacity, $adress, $value);

        $this->cinemaDAOJson->Add($cinema);
    }

    public function deleteCinema($name){
        $this->cinemaDAOJson->Delete($name)
    }

    public function allCinema(){
        return $this->cinemaDAOJson->GetAll();
    }
}