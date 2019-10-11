<?php namespace Daos;

    use \Exception as Exception;
    use Daos\Interfaces\IMovieDAO as IMovieDAO;
    use Models\Movie as Movie;
    use Daos\Connection as Connection;

    class MovieDAO implements IMovieDAO {

        private $connection;
        private $tableName = "movies";

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