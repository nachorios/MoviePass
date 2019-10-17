<?php namespace Models;

abstract class Person{
    private $name;
    private $lastName;
    private $dni;

    public function __construct($name, $lastName, $dni){
        $this->name = $name;
        $this->lastName = $lastName;
        $this->dni = $dni;
    }

    public function getName(){
        return $this->name;
    }

    public function getLastName(){
        return $this->lastName;
    }

    public function getDni(){
        return $this->dni;
    }

    public function setName($name){
        $this->name = $name;
    }

    public function setLastName($lastName){
        $this->lastName = $lastName;
    }

    public function setDni($dni){
        $this->dni = $dni;
    }
}