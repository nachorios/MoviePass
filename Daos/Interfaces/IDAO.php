<?php namespace Interfaces;

interface IDAO
{
  public function Add($object);
  //public function Get($id);
  public function Update($object,$parameters = array());
  public function Delete($id);
  public function GetAll();
}



 ?>
