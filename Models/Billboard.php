<?php namespace Models;

class Billboard{
    private $day;
    private $hour;
    private $idMovie;
    private $cinema;
    private $idBill;
    private $idSaloon;

    public function  __construct($day, $hour, $idMovie, $cinema, $idBill = 0, $idSaloon = 0){
        $this->day = $day;
        $this->hour = $hour;
        $this->idMovie = $idMovie;
        $this->cinema = $cinema;
        $this->idBill = $idBill;
        $this->idSaloon = $idSaloon;
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

    public function getId(){
        return $this->idBill;
    }

    
    public function setSaloon($idSaloon){
        $this->idSaloon = $idSaloon;
    }

    public function getSaloon(){
        return $this->idSaloon;
    }
}