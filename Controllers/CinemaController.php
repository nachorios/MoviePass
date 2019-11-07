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

      $cinemasList = $this->cinemaDAO; //PARA PDO

      //$cinemasList = $this->cinemaDAOJson; // para json

      require_once(VIEWS_PATH . "cinemas-list.php");
    }

    public function Add($name, $capacity, $adress, $value){
// aqui deberia pasar el $newCinema porque los datos se obtienen en el retrieve data en cinema json,
// no se aprovecha la funcionalidad
        $cinema = new Cinema($name, $capacity, $adress, $value);

        $this->cinemaDAO->Add($cinema);
    }

    public function AddJson($name, $capacity, $adress, $value){
        $cinema = new Cinema($name, $capacity, $adress, $value);
        $flag = $this->cinemaDAOJson->Add($cinema);
        return $flag;
    }

    public function registerCinema($name, $capacity, $adress, $value)
    {
      //esto lo agrego para que tambien me guarde el objeto en la BBDD, aun no funcion por eso lo dejo comentado
      $cinema = new Cinema($name, $capacity, $adress, $value);
      $agregado = $this->cinemaDAO->Add($cinema); // DE PDO
      echo $agregado;

      //$agregado = $this->AddJson($name, $capacity, $adress, $value); //DE JSON  // cuidado con el espanglish, recordar que retorna flag para el modal

      require_once(VIEWS_PATH . 'navbar.php');
      $cinemasList = $this->cinemaDAOJson;
      require_once(VIEWS_PATH . "cinemas-list.php");
    }

    public function editCinema($name, $capacity, $adress, $value, $oldName)
    {
      $this->cinemaDAOJson->Delete($oldName);
      $this->AddJson($name, $capacity, $adress, $value);
      $editado = true;                                             // cuidado con el espanglish
      require_once(VIEWS_PATH . 'navbar.php');
      $cinemasList = $this->cinemaDAOJson;
      require_once(VIEWS_PATH . "cinemas-list.php");
    }

    public function deleteCinema($name){
        $this->cinemaDAOJson->Delete($name);
    }

    public function allCinema(){
        return $this->cinemaDAOJson->GetAll();
    }
}
