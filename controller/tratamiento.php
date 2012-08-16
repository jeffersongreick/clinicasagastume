<?php

class Controller_Tratamiento {

    public function tratamiento($idTratamiento = 0) {
        try {
            session_start();
            if ($idTratamiento > 0) {
                $tratamiento = Model_ServicioTratamiento::getInstance()->getTratamiento($idTratamiento);
                $_SESSION['id_tratamiento'] = $tratamiento->getId();
                $_SESSION['nombre_paciente'] = $tratamiento->getPaciente()->toString();
                $_SESSION['fechaNac_paciente'] = $tratamiento->getPaciente()->getFecha_nac();
            }

            $view = View::factory('escritorio');
            echo $view->render();
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
    }

    public function nuevoTratamiento($ci) {
        try {
            $tratamiento = Model_ServicioTratamiento::getInstance()->nuevoTratamiento($ci);
            $_SESSION['id_tratamiento'] = $tratamiento->getId();
            $_SESSION['nombre_paciente'] = $tratamiento->getPaciente()->toString();
            $_SESSION['fechaNac_paciente'] = $tratamiento->getPaciente()->getFecha_nac();
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
