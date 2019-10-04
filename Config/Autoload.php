<?php namespace Config;

class Autoload {

     public static function start() {

          spl_autoload_register(function($classNotFound)
          {
               // Armo la url de la clase a partir del namespace y la instancia.
<<<<<<< HEAD
               $url = ROOT . str_replace("\\", "/", $classNotFound)  . ".php";
               $url = str_replace("\\","/",$url);
               
               //if ()
               //$url = str_replace("Controllers/","/",$url);
               //echo $url . " ". $classNotFound . '<br/> ';
               
=======
               $url = ROOT . '/' . str_replace("\\", "/", $classNotFound)  . ".php";

>>>>>>> models
               // Incluyo la url que, si todo esta bien, debería contener la clase que intento instanciar.
               include_once($url);
          });
     }
}
