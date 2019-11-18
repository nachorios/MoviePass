<?php namespace Models;

class Buyout{
    private $quan;
    private $date;
    private $total;
    private $movie;
    private $cinema;
    private $funcion;

    public function __construct($quan, $total, $movie, $cinema, $funcion, $date){
        $this->quan = $quan;
        $this->total = $total;
        $this->movie = $movie;
        $this->cinema = $cinema;
        $this->funcion = $funcion;
        $this->date = $date;
    }

    public function setMovie($movie){
        $this->movie = $movie;
    }

    public function setCinema($cinema){
        $this->id_cinema = $cinema;
    }

    public function setQuan($quan){
        $this->quan=$quan;
    }

    public function setFuncion($funcion){
        $this->funcion = $funcion;
    }

    public function setDate($date){
        $this->date=$date;
    }

    public function setTotal($total){
        $this->total=$total;
    }

    public function getMovie(){
        return $this->movie;
    }

    public function getCinema(){
        return $this->cinema;
    }

    public function getQuan(){
        return $this->quan;
    }

    public function getDate(){
        return $this->date;
    }

    public function getTotal(){
        return $this->total;
    }

    public function getFunction(){
        return $this->funcion;
    }
}