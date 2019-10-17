<?php namespace Daos\Interfaces;

    use Models\User as User;
    use DAO\Connection as Connection;

    interface IUserDAO {

        function add(User $user);
        //function getAll();

    }