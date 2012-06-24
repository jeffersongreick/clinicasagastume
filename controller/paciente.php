<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of paciente
 *
 * @author Diego
 */
class Controller_Paciente {
    
    public function index(){
        $view = View::factory('layout');
       // $contenido = View::factory('odontograma');
        
//        $view->set('contenido', $contenido);
        $usuarios = Model::factory('usuarios');
        $r = $usuarios->pepe();
        foreach ($r as $p){
            echo $p['nombre'].'</br>';
        }
        
        //echo $view->render();
    }
}

?>
