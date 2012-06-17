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
    private $_controlador;
    private $_metodo;
    private $_argumentos;

    public function __construct(){
        if(isset($_GET['url'])){
            //Elimina todos los caracteres excepto letras, dígitos y $-_.+!*'(),{}|\\^~[]`<>#%";/?:@&=.
            $url = filter_input(INPUT_GET,'url',FILTER_SANITIZE_URL);

             // crea un array con el string dado usando como sepador "/"
            $url = explode("/",$url);
            //elimina posiciones vacias en el array
            $url = array_filter($url);

            //array_shift Quita el primer valor del array y lo devuelve
            $this->_controlador = strtolower(array_shift($url));
            $this->_metodo = strtolower(array_shift($url));
            $this->_argumentos = $url;
        }

        //si no hay un controlador asigna el controlador por defecto
        if(!$this->_controlador){
            $this->_controlador = DEFAULT_CONTROLLER;
        }
        //si no hay metodo asigna el metodo por defecto index
        if(!$this->_metodo){
            $this->_metodo = 'index';
        }
        //si no hay argumentos se le asigna un array vacio
        if(!isset($this->_argumentos)){
            $this->_argumentos = array();
        }
    }

    public function get_controller(){
        return $this->_controlador;
    }

    public function get_method(){
        return $this->_metodo;
    }

    public function get_aguments(){
        return $this->_argumentos;
    }
}
