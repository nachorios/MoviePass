<?php namespace Daos;

use \Exception as Exception;
use \PDOException as PDOException;
use Models\Cinema as Cinema;
use Daos\Connection as Connection;
use Interfaces\IDAO as IDAO;

class CinemaDAO{

    private $connection;
    private $tableName = "cinemas";

    public function Add($cinema){

            $query = "INSERT INTO cinemas (name, capacity, address, entry_value) VALUES (:name, :capacity, :address, :entry_value)";

      try{
            $this->connection = Connection::GetInstance();

            $flag = false;
            $parameters["name"] = $cinema->getName();
            $parameters["capacity"] = $cinema->getCapacity();
            $parameters["address"] = $cinema->getAdress();
            $parameters["entry_value"] = $cinema->getValue();


            $rowCount = $this->connection->ExecuteNonQuery($query, $parameters);
            /*echo "<pre>";
            var_dump($rowCount);
            echo "</pre>";*/
            if($rowCount == 1) //si el cine fue cargado con exito ExecuteNonQuery devuelve 1
            {
              $flag = true; //retorno el flag para mostrar el modal
            }

            return $flag;

      }catch(PDOException $e){
          echo $e->getMessage();
      }catch(Exception $e){
          echo $e->getMessage();
      }
  }


    public function GetAll()
    {
      $sql = "SELECT * FROM cinemas";

      try {

        $this->connection = Connection::getInstance();
        $resultSet = $this->connection->execute($sql);

      } catch (PDOException $e) {
        throw $e;
      }
      if(!empty($resultSet))
        {
            return $this->mapear($resultSet);
        }
        else
            return false;
    }

    public function Update()
    {

    }

    public function Delete()
    {

    }

    protected function mapear($value)
    {
		$value = is_array($value) ? $value : [];

		$resp = array_map(function($p){

			//$cinema = new Cinema();
            //$cinema->setName($p['name']);
            //$cinema->setCapacity($p['capacity']);

            //return $cinema;

		    return new Cinema( $p['name'], $p['capacity'], $p['address'],$p['entry_value']); //(asi tengo los datos en la bbdd de phpmyadmin)
     }, $value);

        /* devuelve un arreglo si tiene datos y sino devuelve nulo*/
     return count($resp) > 0 ? $resp : null;
}
}
