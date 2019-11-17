<?php namespace Daos;

use \Exception as Exception;
use Models\Buyout as Buyout;

class BuyoutDAO{
    private $connection;
    private $tableName = "buyouts";

    public function Add(Buyout $buyout, $mail){
        try{
            $query = "INSERT INTO " . $this->tableName . "(quan, disc, date_buyout, total, id_movie, id_cinema, mail) VALUES (:quan, :id_cinema, :date_buyout, :total, :id_movie, :id_cinema, :mail);";
            
            $parameters = Array();
            $parameters["quan"] = $buyout->getQuan();
            $parameters["disc"] = $buyout->getDisc();
            $parameters["date_buyout"] = $buyout->getDate();
            $parameters["total"] = $buyout->getTotal();
            $parameters["id_movie"] = $buyout->getIdMovie();
            $parameters["id_cinema"] = $buyout->getIdCinema();
            $parameters["mail"] = $mail;

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
