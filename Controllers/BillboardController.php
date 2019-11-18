<?php namespace Controllers;

use Daos\CinemaDAO as CinemaDAO;
use Models\Cinema as Cinema;
use Daos\MovieDAO as MovieDAO;
use Models\Movie as Movie;
use Daos\BillboardDAO as BillboardDAO;
use Daos\FunctionDAO as FunctionDAO;
use Daos\BuyoutDAO as BuyoutDAO;
use Models\Billboard as Billboard;

class BillboardController {

    private $movieDAO;
    private $cinemaDAO;
    private $billboardDAO;
    private $functionDAO;
    private $buyOutDAO;

    public function __construct() {
        $this->cinemaDAO = new CinemaDAO();
        $this->movieDAO = new MovieDAO();
        $this->billboardDAO = new BillboardDAO();
        $this->functionDAO = new FunctionDAO();
        $this->buyOutDAO = new BuyoutDAO();
    }

    public function Add($idCinema, $idMovie, $day, $hour, $idSaloon){
        /*echo '<pre>';
        var_dump($_POST);
        echo '</pre>';*/
        $added = $this->billboardDAO->Add($idMovie, $idCinema, $idSaloon, $day, $hour);
        $movieList = $this->movieDAO;
        $cinemasList = $this->cinemaDAO;
        $billboardList = $this->billboardDAO;
        require_once(VIEWS_PATH . 'navbar.php');
        require_once(VIEWS_PATH . "billboard-list.php");
    }

    public function editBillboard($cinema, $idMovie, /*$day, $hour, $saloon,*/ $idBillboard){
        $edited = $this->billboardDAO->Update($cinema, $idMovie, $idBillboard);
        
        $movieList = $this->movieDAO;
        $cinemasList = $this->cinemaDAO;
        $billboardList = $this->billboardDAO;
        require_once(VIEWS_PATH . 'navbar.php');
        require_once(VIEWS_PATH . "billboard-list.php");
    }

    public function editFunction($days, $hours, $id_saloon, $id_function){
        $edited = $this->functionDAO->Update($days, $hours, $id_saloon, $id_function);
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

 // editBillBoard_PDO ESTA EN PROCESO
    public function editBillBoard_PDO($idCinema, $idMovie, $day, $hour, $idSaloon, $oldMovie, $oldCinema){
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
}
