<?php namespace Controllers;

    interface IController 
    {
        function add($value);
        function getAll();
        function get($id);
    }