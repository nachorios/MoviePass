<?php namespace Daos;

use \Exception as Exception;
use \PDOException as PDOException;
use Models\Cinema as Cinema;
use Daos\Connection as Connection;
use Models\Saloon as Saloon;

class SaloonDAO{

    private $connection;
    private $tableName = "saloon";

    public function Add($saloon, $id){
      $flag = false;
        try{
        $query = "INSERT INTO saloon (name, capacity, entry_value, id_cinema) VALUES (:name, :capacity, :entry_value, :id_cinema)";

        $this->connection = Connection::GetInstance();

        $parameters["name"] = $saloon->getName();
        $parameters["capacity"] = $saloon->getCapacity();
        $parameters["entry_value"] = $saloon->getValue();
        $parameters["id_cinema"] = $id;


        $rowCount = $this->connection->ExecuteNonQuery($query, $parameters);
        if($rowCount > 0)
          $flag = true;
        }catch(Exception $e) {
            //throw $e;
        }

        return $flag;
    }

    public function GetCinemaSaloonById($id_cinema){
        try{
            $query =" select saloon.*
            from saloon

            where saloon.id_cinema = :id_cinema";

            $this->connection = Connection::GetInstance();

            $parameters['id_cinema'] = $id_cinema;

            $resultSet = $this->connection->execute($query, $parameters);

        }catch(Exception $e) {
            throw $e;
        }
        if(!empty($resultSet))
        {
            return $this->mapear($resultSet);
        }
        else
            return null;
    }

    public function GetById($id_saloon){
      try{
        $query =" select s.id_saloon, s.name, s.capacity, s.entry_value, s.id_cinema
          from saloon as s
          where s.id_saloon = :id_saloon";

          $this->connection = Connection::GetInstance();

          $parameters['id_saloon'] = $id_saloon;

          $resultSet = $this->connection->execute($query, $parameters);

      }catch(Exception $e) {
          throw $e;
      }
      if(!empty($resultSet))
      {
          return $this->mapear($resultSet);
      }
      else
          return null;
  }


    public function Update($saloon, $id_saloon)
    {
      $query = "UPDATE saloon SET name = :name, capacity = :capacity, entry_value = :entry_value WHERE id_saloon = :id_saloon";
      $flag = false;
      try
      {
        $this->connection = Connection::getInstance();
        $parameters = array();
        $parameters["name"] = $saloon->getName();
        $parameters["capacity"] = $saloon->getCapacity();
        $parameters["entry_value"] = $saloon->getValue();

        $parameters["id_saloon"] = $id_saloon;

        $rowCount = $this->connection->executeNonQuery($query, $parameters);
        if($rowCount > 0)
          $flag = true;

      }catch (PDOException $e) {
        //echo $e->getMessage();
      }
      catch(Exception $e){
          //echo $e->getMessage();
        }
        return $flag;
    }

    public function Delete($id_saloon)
    {
      $query = "DELETE FROM saloon WHERE (id_saloon = :id_saloon)";

      try {

        $this->connection = Connection::getInstance();

        $parameters['id_saloon'] = $id_saloon;

        return $this->connection->ExecuteNonQuery($query, $parameters);

      } catch (PDOException $e) {
        echo $e->getMessage();
      }
      catch(Exception $e){
          echo $e->getMessage();
        }
    }

    public function GetAll()
    {

    }

    private function mapear($value) {
        $value = is_array($value) ? $value : [];
        $resp = array_map(function($p){
            return new Saloon($p["name"], $p["capacity"], $p["entry_value"], $p["id_saloon"], $p["id_cinema"]);
        }, $value);
           return count($resp) > 1 ? $resp : $resp[0];
    }


}
