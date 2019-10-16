<?php namespace Daos;

use \Exception as Exception;
use Daos\Interfaces\IUserDAO as IUserDAO;
use Models\User as User;
use Daos\Connection as Connection;

class UserDAO implements IUserDAO {

    private $connection;
    private $tableName = "Users";

    public function Add(User $user){
        try{
            $query = "INSERT INTO" . $this->tableName . "(name, lastName, dni, mail, pass, role) VALUES (:name, :lastName, :dni, :mail, :pass, :role);";

            $parameters["name"] = $user->getName();
            $parameters["lastName"] = $user->getLastName();
            $parameters["dni"] = $user->getDni();
            $parameters["mail"] = $user->getMail();
            $parameters["pass"] = $user->getPass();
            $parameters["role"] = $user->getRole();

            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query, $parameters);
        }
        catch(Exception $e) {
        throw $e;
        }
    }
}