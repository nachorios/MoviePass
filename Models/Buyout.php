<?php namespace Models;

class Buyout{
    private $cant;
    private $desc;
    private $date;
    private $total;

    public function __construct($cant, $desc, $date, $total){
        $this->cant = $cant;
        $this->desc = $desc;
        $this->date = $date;
        $this->total = $total;
    }

    public function setCant($cant){
        $this->cant=$cant;
    }

    public function setDesc($desc){
        $this->desc=$desc;
    }

    public function setDate($date){
        $this->date=$date;
    }

    public function setTotal($total){
        $this->total=$total;
    }

    public function getCant(){
        return $this->cant;
    }

    public function getDesc(){
        return $this->desc;
    }

    public function getDate(){
        return $this->date;
    }

    public function getTotal(){
        return $this->total;
    }
}