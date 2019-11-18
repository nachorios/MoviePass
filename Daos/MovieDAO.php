<?php namespace Daos;

    use \Exception as Exception;
    use Models\Movie as Movie;
    use Daos\Connection as Connection;

    class MovieDAO {

        private $connection;
        private $tableName = "movies";


        public function getNowApi()
        {
            $movies;
            if(!isset($_SESSION['movies'])) {
                $_SESSION['movies'] = $this->retrieveData();
                $movies = $_SESSION['movies'];
            } else {
                $movies = $_SESSION['movies'];
            }
            return $movies;
        }
        private function retrieveData()
        {
            $movielist= array();
            $jsonContent= file_get_contents('https://api.themoviedb.org/3/movie/now_playing?api_key=1e5c581fb6ceaf853ff088a424f4cfcb&language=es-ES&page=1', true);
            $arrayTodecode = ($jsonContent) ? json_decode($jsonContent, true) : array();
            $filmArray = $arrayTodecode['results'];
            foreach ($filmArray as $indice)
            {
                $movie= new Movie();
                $movie->setId($indice['id']);
                $movie->setPopularity($indice['popularity']);
                $movie->setVote_count($indice['vote_count']);
                $movie->setVideo($indice['video']);
                $movie->setPoster_path($indice['poster_path']);
                $movie->setAdult($indice['adult']);
                $movie->setBackdrop_path($indice['backdrop_path']);
                $movie->setOriginal_language($indice['original_language']);
                $movie->setOriginal_title($indice['original_title']);
                $movie->setGenre_ids($indice['genre_ids']);
                $movie->setTitle($indice['title']);
                $movie->setVote_average($indice['vote_average']);
                $movie->setOverview($indice['overview']);
                $movie->setRelease_date($indice['release_date']);
                array_push($movielist, $movie);
            }
            return $movielist;
        }

        public function getGenreList() {
            $genrelist= array();
            $jsonContent= file_get_contents('https://api.themoviedb.org/3/genre/movie/list?api_key=1e5c581fb6ceaf853ff088a424f4cfcb&language=es-ES', true);
            $arrayTodecode = ($jsonContent) ? json_decode($jsonContent, true) : array();
            return $arrayTodecode['genres'];
        }

        public function GetById($id) {
            $genrelist= array();
            $jsonContent= file_get_contents('https://api.themoviedb.org/3/movie/'.$id.'?api_key=1e5c581fb6ceaf853ff088a424f4cfcb&language=es-ES', true);
            $movieData = ($jsonContent) ? json_decode($jsonContent, true) : array();
            $movie= new Movie();
            $movie->setId($movieData['id']);
            $movie->setPopularity($movieData['popularity']);
            $movie->setVote_count($movieData['vote_count']);
            $movie->setVideo($movieData['video']);
            $movie->setPoster_path($movieData['poster_path']);
            $movie->setAdult($movieData['adult']);
            $movie->setBackdrop_path($movieData['backdrop_path']);
            $movie->setOriginal_language($movieData['original_language']);
            $movie->setGenre_ids($movieData['genres']);
            $movie->setOriginal_title($movieData['original_title']);
            $movie->setTitle($movieData['title']);
            $movie->setVote_average($movieData['vote_average']);
            $movie->setOverview($movieData['overview']);
            $movie->setRelease_date($movieData['release_date']);
            return $movie;
        }

        /**
         * Funcion para agregar mediante un INSERT una pelicula a la base de datos.
         */
        public function Add(Movie $movie) {
            try {

                $query = "INSERT INTO " . $this->tableName . "(title, time, language) VALUES (:title, :time, :language);";

                $parameters["title"] = $movie->getTitle();
                $parameters["time"] = $movie->getTime();
                $parameters["language"] = $movie->getLanguage();

                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $parameters);

            } catch(Exception $e) {
                throw $e;
            }
        }

        /**
         * Funcion para obtener todas las peliculas de la base de datos mediante un SELECT.
         */
        public function GetAll() {

            try {
                $movieList = array();

                $query = "SELECT * FROM ".$this->tableName;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);

                foreach ($resultSet as $row):

                    $movie = new Movie();
                    $movie->setTitle($row["title"]);
                    $movie->setTime($row["time"]);
                    $movie->setLanguage($row["language"]);
                    array_push($movieList, $movie);

                endforeach;

                return $movieList;
            } catch(Exception $e) {
                throw $e;
            }

        }

    }