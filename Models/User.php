<?php namespace Models;

class User extends Person{

    private $mail;
    private $pass;
    private $role;
    private $profileImage;

  public function  __construct($name="", $lastName="", $dni=0, $mail="", $pass="", $role=1, $profileImage=null, $birthday=null){
        parent::__construct($name, $lastName, $dni, $birthday);
        $this->mail = $mail;
        $this->pass = $pass;
        $this->role = $role;
        $this->profileImage = $profileImage;
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

    public function getProfileImage() {
        return $this->profileImage;
    }

    public function setProfileImage($profileImage) {
        $this->profileImage = $profileImage;
    }
}
