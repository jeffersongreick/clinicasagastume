<?php

class Controller_Tratamiento {

    private $idTratamiento = 1;
    private $idPaciente = 1;

    public function ingresar() {
        try {
            $view = View::factory('escritorio');
            echo $view->render();
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
    }
    public function nuevoTratamiento($ci) {
        try {
            Model_ServicioTratamiento::getInstance()->nuevoTratamiento($ci);
            $view = View::factory('escritorio');
            echo $view->render();
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
    }

}

?>
