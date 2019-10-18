<?php namespace Models;

class Cinema{
    private $name;
    private $capacity;
    private $adress;
    private $value;

    public function  __construct($name, $capacity, $adress, $value){
        $this->name = $name;
        $this->capacity = $capacity;
        $this->adress = $adress;
        $this->value = $value;
    }

    public function getName(){
        return $this->name;
    }
    public function getCapacity(){
        return $this->capacity;
    }
    public function getAdress(){
        return $this->adress;
    }
    public function getValue(){
        return $this->value;
    }

    public function setName($name){
        $this->name=$name;
    }
    public function setCapacity($capacity){
        $this->capacity=$capacity;
    }
    public function setAdress($adress){
        $this->adress=$adress;
    }
    public function setValue($value){
        $this->value=$value;
    }
    
}