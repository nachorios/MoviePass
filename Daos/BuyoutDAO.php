<?php namespace Daos;

use \Exception as Exception;
use Models\Buyout as Buyout;

class BuyoutDAO{
    private $connection;
    private $tableName = "buyouts";

    public function Add(Buyout $buyout, $mail, $credit_number){
        try{
            $query = "INSERT INTO buyouts (quan, total, id_movie, id_cinema, mail, id_function, date, credit_number) 
                                   VALUES (:quan, :total, :id_movie, :id_cinema, :mail, :id_function, :date, :credit_number);";
            
            $parameters = Array();
            $parameters["quan"] = $buyout->getQuan();
            $parameters["date"] = $buyout->getDate();
            $parameters["total"] = $buyout->getTotal();
            $parameters["id_movie"] = $buyout->getIdMovie();
            $parameters["id_cinema"] = $buyout->getIdCinema();
            $parameters["id_function"] = $buyout->getIdFunction();
            $parameters["mail"] = $mail;
            $parameters["credit_number"] = $credit_number;

            $this->connection = Connection::GetInstance();
            $this->connection->executeNonQuery($query, $parameters);

        }catch(Exception $e) {
            throw $e;
        }
    } 

    private function mapear($value) {
        $value = is_array($value) ? $value : [];
        $resp = array_map(function($p){
            return new Buyout($p["quan"], $p["disc"], $p["date_buyout"], $p["total"], $p["id_movie"], $p["id_cinema"]);
        }, $value);
           return count($resp) > 1 ? $resp : $resp['0'];
    }

}
