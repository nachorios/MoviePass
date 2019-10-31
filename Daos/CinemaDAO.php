<?php namespace Daos;

use \Exception as Exception;
use Models\Cinema as Cinema;
use Daos\Connection as Connection;
use Interfaces\IDAO as IDAO;

class CinemaDAO{

    private $connection;
    private $tableName = "cinemas";

    public function Add(Cinema $cinema){
        try{
            $query = ("INSERT INTO $this->tableName (name, capacity, address, entry_value) VALUES (:name, :capacity, :address, :entry_value)");

            $this->connection = Connection::GetInstance();

            $parameters["name"] = $cinema->getName();
            $parameters["capacity"] = 4;//$cinema->getCapacity();
            $parameters["address"] = $cinema->getAdress();
            $parameters["entry_value"] = 4;//$cinema->getValue();

/*            $parameters->bindParam("name",$parameters["name"]);
            $parameters->bindParam("capacity",$parameters["capacity"]);
            $parameters->bindParam("addres",$parameters["addres"]);
            $parameters->bindParam("entry_value",$parameters["entry_value"]);*/

            //id_cinema 	name 	capacity 	address 	entry_value

//            die(var_dump($parameters["entry_value"]));



            $this->connection->ExecuteNonQuery($query, $parameters);

      }catch(\PDOException $e){
          echo $e->getMessage();die();
      }catch(\Exception $e){
          echo $e->getMessage();die();
      }
  }


    public function GetAll()
    {
      $sql = "SELECT * FROM $this->tableName";

      try {

        $this->connection = Connection::GetInstance();
        $this->connection->execute($sql);

      } catch (PDOException $e) {
        throw $e;
      }
    }

    public function Update()
    {

    }

    public function Delete()
    {

    }
}
