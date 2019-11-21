<?php namespace Models;

class Buyout{
    private $id_buyout;
    private $quan;
    private $date;
    private $total;
    private $movie;
    private $cinema;
    private $funcion;

    public function __construct($quan, $total, $movie, $cinema, $funcion, $date, $id_buyout = 0){
        $this->quan = $quan;
        $this->total = $total;
        $this->movie = $movie;
        $this->cinema = $cinema;
        $this->funcion = $funcion;
        $this->date = $date;
        $this->$id_buyout = $id_buyout;
    }

    public function setIdBuyout($id_buyout){
        $this->id_buyout = $id_buyout;
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

    public function getIdBuyout(){
        return $this->id_buyout;
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
