<?php namespace Models;

class User implements Person{

    private $mail;
    private $pass;
    private $role;

    public function  __construct($name, $lastName, $dni, $mail, $pass, $role){
        super($name, $lastName, $dni);
        $this->mail = $mail;
        $this->pass = $pass;
        $this->role = $role;
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

    public function getRole(){
        return $this->role;
    }

    public function setRole($role){
        $this->role = $role;
    }
}