<?php namespace Controllers;

use Daos\CinemaDAO as CinemaDAO;
use Daos\SaloonDAO as SaloonDAO;
use Models\Saloon as Saloon;
use Models\Cinema as Cinema;
use Controllers\ViewController as ViewC;

class SaloonController{
    private $saloonDAO;
    private $cinemaDAO;


    public function __construct(){
        $this->saloonDAO = new SaloonDAO();
        $this->cinemaDAO = new CinemaDAO();
    }

    public function editSaloon($name, $capacity, $value, $id_salon) 
    {
      $saloon = new Saloon($name, $capacity, $value);

      $proof = $this->saloonDAO->Update($saloon,$id_salon);

      //echo $proof; //muestra 1 si se modifico bien o 0 si no
      if($proof == 1)
      {
        $editedSaloon = true;
      }
      else
      {
        $editedSaloon = false;
      }

      require_once(VIEWS_PATH . 'navbar.php');
      $cinemasList = $this->cinemaDAO; //muestra lista de dao al editar
      require_once(VIEWS_PATH . "cinemas-list.php");
    }

    public function deleteSaloon() 
    {
      
      $proof = $this->saloonDAO->Delete($_GET['delete-saloon']);
      if($proof == 1) 
        $deletedSaloon = true;
      else
        $deletedSaloon = false;

      require_once(VIEWS_PATH . 'navbar.php');
      $cinemasList = $this->cinemaDAO; //muestra lista de dao al registrar
      require_once(VIEWS_PATH . "cinemas-list.php");
    }

    public function registerSaloon($nameSaloon, $capacity, $value, $id_cinema)
    {
      $salon = new Saloon($nameSaloon, $capacity, $value);
      $addedSaloon = $this->saloonDAO->Add($salon, $id_cinema);

      require_once(VIEWS_PATH . 'navbar.php');
      $cinemasList = $this->cinemaDAO; //muestra lista de dao al registrar
      require_once(VIEWS_PATH . "cinemas-list.php");
    }

}



?>
