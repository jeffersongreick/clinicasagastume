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
//        $contenido = View::factory('odontograma');
//        $view->set('contenido', $contenido);
         echo $view->render();
    }
}

?>
