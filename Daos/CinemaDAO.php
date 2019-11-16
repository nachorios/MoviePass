<?php namespace Daos;

use \Exception as Exception;
use \PDOException as PDOException;
use Models\Cinema as Cinema;
use Daos\Connection as Connection;
use Daos\SaloonDAO as SaloonDAO;
use Interfaces\IDAO as IDAO;

class CinemaDAO{

  private $connection;
  private $saloonDAO;

  public function getConnection() {
    return $this->connection;
  }

  public function Add($cinema){

    $query = "INSERT INTO cinemas (name, address) VALUES (:name, :address)";

    $flag = false;
    try{
      $this->connection = Connection::GetInstance();

      $parameters["name"] = $cinema->getName();
      $parameters["address"] = $cinema->getAdress();

      $rowCount = $this->connection->ExecuteNonQuery($query, $parameters);

      if($rowCount == 1) //si el cine fue cargado con exito ExecuteNonQuery devuelve 1 (que es la cantidad de filas modificadas)
      {
        $flag = true; //retorno el flag para mostrar el modal
      }

    }catch(PDOException $e){
      //echo $e->getMessage();
    }catch(Exception $e){
      //echo $e->getMessage();
    }
    return $flag;
  }


  public function GetAll()
  {
    $sql = "SELECT * FROM cinemas";
    $result = array();
    
    try {
      $this->connection = Connection::getInstance();
      $resultSet = $this->connection->execute($sql);
      if(!empty($resultSet))
      {
        $result = $this->mapear($resultSet);
      }
    } catch (PDOException $e) {
      //throw $e;
    } catch(Exception $e){
      //echo $e->getMessage();
    }
    return $result;
  }

  public function GetById($id_cinema){
    $query =" select c.* from cinemas as c where c.id_cinema = :id_cinema;";
    $result = false;
    $parameters = array();
    $parameters['id_cinema'] = $id_cinema;
    try{
        $this->connection = Connection::GetInstance();

        $resultSet = $this->connection->execute($query, $parameters);
        if(!empty($resultSet))
        {
            $result = $this->mapear($resultSet);
        }
    }catch(Exception $e) {
        throw $e;
    }
    return $result;
  }

  public function Update(Cinema $cinema, $id_cinema) {
    $query = "UPDATE cinemas SET name = :name, address = :address WHERE id_cinema = :id_cinema";
    $flag = false;
    try {
      $this->connection = Connection::getInstance();
      $parameters = array();
      $parameters["name"] = $cinema->getName();
      $parameters["address"] = $cinema->getAdress();
      //$parameters["saloon"] = $cinema->getSaloon();

      $parameters["id_cinema"] = $id_cinema;

      $rowCount = $this->connection->executeNonQuery($query, $parameters);

      if($rowCount == 1) //si el cine fue cargado con exito ExecuteNonQuery devuelve 1 (que es la cantidad de filas modificadas)
        $flag = true; //retorno el flag para mostrar el modal

    }catch (PDOException $e) {
      //echo $e->getMessage();
    }
    catch(Exception $e){
      //echo $e->getMessage();
    }
    return $flag;
  }

  public function Delete($id_cinema) {
    
    $query = "DELETE FROM cinemas WHERE (id_cinema = :id_cinema)";
    $flag = false;
    try {

      $this->connection = Connection::getInstance();

      $parameters['id_cinema'] = $id_cinema;

      $proof = $this->connection->ExecuteNonQuery($query, $parameters);
      if($proof > 0)
        $flag = true;
    } catch (PDOException $e) {
      //echo $e->getMessage();
    }
    catch(Exception $e){
      //echo $e->getMessage();
    }
    return $flag;
  }

  protected function mapear($value) {
    $this->saloonDAO = new SaloonDAO();
    $value = is_array($value) ? $value : [];

    $resp = array_map(function($p){
      return new Cinema($p['name'], $p['address'],$this->saloonDAO->GetCinemaSaloonById($p['id_cinema']),$p['id_cinema']); //(asi tengo los datos en la bbdd de phpmyadmin)
    }, $value);
    return count($resp) > 1 ? $resp : $resp[0];
  }
}