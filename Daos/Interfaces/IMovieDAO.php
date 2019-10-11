<?php namespace Daos\Interfaces;

    use Models\Movie as Movie;
    use DAO\Connection as Connection;

    interface IMovieDAO {

        function add(Movie $movie);
        function getAll();

    }