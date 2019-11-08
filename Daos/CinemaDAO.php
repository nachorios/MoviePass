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

            if($rowCount == 1) //si el cine fue cargado con exito ExecuteNonQuery devuelve 1 (que es la cantidad de filas modificadas)
            {
              $flag = true; //retorno el flag para mostrar el modal
            }

      }catch(PDOException $e){

        throw $e->getMessage(); //lo elevo para que no lo muestre

      }catch(Exception $e){
          echo $e->getMessage();

      }finally{
        return $flag;
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
      catch(Exception $e){
          echo $e->getMessage();
        }
      if(!empty($resultSet))
        {
            return $this->mapear($resultSet);
        }
        else
            return false;
    }


    public function Update(Cinema $cinema, $oldName)
    {
      $query = "UPDATE cinemas SET name = :name, capacity = :capacity, address = :address, entry_value = :entry_value  WHERE name = :oldName";

      try
      {
        $this->connection = Connection::getInstance();
        $parameters = array();
        $parameters["name"] = $cinema->getName();
        $parameters["capacity"] = $cinema->getCapacity();
        $parameters["address"] = $cinema->getAdress();
        $parameters["entry_value"] = $cinema->getValue();

        $parameters["oldName"] = $oldName;

        $rowCount = $this->connection->executeNonQuery($query, $parameters);

        return $rowCount;

      }catch (PDOException $e) {
        throw $e->getMessage();
      }
      catch(Exception $e){
          echo $e->getMessage();
        }
    }

    public function Delete($name)
    {
      $query = "DELETE FROM cinemas WHERE (name = :name)";

      try {

        $this->connection = Connection::getInstance();

        $parameters['name'] = $name;

        return $this->connection->ExecuteNonQuery($query, $parameters);

      } catch (PDOException $e) {
        throw $e->getMessage();
      }
      catch(Exception $e){
          echo $e->getMessage();
        }
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
