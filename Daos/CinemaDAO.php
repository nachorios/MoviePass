<?php namespace Daos;

use \Exceotion as Exception;
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
        }
    }
}