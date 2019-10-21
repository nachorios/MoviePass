<?php namespace Controllers;

//use Controllers\CinemaController as CinemaC;

class ViewController{

  public function __construct()
  {

  }

  public function ShowCinemasList()
  {
    require_once(VIEWS_PATH . 'navbar.php');
    require_once(VIEWS_PATH . "cinemas-list.php");
  }

}



?>
