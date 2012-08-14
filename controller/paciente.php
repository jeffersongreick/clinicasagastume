<?php
session_start();
class Controller_Paciente {


    public function getTratamientoPaciente($ci) {
        try {
            $paciente = Model_ServicioPaciente::getInstance()->getDatosPaciente($ci);
            if ($paciente == false) {
                echo "El paciente no esta registrado.";
            } else {
                $tratamiento = Model_ServicioTratamiento::getInstance()->getTratamientoPaciente($paciente['ci']);
                $paciente['tratamientos'] = $tratamiento;
                echo json_encode($paciente);
            }
        } catch (Exception $exc) {
            echo "¡Error en la busqueda del paciente. Favor intente nuevamente en unos minutos!";
        }
    }

}

?>
