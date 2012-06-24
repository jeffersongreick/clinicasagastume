<?php
/**
 * Created by JetBrains PhpStorm.
 * User: diegoplada
 * Date: 13/06/12
 * Time: 21:56
 * To change this template use File | Settings | File Templates.
 */
class Request
{
    private $controlador;
    private $metodo;
    private $argumentos;

    public function __construct(){
        if(isset($_GET['url'])){
             
            //Elimina todos los caracteres excepto letras, dígitos y $-_.+!*'(),{}|\\^~[]`<>#%";/?:@&=.
            $url = filter_var($_GET['url'],FILTER_SANITIZE_URL);
          
             // crea un array con el string dado usando como sepador "/"
            $url = explode("/",$url);
           
            //elimina posiciones vacias en el array
            $url = array_filter($url);

            //array_shift Quita el primer valor del array y lo devuelve
            $this->controlador = strtolower(array_shift($url));
            $this->metodo = strtolower(array_shift($url));
            $this->argumentos = $url;
           
        }

        //si no hay un controlador asigna el controlador por defecto
        if(!$this->controlador){
            $this->controlador = DEFAULT_CONTROLLER;
        }
        //si no hay metodo asigna el metodo por defecto index
        if(!$this->metodo){
            $this->metodo = 'index';
        }
        //si no hay argumentos se le asigna un array vacio
        if(!isset($this->argumentos)){
            $this->argumentos = array();
        }
        
    }

    public function get_controller(){
        return $this->controlador;
    }

    public function get_method(){
        return $this->metodo;
    }

    public function get_aguments(){
        return $this->argumentos;
    }
}
