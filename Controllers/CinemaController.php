<?php namespace Controllers;

use Daos\CinemaDAO as CinemaDAO;
use Daos\SaloonDAO as SaloonDAO;
use Models\Saloon as Saloon;
use Models\Cinema as Cinema;
use Controllers\ViewController as ViewC;

class CinemaController{
    private $cinemaDAO;
    private $saloonDAO;


    public function __construct(){
        $this->cinemaDAO = new CinemaDAO();
        $this->saloonDAO = new SaloonDAO();
    }

    public function ShowCinemasList()
    {
      require_once(VIEWS_PATH . 'navbar.php');

      $cinemasList = $this->cinemaDAO;
      require_once(VIEWS_PATH . "cinemas-list.php");
    }

    public function registerCinema($nameCinema, $address, $nameSaloon, $value, $capacity)
    {

      $newCinema = new Cinema($nameCinema, $address);
      $addedCinema = $this->cinemaDAO->Add($newCinema);

      $lastID = $this->cinemaDAO->getConnection()->getPdo()->lastInsertId();

      $arraySaloon = array();
      for($i = 0 ; $i < count($nameSaloon); $i++) {
        $salon = new Saloon($nameSaloon[$i], $capacity[$i], $value[$i]);
        array_push($arraySaloon, $salon);
        $this->saloonDAO->Add($salon, $lastID);
      }

      require_once(VIEWS_PATH . 'navbar.php');
      $cinemasList = $this->cinemaDAO; //muestra lista de dao al registrar
      require_once(VIEWS_PATH . "cinemas-list.php");
    }



    public function deleteCinema() {

      $proof = $this->cinemaDAO->Delete($_GET['delete']);
      if($proof == 1)
        $deletedCinema = true;
      else
        $deletedCinema = false;

      require_once(VIEWS_PATH . 'navbar.php');
      $cinemasList = $this->cinemaDAO; //muestra lista de dao al eliminar
      require_once(VIEWS_PATH . "cinemas-list.php");
    }

    public function editCinema($name, $adress, $id_cinema)
    {
      $cinema = new Cinema($name, $adress); //json y pdo

      $proof = $this->cinemaDAO->Update($cinema,$id_cinema); //pdo

      //echo $proof; //muestra 1 si se modifico bien o 0 si no
      if($proof == 1)
      {
        $editedCinema = true;
      }
      else
      {
        $editedCinema = false;
      }

      require_once(VIEWS_PATH . 'navbar.php');
      $cinemasList = $this->cinemaDAO; //muestra lista de dao al editar
      require_once(VIEWS_PATH . "cinemas-list.php");
    }


}
