<?php namespace Models;

class User implements Person{

    private $mail;
    private $pass;

    public function  __construct($name, $lastName, $dni, $mail, $pass){
        super($name, $lastName, $dni);
        $this->mail = $mail;
        $this->pass = $pass;
    }

    public function setMail($mail){
        $this->mail = $mail;
    }

    public function setPass($pass){
        $this->pass = $pass;
    }

    public function getMail(){
        return $this->mail;
    }

    public function getPass(){
        return $this->pass;
    }
}