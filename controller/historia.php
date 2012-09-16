<?php

class Controller_Historia {

    public function index() {
        try {
            $view_base = View::factory('base');
            $s = array('public/js/jquery.js','public/js/historia_script.js');
            $view_base->script('script', $s);
            $c = array('public/css/estilo.css', 'public/css/estilo_escritorio.css','public/css/estilo_historia.css');
            $view_base->css('css', $c);
            $view = View::factory('historia_clinica');
            $view_base->set('contenido', $view);
            echo $view_base->render();
        } catch (Exception $exc) {
            Model_Error::getInstance()->makeError($exc->getTraceAsString(), "tratamiento/tratamiento/");
        }
    }
}
?>
