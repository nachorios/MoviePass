<?php namespace Models;

class FunctionMovie{
    private $date;
    private $hour;
    private $saloon;
    private $idFunction;
    private $duration;

    public function __construct($date, $hour, $saloon, $idFunction, $duration = 0){
        $this->date = $date;
        $this->hour = $hour;
        $this->saloon = $saloon;
        $this->idFunction = $idFunction;
        $this->duration = $duration;
    }

    public function getDuration(){
        return $this->duration;
    }

    public function setDuration($duration){
        $this->duration = $duration;
    }

    public function setDate($date){
        $this->date = $date;
    }

    public function getDate(){
        return $this->date;
    }

    public function setHour($hour){
        $this->hour = $hour;
    }

    public function getHour(){
        return $this->hour;
    }

    public function getId(){
        return $this->idFunction;
    }

    public function setId($idFunction)
    {
      $this->idFunction = $idFunction;
    }

    public function setSaloon($saloon){
        $this->saloon = $saloon;
    }

    public function getSaloon(){
        return $this->saloon;
    }
}
