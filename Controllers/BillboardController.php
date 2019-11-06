<?php namespace Controllers;

use DaosJson\CinemaJson as CinemaDAO;
use Models\Cinema as Cinema;
use Daos\MovieDAO as MovieDAO;
use Models\Movie as Movie;
use DaosJson\BillboardJson as BillboardDAO;
use Models\Billboard as Billboard;

class BillboardController {

    private $movieDAO;
    private $cinemaDAO;
    private $billboardDAO;

    public function __construct() {
        $this->cinemaDAO = new CinemaDAO();
        $this->movieDAO = new MovieDAO();
        $this->billboardDAO = new BillboardDAO();
    }

    public function Add($cinema, $idMovie, $day, $hour){
        $billboard = new Billboard($day, $hour, $idMovie, $cinema);
        $added = $this->billboardDAO->Add($billboard);
        $movieList = $this->movieDAO;
        $cinemasList = $this->cinemaDAO; 
        $billboardList = $this->billboardDAO; 
        require_once(VIEWS_PATH . 'header.php');
        require_once(VIEWS_PATH . 'navbar.php');
        require_once(VIEWS_PATH . "billboard-list.php");
    }

    public function editCinema($cinema, $idMovie, $day, $hour, $oldMovie, $oldCinema)
    {
        $oldBillboard = $this->billboardDAO->GetBillboard($oldCinema, $oldMovie);
        $this->billboardDAO->Delete($oldCinema, $oldMovie);
        $billboard = new Billboard($day, $hour, $idMovie, $cinema);
        $edited = $this->billboardDAO->Add($billboard);
        if(!$edited) {
            $this->billboardDAO->Add($oldBillboard);
        }
        $movieList = $this->movieDAO;
        $cinemasList = $this->cinemaDAO; 
        $billboardList = $this->billboardDAO; 
        require_once(VIEWS_PATH . 'header.php');
        require_once(VIEWS_PATH . 'navbar.php');
        require_once(VIEWS_PATH . "billboard-list.php");
    }

    /*----Vistas----*/
    public function ShowView() //pruebas
    {
        require_once( VIEWS_PATH . 'header.php');
        require_once( VIEWS_PATH . 'navbar.php');
        $movieList = $this->movieDAO;
        $cinemasList = $this->cinemaDAO; 
        $billboardList = $this->billboardDAO; 
        require_once(VIEWS_PATH."billboard-list.php");
    }
    /*--------------*/
}
