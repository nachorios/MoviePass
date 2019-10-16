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
            $query 
        }
    }
}