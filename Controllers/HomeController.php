<?php namespace Controllers;

use Daos\CinemaDAO as CinemaDAO;
use Models\Cinema as Cinema;
use Daos\MovieDAO as MovieDAO;
use Models\Movie as Movie;
use Daos\BillboardDAO as BillboardDAO;
    
class HomeController {
    
    private $movieDAO;
    private $cinemaDAO;
        private $billboardDAO;
    
    public function __construct() {
        $this->cinemaDAO = new CinemaDAO();
        $this->movieDAO = new MovieDAO();
        $this->billboardDAO = new BillboardDAO();
    }

    public function Index($message = "") {
    	$movies_list  = $this->movieDAO->getNowApi();
	$cinemas_list = $this->cinemaDAO->GetAll();

	if(!is_array($cinemas_list)) {
		$cinema_aux = $cinemas_list;
		$cinemas_list = array();
		array_push($cinemas_list, $cinema_aux);
	} 

	$movies_id_aux = $this->billboardDAO->GetAllMoviesInBillboard();
	$movies_in_billboard = array();
	foreach($movies_id_aux as $movie_id) {
		$movie_aux = $this->movieDAO->GetById($movie_id['id_movie']);
		if(!in_array($movie_aux, $movies_in_billboard)) {
			array_push($movies_in_billboard, $movie_aux);
		}
	}

	//if(!empty(debo traer una variables $funcion)){}else{}
        require_once(VIEWS_PATH.'navbar.php');
        require_once(VIEWS_PATH."home.php");
    }

    public function Login($message = "") {
        require_once(VIEWS_PATH.'navbar.php');
        require_once(VIEWS_PATH."login.php");
    }

    public function PrivacyPolicy() {
        require_once(VIEWS_PATH.'navbar.php');
        require_once(VIEWS_PATH."PrivacyPolicy.php");
    }

}
?>
