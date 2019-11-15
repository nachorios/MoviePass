<?php namespace Daos;

use \Exception as Exception;
use Daos\Interfaces\IUserDAO as IUserDAO;
use Models\User as User;
use Daos\Connection as Connection;

class UserDAO implements IUserDAO {

    private $connection;
    //private $tableName = "Users";

    public function Add(User $user){

            $query = "INSERT INTO users (name, lastName, dni, mail, pass, id_rol) VALUES (:name, :lastName, :dni, :mail, :pass, :id_rol)";
    try{
      
            $parameters["name"] = $user->getName();
            $parameters["lastName"] = $user->getLastName();
            $parameters["dni"] = $user->getDni();
            $parameters["mail"] = $user->getMail();
            $parameters["pass"] = $user->getPass();
            $parameters["id_rol"] = $user->getRole();

            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query, $parameters);
        }
        catch(Exception $e) {
        throw $e;
        }
    }
}
