<?php

class Controller_Paciente {

    public function getTratamientoPaciente($ci) {
        try {
            $paciente = Model_ServicioPaciente::getInstance()->getDatosPaciente($ci);
            if ($paciente == false) {
                echo "Error al buscar el paciente con cedula " . $ci;
            } else {
                $tratamiento = Model_ServicioTratamiento::getInstance()->getTratamientoPaciente($paciente['ci']);
                $g = "<div id='generador' style='display: none'><div id='patient_data' >" .
                        "<p id='patient_ci' value='" . $paciente['ci'] . "' class='data'>C.I.:" . $paciente['ci'] .
                        "</p><p id='patient_name' class='data'>Nombre:" . $paciente['nombre'] . "</p>" .
                        "<p id='tratamiento'>¿Tratamiento activo? " . isset($tratamiento) . "</p><label>Observacion:</label>" .
                        "<textarea id='observacionTratamiento' style='height: 200px;width: 460px;'></textarea>" .
                        "</div>
                            </div> <div id='contenedor_botones' ><input type='button' id='btnCrearTratamiento' " .
                        "onclick='nuevo_tratamiento()' class='button' value='Crear'/>" .
                        "<input type='button' id='btnVolverBuscarPaciente' onclick='abrirBuscadorPacientesTratamiento()' class='button' value='Volver'/>" .
                        "<input type='button' class='button_cancel' value='Cancelar'/></div>";

                echo $g;
            }
        } catch (Exception $exc) {
             Model_Error::getInstance()->makeError($exc->getTraceAsString(), "usuario/principal/");
        }
    }

    public function getPacientes($str) {
        try {
            $pacientes = Model_ServicioPaciente::getInstance()->getPacientes($str);
            $rows = "";
            if (1 == 0) {
                echo "No se ha encontrado registros de pacientes.";
            } else {
                foreach ($pacientes as $p) :
                    $rows .= "<tr value='" . $p['ci'] . "' onclick='seleccionar(this)'><td><img src='" .
                            URL . "public/img/tic.png'/>" . $p['nombre'] . "<br/>C.I. " . $p['ci'] . "</td></tr>";
                endforeach;
                echo $rows;
            }
        } catch (Exception $exc) {
             Model_Error::getInstance()->makeError($exc->getTraceAsString(), "usuario/principal/");
        }
    }

}

?>
