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

        //$this->cinemaDAO->Add($cinema); // no se porque estaba este add de pdo
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
      $agregado = $this->cinemaDAO->Add($cinema); // DE PDO //tambien retorna flag para el modal


      //$agregado = $this->AddJson($name, $capacity, $adress, $value); //DE JSON  // cuidado con el espanglish, recordar que retorna flag para el modal

      //$this->ShowCinemasList(); //ver como reutilizar funcion
      require_once(VIEWS_PATH . 'navbar.php');
      $cinemasList = $this->cinemaDAO; //muestra lista de dao al registrar
      //$cinemasList = $this->cinemaDAOJson; //muestra lista del json al registrar
      require_once(VIEWS_PATH . "cinemas-list.php");
    }

    public function editCinema($name, $capacity, $adress, $value, $oldName)
    {
      $editado = false;

      //$this->cinemaDAOJson->Delete($oldName);
      //$this->AddJson($name, $capacity, $adress, $value);
//die(var_dump($oldName));

      $cinema = new Cinema($name, $capacity, $adress, $value); //pdo
      $proof = $this->cinemaDAO->Update($cinema,$oldName); /*pdo*/
      //echo $proof; //muestra 1 si se modifico bien o 0 si no
      if($proof = 1)
      {
        $editado = true;
      }
      else
      {
        $editado = false;
      }

      //$editado = true;                                             // cuidado con el espanglish
      require_once(VIEWS_PATH . 'navbar.php');
      //$cinemasList = $this->cinemaDAOJson; //muestra lista de json al editar
      $cinemasList = $this->cinemaDAO; //muestra lista de dao al editar
      require_once(VIEWS_PATH . "cinemas-list.php");
    }

    public function deleteCinema($name){
        //$this->cinemaDAOJson->Delete($name); //json
        $this->cinemaDAO->Delete($name); //pdo
    }

    public function allCinema(){
        return $this->cinemaDAOJson->GetAll();
    }
}
