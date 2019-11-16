<?php namespace Models;

class Billboard{
    private $idBill;
    private $cinema;
    private $movie;
    private $functions;

    public function  __construct($movie, $cinema, $idBill, $functions){
        $this->movie = $movie;
        $this->cinema = $cinema;
        $this->idBill = $idBill;
        $this->functions = $functions;
    }

    public function setMovie($movie){
        $this->movie = $movie;
    }

    public function getMovie(){
        return $this->movie;
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

    public function setIdBill($idBill)
    {
      $this->idBill = $idBill;
    }

    public function setFunctions($functions){
        $this->functions = $functions;
    }

    public function getFunctions(){
        return $this->functions;
    }
}
