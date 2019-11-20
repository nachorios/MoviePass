<?php namespace Daos;

  use \Exception as Exception;
  use Models\FunctionMovie as FunctionMovie;
  use Daos\Connection as Connection;
  use Daos\SaloonDAO as SaloonDAO;

  class FunctionDAO{

    private $connection;
    private $saloonDAO;
    private $tableName = "functions";

    public function __construct() {
        $this->saloonDAO = new SaloonDAO();
    }

    public function Add($date, $hour, $id_saloon, $id_billboard) {

        $flag = false;
        //$sql = "INSERT INTO $this->tableName (id_billboard, date, hour, id_saloon) VALUES (:id_billboard, :date, :hour, :id_saloon);";
        $sql = "INSERT INTO functions (id_billboard, date, hour, id_saloon) 
        SELECT :id_billboard, :date, :hour, :id_saloon
        WHERE NOT EXISTS (
            SELECT * 
            FROM functions as f
            WHERE f.date = :date AND (STR_TO_DATE(f.hour, '%H:%i:%s') BETWEEN (STR_TO_DATE(:hour, '%H:%i:%s') - INTERVAL 15 MINUTE) AND (STR_TO_DATE(:hour, '%H:%i:%s') + INTERVAL 15 MINUTE))
        ) LIMIT 1;";

        $parameters = Array();
        $parameters["id_billboard"] = $id_billboard;
        $parameters["date"] = $date;
        $parameters["hour"] = $hour;
        $parameters["id_saloon"] = $id_saloon;

        try {
            $this->connection = Connection::GetInstance();

            $proof = $this->connection->ExecuteNonQuery($sql, $parameters);

            if($proof > 0)
                $flag = true;
        } catch(Exception $e) {
            //throw $e;
        }
        return $flag;
    }

    public function GetAll() {
        $sql = "SELECT * FROM $this->tableName;";

        $result = array();
        try {
            $this->connection = Connection::getInstance();
            $resultSet = $this->connection->execute($sql);
            
            if(!empty($resultSet))
                $result = $this->mapear($resultSet);
        } catch (PDOException $e) {
            //throw $e;
        } catch(Exception $e){
            //echo $e->getMessage();
        }
        return $result;
    }

    public function GetFunctionsByBillboardId($id_billboard) {
        $sql = "SELECT * FROM $this->tableName where id_billboard = :id_billboard;";
        $result = array();

        $parameters = array();
        $parameters['id_billboard'] = $id_billboard;
        try {
            $this->connection = Connection::getInstance();

            $resultSet = $this->connection->execute($sql, $parameters);
            if(!empty($resultSet))
                $result = $this->mapear($resultSet);
            if(!is_array($result)) {
                $result = array($result);
            }
        } catch (PDOException $e) {
            //throw $e;
        } catch(Exception $e){
            //echo $e->getMessage();
        }
        return $result;
    }

    public function GetById($id_function) {
        $sql = "SELECT * FROM $this->tableName where id_function = :id_function;";
        $result = null;

        $parameters = array();
        $parameters['id_function'] = $id_function;
        try {
            $this->connection = Connection::getInstance();

            $resultSet = $this->connection->execute($sql, $parameters);
            if(!empty($resultSet))
                $result = $this->mapear($resultSet);
        } catch (PDOException $e) {
            //throw $e;
        } catch(Exception $e){
            //echo $e->getMessage();
        }
        return $result;
    }

    public function Update($date, $hour, $id_saloon, $id_function) {
        try {
        //$sql = "UPDATE $this->tableName SET date = :date, hour = :hour, id_saloon = :id_saloon WHERE id_function = :id_function;";
        $sql = "UPDATE functions as f
        SET date = :date, hour = :hour, id_saloon = :id_saloon
        WHERE id_function = :id_function AND NOT EXISTS ( 
            SELECT * 
            FROM (SELECT * FROM functions) as t
            WHERE t.date = :date AND t.id_function != :id_function AND (((STR_TO_DATE(t.hour, '%H:%i:%s') BETWEEN (STR_TO_DATE(:hour, '%H:%i:%s') - INTERVAL 15 MINUTE) AND (STR_TO_DATE(:hour, '%H:%i:%s') + INTERVAL 15 MINUTE))))
        ) LIMIT 1;";
        $flag = false;

        $this->connection = Connection::getInstance();

        $parameters = array();
        $parameters["date"] = $date;
        $parameters["hour"] = $hour;
        $parameters["id_saloon"] = $id_saloon;
        $parameters["id_function"] = $id_function;

        $rowCount = $this->connection->executeNonQuery($sql, $parameters);

        if($rowCount == 1)
            $flag = true;

        }catch (PDOException $e) {
          //echo $e->getMessage();
        } catch(Exception $e){
            //echo $e->getMessage();
        }
        return $flag; 
    }

    public function Delete($id_function)
    {
        $query = "DELETE FROM $this->tableName WHERE (id_function = :id_function);";
        $flag = false;
        try {

            $this->connection = Connection::getInstance();

            $parameters['id_function'] = $id_function;

            $proof = $this->connection->ExecuteNonQuery($query, $parameters);
            if($proof > 0)
                $flag = true;

        } catch (PDOException $e) {
            //echo $e->getMessage();
        } catch(Exception $e){
            //echo $e->getMessage();
        }
        return flag;
    }

    protected function mapear($value) {
        $value = is_array($value) ? $value : [];
        $resp = array_map(function($p){
            return new FunctionMovie($p['date'], $p['hour'], $this->saloonDAO->GetById($p['id_saloon']), $p['id_function']); //(asi tengo los datos en la bbdd de phpmyadmin)
        }, $value);
        return count($resp) > 1 ? $resp : $resp[0];
    }
}