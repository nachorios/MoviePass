<?php namespace Controllers;

use DaosJson\CinemaJson as CinemaDAO;
use Models\Cinema as Cinema;
use Daos\MovieDAO as MovieDAO;
use Models\Movie as Movie;

class BillboardController {

    private $movieDAO;
    private $cinemaDAO;

    public function __construct() {
        $this->cinemaDAO = new CinemaDAO();
        $this->movieDAO = new MovieDAO();
    }

    /*----Vistas----*/
    public function ShowView() //pruebas
    {
        require_once( VIEWS_PATH . 'header.php');
        require_once( VIEWS_PATH . 'navbar.php');
        $movieList = $this->movieDAO;
        $cinemasList = $this->cinemaDAO; 
        require_once(VIEWS_PATH."billboard-list.php");
    }
    /*--------------*/
}
