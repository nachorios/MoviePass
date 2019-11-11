<?php namespace Models;

class Saloon{

    private $id;
    private $name;
    private $capacity;
    private $value; /*entry_value*/
    private $id_cinema;


    public function  __construct($name, $capacity, $value, $id = 0){
        $this->name = $name;
        $this->capacity = $capacity;
        $this->value = $value;
        $this->id = $id;
    }


    public function getName(){
        return $this->name;
    }
    public function getCapacity(){
        return $this->capacity;
    }

    public function getValue(){
        return $this->value;
    }

    public function getId(){
        return $this->id;
    }


    public function setName($name){
        $this->name=$name;
    }
    public function setCapacity($capacity){
        $this->capacity=$capacity;
    }

    public function setValue($value){
        $this->value=$value;
    }

    public function setId($id){
        $this->id=$id;
    }

}
