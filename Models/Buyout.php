<?php namespace Models;

class Buyout{
    private $quan;
  //  private $dates;
    private $total;
    private $id_movie;
    private $id_cinema;
    private $id_function;

    public function __construct($quan, $total, $id_movie, $id_cinema, $id_function){
        $this->quan = $quan;
        $this->total = $total;
        $this->id_movie = $id_movie;
        $this->id_cinema = $id_cinema;
        $this->id_function = $id_function;
    }

    public function setIdMovie($id_movie){
        $this->id_movie = $id_movie;
    }

    public function setIdCinema($id_cinema){
        $this->id_id_cinema = $id_cinema;
    }

    public function setQuan($quan){
        $this->quan=$quan;
    }

    public function setIdFunction($id_function){
        $this->id_function = $id_function;
    }
/*
    public function setDate($dates){
        $this->dates=$dates;
    }
*/
    public function setTotal($total){
        $this->total=$total;
    }

    public function getIdMovie(){
        return $this->id_movie;
    }

    public function getIdCinema(){
        return $this->id_cinema;
    }

    public function getQuan(){
        return $this->quan;
    }
/*
    public function getDate(){
        return $this->dates;
    }*/

    public function getTotal(){
        return $this->total;
    }

    public function getIdFunction(){
        return $this->id_function;
    }
}