<?php
class Controller_Odontograma {

    public function index() {
        $view = View::factory('layout');
        $contenido = View::factory('index');
        $view->set('contenido', $contenido);
        echo $view->render();
    }

    public function odontograma() {
        $view = View::factory('odontograma');
        echo $view->render();
    }
    public function nuevoOdontogramaInicial(){
        
    }
}
?>
