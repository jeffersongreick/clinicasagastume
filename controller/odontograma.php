<?php

session_start();

class Controller_Odontograma {

    public function inicial() {
        try {
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
            $odontograma = Model_ServicioOdontograma::getInstance()->getOdontogramaEstados($_SESSION['id_tratamiento'], 2);
            $_SESSION['id_odontograma'] = $odontograma['id'];
            $odontograma = $this->getScriptOdontograma(2, $odontograma['piezas']);
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

    public function planTratamiento($tipo) {
        try {
            $odontograma = Model_ServicioOdontograma::getInstance()->getEstructuraBucal($_SESSION['id_tratamiento']);

            switch ($tipo) {
                case "propuesto":
                    $odontograma = $this->getScriptOdontograma(3, $odontograma['piezas']);

                    break;
                case "compromiso":
                    $odontograma = $this->getScriptOdontograma(4, $odontograma['piezas']);
                    break;
            }
            $view_base = View::factory('base');
            $s = array('public/js/kinetic.js', 'public/js/jquery.js', 'public/js/cara.js', 'public/js/pieza.js', 'public/js/load_odontograma.js', 'public/js/functions_odontograma.js', 'public/js/functions_odontograma_tratamiento.js');
            $view_base->script('script', $s);
            $c = array('public/css/estilo.css', 'public/css/estilo_odontograma.css');
            $view_base->css('css', $c);
            $view = View::factory('editor_odontograma_prestaciones');
            $view->set('prestaciones', $this->listarPrestacionesHtml());
            $view_base->set('JsonOdontograma', $odontograma);
            $view_base->set('contenido', $view);
            echo $view_base->render();
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    public function listarPrestacionesHtml() {
        try {
            $list = Model_ServicioPrestacion::getInstance()->listarPrestaciones();
            $items = "";
            foreach ($list as $item) {
                $items .= "<input class='item' onchange='agregar(this)' id='prestacion_" . $item['id'] . "' type='checkbox' value=" . $item['id'] . "><label
                  for='prestacion_" . $item['id'] . "' class='item_prestacion'>" . utf8_encode($item['descripcion']) . "</label>";
            }
            return $items;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    private function getScriptOdontograma($tipo, $piezas) {
        $js = "<script type='text/javascript'>";
        $js.="var tipo =" . $tipo . ";";
        $js.="var piezas = " . json_encode($piezas) . ";";
        $js.="</script>";
        return $js;
    }

    public function visualizar_odontograma($tipo) {
        switch ($tipo) {
            case "inicial":
                $odontograma = Model_ServicioOdontograma::getInstance()->getOdontogramaEstados($_SESSION['id_tratamiento'], 1);
                $odontograma = $this->getScriptOdontograma(1, $odontograma['piezas']);
                break;
            case "actual":
                $odontograma = Model_ServicioOdontograma::getInstance()->getOdontogramaEstados($_SESSION['id_tratamiento'], 2);
                $odontograma = $this->getScriptOdontograma(2, $odontograma['piezas']);
                break;
            case "propuesto":
                $odontograma = Model_ServicioOdontograma::getInstance()->getOdontogramaEstados($_SESSION['id_tratamiento'], 3);
                $odontograma = $this->getScriptOdontograma(3, $odontograma['piezas']);
                break;
            case "compromiso":
                $odontograma = Model_ServicioOdontograma::getInstance()->getOdontogramaEstados($_SESSION['id_tratamiento'], 4);
                $odontograma = $this->getScriptOdontograma(4, $odontograma['piezas']);
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
            $b = Model_ServicioOdontograma::getInstance()->verifOdontograma($_SESSION['id_tratamiento'], 1);
            echo $b;
        } catch (Exception $exc) {
            throw $exc->getMessage();
        }
        return true;
    }

    public function verifPlan($tipo) {
        try {
            $b = Model_ServicioOdontograma::getInstance()->verifOdontograma($_SESSION['id_tratamiento'],$tipo);
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
                $p = Model_ServicioOdontograma::getInstance()->guardarOdontogramaEstados($piezas, 1, $_SESSION['id_tratamiento']);
                $p = Model_ServicioOdontograma::getInstance()->guardarOdontogramaEstados($piezas, 2, $_SESSION['id_tratamiento']);
                echo $p;
            }
        } catch (Exception $exc) {
            echo "Error: " . $exc->getMessage();
        }
    }

    public function guardarOdontogramaEstados() {
        try {
            if (isset($_POST['piezas'])) {
                $piezas = $_POST['piezas'];
                $p = Model_ServicioOdontograma::getInstance()->actualizarOdontograma($piezas, $_SESSION['id_odontograma'], $_SESSION['id_tratamiento']);
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
                $p = Model_ServicioOdontograma::getInstance()->guardarPlanTratamiento($piezas, 3, $_SESSION['id_tratamiento']);
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
                $p = Model_ServicioOdontograma::getInstance()->guardarPlanTratamiento($piezas, 4,$_SESSION['id_tratamiento']);
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
