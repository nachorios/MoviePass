<?php namespace Models;

class Buyout{
    private $quan;
    private $disc;
    private $date;
    private $total;
    private $id_movie;

    public function __construct($quan, $disc, $date, $total, $id_movie){
        $this->quan = $quan;
        $this->disc = $disc;
        $this->date = $date;
        $this->total = $total;
        $this->id_movie = $id_movie;
    }

    public function setIdMovie($id_movie){
        $this->id_movie = $id_movie;
    }

    public function setQuan($quan){
        $this->quan=$quan;
    }

    public function setDisc($disc){
        $this->disc=$disc;
    }

    public function setDate($date){
        $this->date=$date;
    }

    public function setTotal($total){
        $this->total=$total;
    }

    public function getIdMovie(){
        return $this->id_movie;
    }

    public function getQuan(){
        return $this->quan;
    }

    public function getDisc(){
        return $this->disc;
    }

    public function getDate(){
        return $this->date;
    }

    public function getTotal(){
        return $this->total;
    }
}