<?php namespace Models;

class Cinema{
    private $id_cinema;
    private $name;
    private $adress;
//    private $saloon;

      public function  __construct($name, $adress, /*$saloon,*/ $id_cinema = 0){
        $this->name = $name;
        $this->adress = $adress;
//        $this->saloon = $saloon;
        $this->id_cinema = $id_cinema;
    }

    public function getIdCinema(){
        return $this->id_cinema;
    }
    public function getName(){
        return $this->name;
    }
    public function getAdress(){
        return $this->adress;
    }

/*    public function getSaloon(){
        return $this->saloon;
    }*/

    public function setIdCinema($id_cinema){
        $this->id_cinema=$id_cinema;
    }
    public function setName($name){
        $this->name=$name;
    }
    public function setAdress($adress){
        $this->adress=$adress;
    }

/*    public function setSaloon($saloon){
        $this->saloon=$saloon;
    }*/

}
