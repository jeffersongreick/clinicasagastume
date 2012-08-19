<?php

class Controller_Usuario{
    
        public function index() {
        try {
            $view = View::factory('login');
            echo $view->render();
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
    }
    
    public function principal() {
        try {
            $view_base = View::factory('base');
            $s = array('public/js/jquery.js', 'public/js/principal_script.js');
            $view_base->script('script', $s);
            $c = array('public/css/estilo.css', 'public/css/estilo_escritorio.css');
            $view_base->css('css', $c);
            $view = View::factory('principal');
            $view_base->set('contenido', $view);
            echo $view_base->render();
            
            
            $view = View::factory('principal');
            echo $view->render();
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
    }
}

?>
