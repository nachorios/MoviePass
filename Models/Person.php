<?php namespace Models;

abstract class Person{
    private $name;
    private $lastName;
    private $dni;
    private $birthday;

    public function __construct($name, $lastName, $dni=0, $birthday=null){
        $this->name = $name;
        $this->lastName = $lastName;
        $this->dni = $dni;
        $this->birthday = $birthday;
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

    public function setBirthday($birthday) {
        $this->birthday = $birthday;
    }

    public function getBirthday() {
        return $this->birthday;
    }
}