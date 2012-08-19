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
            $view = View::factory('escritorio');
            $view_base->set('contenido', $view);
            echo $view_base->render();
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
            $view_base = View::factory('base');
            $s = array('public/js/jquery.js', 'public/js/tratamiento_script.js');
            $view_base->script('script', $s);
            $c = array('public/css/estilo.css', 'public/css/estilo_escritorio.css');
            $view_base->css('css', $c);
            $view = View::factory('escritorio');
            $view_base->set('contenido', $view);
            echo $view_base->render();
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

    public function nuevoPlanTratamientoPropuesto() {
        try {
            $JsonOdontograma;
            $JsonOdontograma = Model_ServicioPieza::getInstance()->getPiezasAdultos();
            $JsonOdontograma = "var piezas = " . json_encode($JsonOdontograma) . ";var tipo ='guardarOdontogramaInicial'";
            $view_base = View::factory('base');
            $s = array('public/js/kinetic.js', 'public/js/jquery.js', 'public/js/cara.js', 'public/js/pieza.js', 'public/js/load_odontograma.js', 'public/js/functions_odontograma.js', 'public/js/functions_odontograma_tratamiento.js');
            $view_base->script('script', $s);
            $c = array('public/css/estilo.css', 'public/css/estilo_odontograma.css');
            $view_base->css('css', $c);
            $view = View::factory('editor_odontograma_prestaciones');
            $view->set('prestaciones', $this->listarPrestaciones());
            $view_base->set('JsonOdontograma', $JsonOdontograma);
            $view_base->set('contenido', $view);
            echo $view_base->render();
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    public function listarPrestaciones() {
        try {
            $list = Model_ServicioPrestacion::getInstance()->listarPrestaciones();
            $items = "";
            foreach ($list as $item) {
                $items .= "<input onchange='agregar(this)' id='prestacion_" . $item['id'] . "' type='checkbox' value=" . $item['id'] . "><label
                  for='prestacion_" . $item['id'] . "' class='item_prestacion'>" . utf8_encode($item['descripcion']) . "</label>";
            }
            return $items;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

}

?>
