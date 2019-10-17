<?php namespace Daos;

    use \Exception as Exception;
    use Daos\Interfaces\IMovieDAO as IMovieDAO;
    use Models\Movie as Movie;
    use Daos\Connection as Connection;

    class MovieDAO implements IMovieDAO {

        private $connection;
        private $tableName = "movies";


        public function getNowApi()
        {
            return $this->retrieveData();
        }
        private function retrieveData()
        {
            $movielist= array();
            $jsonContent= file_get_contents('https://api.themoviedb.org/3/movie/now_playing?api_key=1e5c581fb6ceaf853ff088a424f4cfcb&language=en-US&page=1', true);
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