<?php
class Controller_Odontograma {

    public function index() {
//        $view = View::factory('layout');
//        $contenido = View::factory('index');
//        $view->set('contenido', $contenido);
//        echo $view->render();
//        $s = Model_ServicioPacientes::getInstance();
        Model_ServicioPacientes::getInstance()->getPacienteCI(1);
    }

    public function odontograma() {
        $view = View::factory('odontograma');
        echo $view->render();
    }
    public function nuevoOdontogramaInicial(){
        
    }
}
?>
