<?php namespace Models;

class Movie {
    private $title;
    private $time;
    private $language;

    public function  __construct( $title = "", $time = 0, $language = ""){
        $this->title = $title;
        $this->time = $time;
        $this->language = $language;
    }

    public function getTitle(){
        return $this->title;
    }

    public function getTime(){
        return $this->time;
    }

    public function getLanguage(){
        return $this->language;
    }

    public function setTitle ($title){
        $this->title = $title;
    }

    public function setTime($time){
        $this->time = $time;
    }

    public function setLanguage($language){
        $this->language = $language;
    }

}