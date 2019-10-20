<?php namespace Daos;

use \Exception as Exception;
use Models\Cinema as Cinema;
use Daos\Connection as Connection;

class CinemaDAO {

    private $connection;
    private $tableName = "Cinema";

    public function Add(Cinema $cinema){
        try{
            $query = "INSERT INTO" . $this->tableName . "(name, capacity, adress, value) VALUES (:name, :capacity, :adress, :value)";

            $parameters["name"] = $cinema->getName();
            $parameters["capacity"] = $cinema->getCapacity();
            $parameters["adress"] = $cinema->getAdress();
            $parameters["value"] = $cinema->getValue();

            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query, $parameters);
        }
        catch(Exception $e) {
        throw $e;
        }
    }
}
