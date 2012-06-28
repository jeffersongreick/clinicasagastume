<?php

class Controller_Inicio {

    public function index() {
        $view = View::factory('layout');
        $contenido = View::factory('odontograma');
        $view->set('contenido', $contenido);
        echo $view->render();
    }

    public function odontograma() {
        $view = View::factory('odontograma');
        echo $view->render();
    }

}

?>
