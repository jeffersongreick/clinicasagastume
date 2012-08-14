<?php

class Controller_Tratamiento {
    public function tratamiento($idTratamiento) {
        try {
            $tratamiento = Model_ServicioTratamiento::getInstance()->getTratamiento($idTratamiento);
            $_SESSION['tratamiento'] = $tratamiento;
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
    public function finalizarTratamiento() {
        try {
            $b = Model_ServicioTratamiento::getInstance()->finalizarTratamiento(3);
            echo $b;
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
    }
}
?>
