<?php namespace Config;

class Autoload {

     public static function start() {

          spl_autoload_register(function($classNotFound)
          {
               // Armo la url de la clase a partir del namespace y la instancia.
               $url = ROOT . str_replace("\\", "/", $classNotFound)  . ".php";
               $url = str_replace("\\","/",$url);
               
               echo $url . " ". $classNotFound . '<br/> ';
               
               // Incluyo la url que, si todo esta bien, debería contener la clase que intento instanciar.
               include_once($url);
          });
     }
}
