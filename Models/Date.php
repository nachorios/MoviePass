<?php namespace Models;

class Date{
    private $id;
    private $hour;

    public function __construct($hour, $id){
        
        $this->hour = $hour;
       
        $this->id = $id;
     
    }

    public function getHour(){
        return $this->hour;
    }

    public function setHour($hour){
        $this->hour = $hour;
    }

    public function getId(){
        return $this->id;
    }

    public function setId($id){
        $this->id = $id;
    }

}