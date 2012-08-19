<?php

session_start();

class Controller_Odontograma {

    public function inicial() {
        try {
            $odontograma;
            $today = new DateTime("now");
            $intervalo = $today;
            if ($intervalo->format('d') > 2922) {
                $odontograma = Model_ServicioPieza::getInstance()->getPiezasAdultos();
                $odontograma = $this->getScriptOdontograma(1, $odontograma);
            } else {
                $odontograma = Model_ServicioPieza::getInstance()->getPiezasInfantiles();
                $odontograma = $this->getScriptOdontograma(1, $odontograma);
            }
            $view_base = View::factory('base');
            $s = array('public/js/kinetic.js', 'public/js/jquery.js', 'public/js/cara.js', 'public/js/pieza.js', 'public/js/load_odontograma.js', 'public/js/functions_odontograma.js', 'public/js/functions_odontograma_estado.js');
            $view_base->script('script', $s);
            $c = array('public/css/estilo.css', 'public/css/estilo_odontograma.css');
            $view_base->css('css', $c);
            $view = View::factory('editor_odontograma_estados');
            $view->set('listaEstados', Model_ServicioEstado::getInstance()->obtenerEstados());
            $view_base->set('JsonOdontograma', $odontograma);
            $view_base->set('contenido', $view);
            echo $view_base->render();
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    public function actual() {
        try {
            $odontograma = Model_ServicioOdontograma::getInstance()->getOdontograma($_SESSION['id_tratamiento'], 2);
            $_SESSION['id_odontograma'] = $odontograma['id'];
            $odontograma = $this->getScriptOdontograma(2, $odontograma);
            $view_base = View::factory('base');
            $s = array('public/js/kinetic.js', 'public/js/jquery.js', 'public/js/cara.js', 'public/js/pieza.js', 'public/js/functions_odontograma.js', 'public/js/load_odontograma.js', 'public/js/functions_odontograma_estado.js');
            $view_base->script('script', $s);
            $c = array('public/css/estilo.css', 'public/css/estilo_odontograma.css');
            $view_base->css('css', $c);
            $view = View::factory('editor_odontograma_estados');
            $view->set('listaEstados', Model_ServicioEstado::getInstance()->obtenerEstados());
            $view_base->set('JsonOdontograma', $odontograma);
            $view_base->set('contenido', $view);
            echo $view_base->render();
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    private function getScriptOdontograma($tipo, $piezas) {
        $js = "<script type='text/javascript'>";
        $js.="var tipo =" . $tipo . ";";
        $js.="var piezas = " . json_encode($piezas['piezas']) . ";";
        $js.="</script>";
        return $js;
    }

    public function visualizar_odontograma($tipo) {
        switch ($tipo) {
            case "inicial":
                $odontograma = Model_ServicioOdontograma::getInstance()->getOdontograma($_SESSION['id_tratamiento'], 1);
                $odontograma = $this->getScriptOdontograma(1, $odontograma);
                break;
            case "actual":
                $odontograma = Model_ServicioOdontograma::getInstance()->getOdontograma($_SESSION['id_tratamiento'], 2);
                $odontograma = $this->getScriptOdontograma(2, $odontograma);
                break;
        }
        $view_base = View::factory('base');
        $s = array('public/js/kinetic.js', 'public/js/jquery.js', 'public/js/cara.js', 'public/js/pieza.js', 'public/js/load_odontograma.js');
        $view_base->script('script', $s);
        $c = array('public/css/estilo.css', 'public/css/estilo_odontograma.css');
        $view_base->css('css', $c);
        $view = View::factory('visualizador_odontograma');
        $view_base->set('JsonOdontograma', $odontograma);
        $view_base->set('contenido', $view);
        echo $view_base->render();
    }

    public function verifODontInicial() {
        try {
            $b = Model_ServicioOdontograma::getInstance()->verifODontInicial($_SESSION['id_tratamiento']);
            echo $b;
        } catch (Exception $exc) {
            throw $exc->getMessage();
        }
        return true;
    }

    public function guardarOdontogramaInicial() {
        try {
            if (isset($_POST['piezas'])) {
                $piezas = $_POST['piezas'];
                $p = Model_ServicioOdontograma::getInstance()->guardarOdontograma($piezas, 1);
                $p = Model_ServicioOdontograma::getInstance()->guardarOdontograma($piezas, 2);
                echo $p;
            }
        } catch (Exception $exc) {
            echo "Error: " . $exc->getMessage();
        }
    }

    public function guardarOdontogramaActual() {
        try {
            if (isset($_POST['piezas'])) {
                $piezas = $_POST['piezas'];
                $p = Model_ServicioOdontograma::getInstance()->actualizarOdontograma($piezas, $_SESSION['id_odontograma']);
                echo $p;
            }
        } catch (Exception $exc) {
            echo "Error: " . $exc->getMessage();
        }
    }

    public function guardarPlanPropuesto() {
        try {
            if (isset($_POST['piezas'])) {
                $piezas = $_POST['piezas'];
                $p = Model_ServicioOdontograma::getInstance()->guardarPlanTratamiento($piezas, 3);
                echo $p;
            }
        } catch (Exception $exc) {
            echo "Error: " . $exc->getMessage();
        }
    }

    public function guardarPlanCompromiso() {
        try {
            if (isset($_POST['piezas'])) {
                $piezas = $_POST['piezas'];
                $p = Model_ServicioOdontograma::getInstance()->guardarPlanTratamiento($piezas, 4);
                echo $p;
            }
        } catch (Exception $exc) {
            echo "Error: " . $exc->getMessage();
        }
    }

    public function cargar($id) {
        $model_odotograma = Model_ServicioOdontograma::getInstance();
        $datos = $model_odotograma->cargarEstandar($id);
        $view = View::factory('base');
        $view_estandar = View::factory('estandar');
        $view->script('script', 'public/js/cara.js');
        $view->set('contenido', $view_estandar);
        $view_estandar->set('piezas', $datos);
        echo $view->render();
    }

    public function prueba() {
        Model::factory('servicioOdontograma');
    }

}

?>
