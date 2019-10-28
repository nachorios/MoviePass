<?php namespace Models;

class Billboard{
    private $day;
    private $hour;
    private $idMovie;
    private $cinema;

    public function  __construct($day, $hour, $idMovie, $cinema){
        $this->day = $day;
        $this->hour = $hour;
        $this->idMovie = $idMovie;
        $this->cinema = $cinema;
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

    public function setCinema($cinema){
        $this->cinema = $cinema;
    }

    public function getCinema(){
        return $this->cinema;
    }
}