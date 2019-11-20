<?php namespace Daos;

use \Exception as Exception;
use Models\Buyout as Buyout;
use Daos\MovieDAO as MovieDAO;
use Daos\CinemaDAO as cinemaDAO;
use Daos\FunctionDAO as FunctionDAO;

class BuyoutDAO{
    private $connection;
    private $tableName = "buyouts";
    private $functionDAO;
    private $movieDAO;
    private $cinemaDAO;

    public function __construct() {
        $this->functionDAO = new FunctionDAO();
        $this->movieDAO = new MovieDAO();
        $this->cinemaDAO = new cinemaDAO();
    }

    public function Add(Buyout $buyout, $mail, $credit_number){
        $flag = false;
        try{
            $query = "INSERT INTO buyouts (quan, total, id_movie, id_cinema, mail, id_function, date, credit_number)
                                   VALUES (:quan, :total, :id_movie, :id_cinema, :mail, :id_function, :date, :credit_number);";

            $parameters = Array();
            $parameters["quan"] = $buyout->getQuan();
            $parameters["date"] = $buyout->getDate();
            $parameters["total"] = $buyout->getTotal();
            $parameters["id_movie"] = $buyout->getMovie();
            $parameters["id_cinema"] = $buyout->getCinema();
            $parameters["id_function"] = $buyout->getFunction();
            $parameters["mail"] = $mail;
            $parameters["credit_number"] = $credit_number;

            $this->connection = Connection::GetInstance();
            $proof = $this->connection->executeNonQuery($query, $parameters);
            if($proof > 0)
                $flag = true;
        }catch(Exception $e) {
            throw $e;
        }
        return $flag;
    }

    public function GetAll() {
        $query = "select * from buyouts;";
        $result = array();
          try {
              $this->connection = Connection::GetInstance();
              $resultSet = $this->connection->Execute($query);
              if(!empty($resultSet)) {
                $result = $this->mapear($resultSet);
              }

          } catch(Exception $e) {
              //throw $e;
          }
          return $result;
      }

    public function GetCountMovieTickets($id_movie) {
        $query = "select sum(b.quan) as 'cantidad'
        from buyouts as b
        where b.id_movie = :id_movie";
        $result = 0;

        $parameters = Array();
        $parameters["id_movie"] = $id_movie;
            try {
                $this->connection = Connection::GetInstance();
                $result = $this->connection->Execute($query, $parameters);
                $result = $result[0][0];
            } catch(Exception $e) {
                //throw $e;
            }
        return $result;
    }

    public function GetCountCinemaTickets($id_cinema) {
        $query = "select sum(b.quan)
        from buyouts as b
        where b.id_cinema = :id_cinema;";
        $result = 0;

        $parameters = Array();
        $parameters["id_cinema"] = $id_cinema;
            try {
                $this->connection = Connection::GetInstance();
                $result = $this->connection->Execute($query, $parameters);
                $result = $result[0][0];
            } catch(Exception $e) {
                //throw $e;
            }
        return $result;
    }

    public function GetCountSaloonTickets($id_saloon) {
        $query = "select sum(b.quan)
        from buyouts as b
        join functions as f
        on b.id_function = f.id_function AND f.id_saloon = :id_saloon;";
        $result = 0;

        $parameters = Array();
        $parameters["id_saloon"] = $id_saloon;
            try {
                $this->connection = Connection::GetInstance();
                $result = $this->connection->Execute($query, $parameters);
                $result = $result[0][0];
            } catch(Exception $e) {
                //throw $e;
            }
        return $result;
    }

    public function GetAmountMovieTickets($id_movie, $date_start = null, $date_end = null) {
        $query = "select ifnull(sum(b.total),0)
        from buyouts as b
        where b.id_movie = :id_movie";
        if($date_start && $date_end) {
            $query .= " AND b.date BETWEEN '$date_start' AND '$date_end';"; //no me permite colocar comillas
            
            /*$query .= " AND b.date BETWEEN :date_start AND :date_end;";
            $parameters["date_start"] = $date_start;
            $parameters["date_end"] = $date_end;*/
        }
        $result = 0;

        $parameters["id_movie"] = $id_movie;
            try {
                $this->connection = Connection::GetInstance();
                $result = $this->connection->Execute($query, $parameters);
                $result = $result[0][0];
            } catch(Exception $e) {
                echo $e->getMessage();
            }
        return $result;
    }

    public function GetTicketsByUserMail($mail) {
        $query = "select * from buyouts where mail = :mail;";
        $result = array();
        $parameters["mail"] = $mail;
          try {
              $this->connection = Connection::GetInstance();
              $resultSet = $this->connection->Execute($query, $parameters);
              if(!empty($resultSet)) {
                $result = $this->mapear($resultSet);
              }

          } catch(Exception $e) {
              //throw $e;
          }
          return $result;
    }

    public function GetAmountCinemaTickets($id_cinema, $date_start = null, $date_end = null) {
        $query = "select ifnull(sum(b.total),0)
        from buyouts as b
        where b.id_cinema = :id_cinema";
        if($date_start && $date_end) {
            $query .= " AND b.date BETWEEN '$date_start' AND '$date_end';"; //no me permite colocar comillas
            
            /*$query .= " AND b.date BETWEEN :date_start AND :date_end;";
            $parameters["date_start"] = $date_start;
            $parameters["date_end"] = $date_end;*/
        }
        $result = 0;

        $parameters["id_cinema"] = $id_cinema;
            try {
                $this->connection = Connection::GetInstance();
                $result = $this->connection->Execute($query, $parameters);
                $result = $result[0][0];
            } catch(Exception $e) {
                //throw $e;
            }
        return $result;
    }

    public function Delete($id_buyout)
    {
      $query = "DELETE FROM buyouts WHERE (id_buyout = :id_buyout)";
      $flag = false;
      try {

        $this->connection = Connection::getInstance();

        $parameters['id_buyout'] = $id_buyout;

        $proof = $this->connection->ExecuteNonQuery($query, $parameters);
        if($proof > 0)
          $flag = true;
      } catch (PDOException $e) {
        throw $e->getMessage();
      }
      catch(Exception $e){
        throw $e->getMessage();
      }
      return $flag;
    }

    public function GetId($date){
        $query = "select buyouts.id_buyout
        from buyouts
        where buyouts.date = :date";
        $result = 0;
        try{
            $parameters["date"] = $date;
            $this->connection = Connection::GetInstance();
            $result = $this->connection->Execute($query, $parameters);
            $result = $result[0][0];
        }catch(Exception $e) {
            //throw $e;
        }

        return $result;
    }

    private function mapear($value) {
        $value = is_array($value) ? $value : [];
        $resp = array_map(function($p){
            return new Buyout($p["quan"], $p["total"], $this->movieDAO->GetById($p['id_movie']), $this->cinemaDAO->GetById($p['id_cinema']), $this->functionDAO->GetById($p['id_function']), $p["date"]);
        }, $value);
           return count($resp) > 1 ? $resp : $resp['0'];
    }

}
