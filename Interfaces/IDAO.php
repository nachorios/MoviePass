<?php namespace Interfaces;

interface IDAO
{
  public function Add($object);
  //public function Get($id);
  public function Update($object,$id_object);
  public function Delete($id_object);
  public function GetAll();
}



 ?>
