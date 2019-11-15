<?php namespace Daos;

    use \Exception as Exception;
    use Models\Movie as Movie;
    use Models\Billboard as Billboard;
    use Daos\Connection as Connection;
    use Daos\SaloonDAO as SaloonDAO;
    use Daos\MovieDAO as MovieDAO;
    use Daos\cinemaDAO as cinemaDAO;

    class BillboardDAO{

        private $connection;
        private $tableName = "billboard";

        /**
         * Funcion para agregar mediante un INSERT una pelicula a la base de datos.
         */
        public function Add(Billboard $bill) {
            $flag = false;
            try {


                $query = "INSERT INTO " . $this->tableName . "(id_movie, id_cinema) VALUES (:id_movie, :id_cinema);";

                $parameters = Array();
                $parameters["id_movie"] = $bill->getMovie();
                $parameters["id_cinema"] = $bill->getCinema();

                $this->connection = Connection::GetInstance();

                $rowCount = $this->connection->ExecuteNonQuery($query, $parameters);
                $id = $this->connection->getPdo()->lastInsertId();
                $this->AddDate($bill->getDay(), $bill->getHour(), $bill->getSaloon(), $id);
                if($rowCount > 0)
                    $flag = true;
            } catch(Exception $e) {
                //throw $e;
            }
            return $flag;
        }

        public function AddDate($days, $hours, $saloon, $id) {
            for($i = 0; $i < count($days); $i++) {
                try {


                    $query = "INSERT INTO" . " dates " . "(id_billboard, days, hours, id_saloon) VALUES (:id_billboard, :days, :hours, :id_saloon);";

                    $parameters = Array();
                    $parameters["id_billboard"] = $id;
                    $parameters["days"] = $days[$i];
                    $parameters["hours"] = $hours[$i];
                    $parameters["id_saloon"] = $saloon[$i];

                    $this->connection = Connection::GetInstance();

                    $this->connection->ExecuteNonQuery($query, $parameters);
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

                $query = "select d.days as 'day', d.hours as 'hour', d.id_saloon as 'saloon', b.id_movie as 'idMovie', c.id_cinema as 'cinema', b.id_billboard as 'id'
                from billboard as b
                join dates as d
                on b.id_billboard = d.id_billboard
                join cinemas as c
                on b.id_cinema = c.id_cinema";
                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);

                $this->saloonDAO = new SaloonDAO();
                $this->movieDAO = new MovieDAO();
                $this->cinemaDAO = new cinemaDAO();

                foreach ($resultSet as $row):
                    $flag = false;
                    foreach($billboardList as $bill) {
                        if($bill->getId() == $row["id"]) {
                            $auxDate = $bill->getDay();
                            $auxHour = $bill->getHour();
                            $auxSaloon = $bill->getSaloon();
                            array_push($auxDate, $row["day"]);
                            array_push($auxHour, $row["hour"]);
                            array_push($auxSaloon, $this->saloonDAO->GetSalonById($row["saloon"])[0]);
                            $bill->setDay($auxDate);
                            $bill->setHour($auxHour);
                            $bill->setSaloon($auxSaloon);
                            $flag = true;
                        }
                    }
                    if(!$flag) {
                        $billboard = new Billboard(Array($row["day"]), Array($row["hour"]), $this->movieDAO->getMovieById($row["idMovie"]), $this->cinemaDAO->GetCinemaById($row["cinema"]), $row["id"], $this->saloonDAO->GetSalonById($row["saloon"]));

                        array_push($billboardList, $billboard);
                    }

                endforeach;
                return $billboardList;
            } catch(Exception $e) {
                throw $e;
            }

        }

        public function Delete($id_billboard)
        {
          $query = "DELETE FROM billboard WHERE (id_billboard = :id_billboard)";

          try {

            $this->connection = Connection::getInstance();

            $parameters['id_billboard'] = $id_billboard;

            return $this->connection->ExecuteNonQuery($query, $parameters);

          } catch (PDOException $e) {
            echo $e->getMessage();
          }
          catch(Exception $e){
              echo $e->getMessage();
            }
        }

        public function Update($id_cinema, $id_movie, $id_billboard)
        {

          $query = "
          UPDATE billboard as b
          SET 
            b.id_cinema = :id_cinema, 
            b.id_movie = :id_movie 
          WHERE 
            id_billboard = :id_billboard;";
          $flag = false;
          try {

            $this->connection = Connection::getInstance();

            $parameters = array();
            $parameters["id_cinema"] = $id_cinema;
            $parameters["id_movie"] = $id_movie;
            $parameters["id_billboard"] = $id_billboard;

            $rowCount = $this->connection->executeNonQuery($query, $parameters);

            if($rowCount == 1)
                {
                  $flag = true;
                }

          }catch (PDOException $e) {
            //echo $e->getMessage();
          }
          catch(Exception $e){
              //echo $e->getMessage();
            }finally {
              return $flag;
            }
        }

        public function UpdateDate($id_billboard, $days, $hours, $id_saloon, $id_dates)
        {
          for($i = 0; $i < count($days); $i++) {
          try
          {
          $query = "UPDATE dates SET id_billboard = :id_billboard, days = :days, hours = :hours, id_saloon = :id_saloon WHERE id_dates = :id_dates";
          $flag = false;


            $this->connection = Connection::getInstance();

            $parameters = array();
            $parameters["id_billboard"] = $id;
            $parameters["days"] = $days[$i];
            $parameters["hours"] = $hours[$i];
            $parameters["id_saloon"] = $saloon[$i];

            $parameters["id_dates"] = $id_dates;

            $rowCount = $this->connection->executeNonQuery($query, $parameters);

            if($rowCount == 1)
                {
                  $flag = true;
                }

          }catch (PDOException $e) {
            //echo $e->getMessage();
          }
          catch(Exception $e){
              //echo $e->getMessage();
            }finally {

              return $rowCount;
            }
          } //cierre del for
             
        }

        private function mapear($value) {
            $value = is_array($value) ? $value : [];
            $resp = array_map(function($p){
                return new Billboard(Array($p["day"]), Array($p["hour"]), $p["idMovie"], $p["cinema"], $p["id"], $p["id_saloon"]);
            }, $value);
               return count($resp) > 1 ? $resp : $resp['0'];
        }

    }
