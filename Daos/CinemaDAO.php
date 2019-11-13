<?php namespace Daos;

use \Exception as Exception;
use \PDOException as PDOException;
use Models\Cinema as Cinema;
use Daos\SaloonDAO as SaloonDAO;
use Daos\Connection as Connection;
use Interfaces\IDAO as IDAO;

class CinemaDAO{

    private $connection;
    private $saloonDAO;

    public function getConnection() {
      return $this->connection;
    }

    public function Add($cinema){

            $query = "INSERT INTO cinemas (name, address/*, saloon*/) VALUES (:name, :address/*, :saloon*/)";

      try{
            $this->connection = Connection::GetInstance();

            $flag = false;
            $parameters["name"] = $cinema->getName();
            $parameters["address"] = $cinema->getAdress();
            //$parameters["saloon"] = $cinema->getSaloon();


            $rowCount = $this->connection->ExecuteNonQuery($query, $parameters);

            if($rowCount == 1) //si el cine fue cargado con exito ExecuteNonQuery devuelve 1 (que es la cantidad de filas modificadas)
            {
              $flag = true; //retorno el flag para mostrar el modal
            }

      }catch(PDOException $e){

        echo $e->getMessage(); //lo elevo para que no lo muestre

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


    public function Update(Cinema $cinema, $id_cinema)
    {
      $query = "UPDATE cinemas SET name = :name, address = :address WHERE id_cinema = :id_cinema";
      try
      {
        $this->connection = Connection::getInstance();
        $parameters = array();
        $parameters["name"] = $cinema->getName();
        $parameters["address"] = $cinema->getAdress();
        //$parameters["saloon"] = $cinema->getSaloon();

        $parameters["id_cinema"] = $id_cinema;

        $rowCount = $this->connection->executeNonQuery($query, $parameters);


      }catch (PDOException $e) {
        echo $e->getMessage();
      }
      catch(Exception $e){
          echo $e->getMessage();
        } finally {

          return $rowCount;
        }
    }

    public function Delete($id_cinema)
    {
      $query = "DELETE FROM cinemas WHERE (id_cinema = :id_cinema)";

      try {

        $this->connection = Connection::getInstance();

        $parameters['id_cinema'] = $id_cinema;

        return $this->connection->ExecuteNonQuery($query, $parameters);

      } catch (PDOException $e) {
        echo $e->getMessage();
      }
      catch(Exception $e){
          echo $e->getMessage();
        }
    }

    protected function mapear($value)
    {
    $this->saloonDAO = new SaloonDAO();
		$value = is_array($value) ? $value : [];

		$resp = array_map(function($p){

			//$cinema = new Cinema();
            //$cinema->setName($p['name']);

            //return $cinema;

		    return new Cinema( $p['name'], $p['address'],$this->saloonDAO->GetXCinema($p['id_cinema']),$p['id_cinema']); //(asi tengo los datos en la bbdd de phpmyadmin)
     }, $value);

        /* devuelve un arreglo si tiene datos y sino devuelve nulo*/
     return count($resp) > 0 ? $resp : $resp;
  }

}

