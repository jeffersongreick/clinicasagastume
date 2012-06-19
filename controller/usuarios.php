<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of usuarios
 *
 * @author Diego
 */
class Controller_Usuarios extends Controller{
    //put your code here
    public function index(){
        $u = Model::factory('usuarios');
        echo $u->pepe;
    }
}

?>
