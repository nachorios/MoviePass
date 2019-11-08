<?php namespace Daos;

use \Exception as Exception;
use \PDOException as PDOException;
use Models\Cinema as Cinema;
use Daos\Connection as Connection;

class SaloonDAO{

    private $connection;
    private $tableName = "saloon";

    public function Add(Saloon $saloon, $id){
        
        try{
        $query = "INSERT INTO saloon (name, capacity, entry_value, id_cinema) VALUES (:name, :capacity, :address, :entry_value, :id_cinema)";
    
        $this->connection = Connection::GetInstance();
            
        $parameters["name"] = $cinema->getName();
        $parameters["capacity"] = $cinema->getCapacity();
        $parameters["entry_value"] = $cinema->getValue();
        $parameters["id_cinema"] = $id;


        $rowCount = $this->connection->ExecuteNonQuery($query, $parameters);
        }catch(Exception $e) {
            throw $e;
        }
    
    
    }

    public function GetXCinema($id){
        try{
            $query =" select saloon.*
            from saloon
            join cinemas
            on saloon.id_cinema = cinemas.id_cinema";

            $this->connection = Connection::GetInstance();


        }catch(Exception $e) {
            throw $e;
        }
    }


    private function mapear($value) {
        $value = is_array($value) ? $value : [];
        $resp = array_map(function($p){
            return new Billboard(Array($p["day"]), Array($p["hour"]), $p["idMovie"], $p["cinema"], $p["id"]);
        }, $value);
           return count($resp) > 1 ? $resp : $resp['0'];
    }


}