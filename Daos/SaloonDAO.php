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
        
            where saloon.id_cinema = id";

            $this->connection = Connection::GetInstance();

            $parameters['id'] = $id;

            $resultSet = $this->connection->execute($query, $parameters);

        }catch(Exception $e) {
            throw $e;
        }
        if(!empty($resultSet))
        {
            return $this->mapear($resultSet);
        }
        else
            return false;
    }


    private function mapear($value) {
        $value = is_array($value) ? $value : [];
        $resp = array_map(function($p){
            return new Saloon($p["name"], $p["capacity"], $p["entry_value"], $p["id_cinema"]);
        }, $value);
           return count($resp) > 1 ? $resp : $resp['0'];
    }


}