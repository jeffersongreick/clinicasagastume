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
            $view_base = View::factory('base');
            $s = array('public/js/jquery.js', 'public/js/tratamiento_script.js');
            $view_base->script('script', $s);
            $c = array('public/css/estilo.css', 'public/css/estilo_escritorio.css');
            $view_base->css('css', $c);
            $view = View::factory('tratamiento');
            $view_base->set('contenido', $view);
            echo $view_base->render();
        } catch (Exception $exc) {
             Model_Error::getInstance()->makeError($exc->getTraceAsString(), "usuario/principal/");
        }
    }

    public function nuevoTratamiento() {
        try {
            if (isset($_POST)) {
                $tratamiento = Model_ServicioTratamiento::getInstance()->nuevoTratamiento($_POST['ci'], $_POST['observacion'], 9);
                echo "El tratamiento se ha creado con exito";
            }
        } catch (Exception $exc) {
             Model_Error::getInstance()->makeError($exc->getTraceAsString(), "usuario/principal/");
        }
    }

    public function finalizarTratamiento() {
        try {
            $b = Model_ServicioTratamiento::getInstance()->finalizarTratamiento(3);
            echo $b;
        } catch (Exception $exc) {
            Model_Error::getInstance()->makeError($exc->getTraceAsString(), "tratamiento/tratamiento/");
        }
    }

    public function getTratamientos() {
        try {
            $pacientes = Model_ServicioTratamiento::getInstance()->getTratamientos();
            $rows = "";
            if (1 == 0) {
                echo "No se ha encontrado registros de tratamientos.";
            } else {
                foreach ($pacientes as $p) :
                    $rows .= "<tr value='" . $p['id_tratamiento'] . "' onclick='seleccionar(this)'><td><img src='" .
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
