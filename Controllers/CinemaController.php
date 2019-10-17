<?php namespace Controllers;

use Daos\CinemaDAO as CinemaDAO;
use Models\Cinema as Cinema;

class CinemaController{
    private $cinemaDAO;

    public function __construct(){
        $this->cinemaDAO = new CinemaDAO();
    }

    public function Add($name, $capacity, $adress, $value){
        $cinema = new Cinema($name, $capacity, $adress, $value);

        $this->cinemaDAO->Add($cinema);
    }
}