<?php namespace Controllers;


    use Daos\MovieDAO as MovieDAO;
    use Models\Movie as Movie;

    class MovieController {

        private $movieDAO;

        public function __construct() {
            $this->movieDAO = new MovieDAO();
        }

        /*----Vistas----*/
        public function ShowListView() //pruebas
        {
            
		    require_once( VIEWS_PATH . 'header.php');
		    require_once( VIEWS_PATH . 'navbar.php');
            $arrayMovies = $this->movieDAO->getNowApi();
            $genreList = $this->movieDAO->getGenreList();
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
