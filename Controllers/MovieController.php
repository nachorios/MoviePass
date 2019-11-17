<?php namespace Controllers;


    use Daos\MovieDAO as MovieDAO;
    use Daos\BillboardDAO as BillboardDAO;
    use Models\Movie as Movie;

    class MovieController {

        private $movieDAO;
        private $billboardDAO;

        public function __construct() {
            $this->movieDAO = new MovieDAO();
            $this->billboardDAO = new BillboardDAO();
        }

        /*----Vistas----*/
        public function ShowListView() //pruebas
        {
            
		    require_once( VIEWS_PATH . 'header.php');
            require_once( VIEWS_PATH . 'navbar.php');
            
            $arrayIdMovies = $this->billboardDAO->GetAllMoviesInBillboard();
            $arrayMovies = array();
            foreach($arrayIdMovies as $idMovie) {
                array_push($arrayMovies, $this->movieDAO->GetById($idMovie['id_movie']));
            }
            $genreList = $this->movieDAO->getGenreList();
            $newArrayMovies = array();
            foreach($arrayMovies as $movie) {
                if (isset($_GET['show_genre'])) {
                    $genre_id = $_GET['show_genre'];
                    if($genre_id != -1) {
                         $isThisGenre = false;
                         foreach ($movie->getGenre_ids() as $genre) {
                              if($genre == $genre_id) {
                                   $isThisGenre = true;
                                   break;
                              }
                         }
                         if(!$isThisGenre) {
                              continue;
                         }
                    }
               } 
               if (isset($_GET['show_date'])) {
                    $date = $_GET['show_date'];
                    if ($date != null) {
                         
                         $isThisDate = false;
                         if($movie->getRelease_date() == $date) {
                              $isThisDate = true;
                         }
                        if(!$isThisDate) {
                            continue;
                        } 
                    }    
                }
                array_push($newArrayMovies, $movie);
            }
            $arrayMovies = $newArrayMovies;
            require_once(VIEWS_PATH."movie-list.php");
        }
        /*--------------*/

        public function getList()
		{
			$api = $this->movieDAO->getNowApi();
			return $api;
		}

        /**
         * Agrega una peliculo al DAO
         */
        public function Add($title, $time, $language) {

            $movie = new Movie();
            $movie->setTitle($title);
            $movie->setTime($time);
            $movie->setLanguage($language);

            $this->movieDAO->Add($movie);
        }
    }
