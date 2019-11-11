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
      //$arrayCinemas = $this->cinemaDAOJson->GetAll();

      //$cinemasList = $this->cinemaDAO; //PARA PDO

      $cinemasList = $this->cinemaDAOJson; // para json

      require_once(VIEWS_PATH . "cinemas-list.php");
    }

    public function registerCinema($name, $adress/*$saloon,*/)
    {
      //esto lo agrego para que tambien me guarde el objeto en la BBDD, aun no funcion por eso lo dejo comentado
      $cinema = new Cinema($name, $adress/*$saloon,*/);
      //$agregado = $this->cinemaDAO->Add($cinema); // DE PDO //tambien retorna flag para el modal

      $agregado = $this->cinemaDAOJson->Add($cinema); //DE JSON  // cuidado con el espanglish, recordar que retorna flag para el modal

      //$this->ShowCinemasList(); //ver como reutilizar funcion
      require_once(VIEWS_PATH . 'navbar.php');
      //$cinemasList = $this->cinemaDAO; //muestra lista de dao al registrar
      $cinemasList = $this->cinemaDAOJson; //muestra lista del json al registrar
      require_once(VIEWS_PATH . "cinemas-list.php");
    }

    public function editCinema($name, $adress,/*$saloon,*/ $id_cinema)
    {
      $editado = false;

      $cinema = new Cinema($name, $adress/*, $saloon*/); //json y pdo
      $proof = $this->cinemaDAOJson->Update($cinema,$id_cinema); //json

      //$proof = $this->cinemaDAO->Update($cinema,$id_cinema); //pdo

      //echo $proof; //muestra 1 si se modifico bien o 0 si no
      if($proof = 1)
      {
        $editado = true;
      }
      else
      {
        $editado = false;
      }


      require_once(VIEWS_PATH . 'navbar.php');
      $cinemasList = $this->cinemaDAOJson; //muestra lista de json al editar
      //$cinemasList = $this->cinemaDAO; //muestra lista de dao al editar
      require_once(VIEWS_PATH . "cinemas-list.php");
    }

    public function deleteCinema($id_cinema){
        $this->cinemaDAOJson->Delete($id_cinema); //json
        //$this->cinemaDAO->Delete($id_cinema); //pdo
    }

    public function allCinema(){
        return $this->cinemaDAOJson->GetAll();
    }
}
