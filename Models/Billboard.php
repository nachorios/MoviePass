<?php namespace Models;

class Billboard{
    private $day;
    private $hour;
    private $saloon;
    private $cinema;
    private $idMovie;
    private $idBill;

    public function  __construct($day, $hour, $idMovie, $cinema, $idBill = 0, $saloon = array()){
        $this->day = $day;
        $this->hour = $hour;
        $this->idMovie = $idMovie;
        $this->cinema = $cinema;
        $this->idBill = $idBill;
        $this->saloon = $saloon;
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

    
    public function setSaloon($saloon){
        $this->saloon = $saloon;
    }

    public function getSaloon(){
        return $this->saloon;
    }
}