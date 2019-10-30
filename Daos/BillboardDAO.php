<?php namespace Daos;

    use \Exception as Exception;
    use Models\Movie as Movie;
    use Models\Billboard as Billboard;
    use Daos\Connection as Connection;

    class BillboardDAO{

        private $connection;
        private $tableName = "billboard";

        /**
         * Funcion para agregar mediante un INSERT una pelicula a la base de datos.
         */
        public function Add(Billboard $bill) {
            try {
            

                $query = "INSERT INTO " . $this->tableName . "(id_movies, id_cinema) VALUES (:id_movies, :id_cinema);";

                $parameters = Array();
                $parameters["id_movies"] = $bill->getMovie();
                $parameters["id_cinema"] = $bill->getCinema();

                $this->connection = Connection::GetInstance();

                $this->connection->executeQuery($query, $parameters);
                $this->AddDate($bill->getDay(), $bill->getHour(), $this->connection->getPdo()->lastInsertId());
            } catch(Exception $e) {
                throw $e;
            }
        }

        public function AddDate($days, $hours, $id) {
            for($i = 0; $i < count($days); $i++) {
                try {
            

                    $query = "INSERT INTO" . " dates " . "(id_billboard, days, hours) VALUES (:id_billboard, :days, :hours);";
    
                    $parameters = Array();
                    $parameters["id_billboard"] = $id;
                    $parameters["days"] = $days[$i];
                    $parameters["hours"] = $hours[$i];
    
                    $this->connection = Connection::GetInstance();
    
                    $this->connection->executeQuery($query, $parameters);
                } catch(Exception $e) {
                    throw $e;
                }
            }
        }

        public function getMovie($id) {
            $genrelist= array();
            $jsonContent= file_get_contents('https://api.themoviedb.org/3/movie/'.$id.'?api_key=1e5c581fb6ceaf853ff088a424f4cfcb&language=en-US', true);
            $indice = ($jsonContent) ? json_decode($jsonContent, true) : array();
            $movie= new Movie();
            $movie->setId($indice['id']);
            $movie->setPoster_path($indice['poster_path']);
            $movie->setOriginal_language($indice['original_language']);
            $movie->setTitle($indice['title']);
            return $movie;
        }


        public function GetAll() {

            try {
                $billboardList = array();

                $query = "select d.days as 'day', d.hours as 'hour', b.id_movies as 'idMovie', b.id_cinema as 'cinema'
                from billboard as b
                join dates as d
                on b.id_billboard = d.id_billboard";
                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);

                foreach ($resultSet as $row):

                    $billboard = new Billboard(Array($row["day"]), Array($row["hour"]), $row["idMovie"], $row["cinema"]);
                    array_push($billboardList, $billboard);

                endforeach;

                return $billboardList;
            } catch(Exception $e) {
                throw $e;
            }

        }

    }