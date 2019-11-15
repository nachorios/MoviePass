<?php namespace Controllers;

use Daos\CinemaDAO as CinemaDAO;
use Models\Cinema as Cinema;
use Daos\MovieDAO as MovieDAO;
use Models\Movie as Movie;
use Daos\BillboardDAO as BillboardDAO;
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

    public function Add($cinema, $idMovie, $day, $hour, $saloon){
        /*echo '<pre>';
        var_dump($_POST);
        echo '</pre>';*/
        $billboard = new Billboard($day, $hour, $idMovie, $cinema, null, $saloon);
        $added = $this->billboardDAO->Add($billboard);
        $movieList = $this->movieDAO;
        $cinemasList = $this->cinemaDAO; 
        $billboardList = $this->billboardDAO; 
        require_once(VIEWS_PATH . 'navbar.php');
        require_once(VIEWS_PATH . "billboard-list.php");
    }

    public function editBillboard($cinema, $idMovie, $day, $hour, $saloon, $oldMovie, $oldCinema){
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
        require_once(VIEWS_PATH . 'navbar.php');
        require_once(VIEWS_PATH . "billboard-list.php");
    }

    public function deleteBillboard() 
    {
        if(isset($_GET['delete'])) {
            $proof = $this->billboardDAO->Delete($_GET['delete']);
            if($proof == 1) 
            $deletedCinema = true;
            else
            $deletedCinema = false;
        }
        
        $movieList = $this->movieDAO;
        $cinemasList = $this->cinemaDAO; 
        $billboardList = $this->billboardDAO; 
        require_once(VIEWS_PATH . 'navbar.php');
        require_once(VIEWS_PATH . "billboard-list.php");
      }

    /*----Vistas----*/
    public function ShowView() //pruebas
    {
        require_once( VIEWS_PATH . 'navbar.php');
        $movieList = $this->movieDAO;
        $cinemasList = $this->cinemaDAO; 
        $billboardList = $this->billboardDAO; 
        require_once(VIEWS_PATH."billboard-list.php");
    }
    /*--------------*/
}
