<?php namespace Models;

class Billboard{
    private $day;
    private $hour
    private $idMovie;

    public function  __construct($day, $hour, $idMovie){
        $this->day = $day;
        $this->hour = $hour;
        $this->idMovie = $idMovie;
    }

    public function setDay($day){
        $this->day = $day;
    }

    public function getDay(){
        return $this->day;
    }

    public function setHour($hour){
        $this->hour = $hour;
    }

    public function getHour(){
        return $this->hour;
    }

    public function setMovie($idMovie){
        $this->idMovie = $idMovie;
    }

    public function getMovie(){
        return $this->idMovie;
    }

}