<?php namespace Daos;

use \Exception as Exception;
use Daos\Interfaces\IUserDAO as IUserDAO;
use Models\User as User;
use Daos\Connection as Connection;

class UserDAO implements IUserDAO {

    private $connection;
    //private $tableName = "Users";

    public function Add($user){
      try{
            $query = "INSERT INTO users (mail, pass, name, lastname, dni, id_rol) VALUES (:mail, :pass, :name, :lastname, :dni, :id_rol)";
            $flag = false;


            $parameters["name"] = $user->getName();
            $parameters["lastname"] = $user->getLastName();
            $parameters["dni"] = $user->getDni();
            $parameters["mail"] = $user->getMail();
            $parameters["pass"] = $user->getPass();
            $parameters["id_rol"] = $user->getRole();

            $this->connection = Connection::GetInstance();

            $rowCount = $this->connection->ExecuteNonQuery($query, $parameters);
            var_dump($rowCount);
            if($rowCount == 1) //si el usuario fue cargado con exito ExecuteNonQuery devuelve 1 (que es la cantidad de filas modificadas)
            {
              $flag = true;
            }
        }
        catch(Exception $e) {
          throw $e;
        }
        finally{
          return $flag;
        }
    }

    public function getUserByMailPass($mail, $pass)
    {
          //$query = "SELECT * FROM users WHERE mail = :mail AND pass = :pass";
          //$query = "SELECT * FROM users WHERE :mail AND :pass LIMIT 1";

// si lo hago de la maera tradicional no me funciona, asi si
          $query = "SELECT * FROM users WHERE mail = \"$mail\" AND pass = \"$pass\" LIMIT 1";


          //$parameters['mail'] = $mail;
          //$parameters['pass'] = $pass;

      try {
        $this->connection = Connection::getInstance();
        $resultSet = $this->connection->execute($query);

        if(!empty($resultSet))
        {
          return $this->mapear($resultSet);
        }
      } catch (PDOException $e) {
        //throw $e;
      } catch(Exception $e){
        //echo $e->getMessage();
      }
      return NULL; // si no encuentra el usuario
    }

    protected function mapear($value)
    {
  		$value = is_array($value) ? $value : [];

  		$resp = array_map(function($p){
          return new User( $p['name'], $p['lastname'],$p['dni'],$p['mail'],$p['pass'],$p['id_rol']); //(asi tengo los datos en la bbdd de phpmyadmin)
       }, $value);
          /* devuelve un arreglo si tiene datos y sino devuelve nulo*/

       return count($resp) > 1 ? $resp : $resp[0];
     }
}
