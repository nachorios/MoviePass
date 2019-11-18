<?php namespace Daos;

use \Exception as Exception;
use Models\Buyout as Buyout;
use Daos\MovieDAO as MovieDAO;
use Daos\cinemaDAO as cinemaDAO;
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
            $this->connection->executeNonQuery($query, $parameters);

        }catch(Exception $e) {
            throw $e;
        }
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
        $query = "select count(b.quan) as 'cantidad'
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
        $query = "select count(b.quan) 
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

    public function GetAmountMovieTickets($id_movie, $date_start = null, $date_end = null) {
        $query = "select ifnull(sum(b.total),0)
        from buyouts as b
        where b.id_movie = :id_movie";
        if($date_start && $date_end) {
            $query .= " AND b.date BETWEEN :date_start AND :date_end;";
            $parameters["date_start"] = $date_start;
            $parameters["date_end"] = $date_end;
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
            $query .= " AND b.date BETWEEN :date_start AND :date_end;";
            $parameters["date_start"] = $date_start;
            $parameters["date_end"] = $date_end;
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

    private function mapear($value) {
        $value = is_array($value) ? $value : [];
        $resp = array_map(function($p){
            return new Buyout($p["quan"], $p["total"], $this->movieDAO->GetById($p['id_movie']), $this->cinemaDAO->GetById($p['id_cinema']), $this->functionDAO->GetById($p['id_function']), $p["date"]);
        }, $value);
           return count($resp) > 1 ? $resp : $resp['0'];
    }

}
