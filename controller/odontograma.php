<?php

session_start();

class Controller_Odontograma {

    public function inicial() {
        try {
            if ($this->verifOdontograma(1) == false) {
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
            } else {
                $this->visualizar_odontograma_estados(1);
            }
        } catch (Exception $exc) {
            $this->makeError($exc->getTraceAsString(), "tratamiento/tratamiento/");
        }
    }

    public function actual() {
        try {
            if ($this->verifOdontograma(1) == TRUE) {
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
            } else {
                $error = "¡Aun no se ha registrado un odontograma de estado inicial para el paciente en este tratamiento!";
                $this->makeError($error, "tratamiento/tratamiento/");
            }
        } catch (Exception $exc) {
            $this->makeError($exc->getTraceAsString(), "tratamiento/tratamiento/");
        }
    }

    public function planTratamiento($tipo) {
        try {
            if (Model_ServicioOdontograma::getInstance()->verifOdontograma($_SESSION['id_tratamiento'], 1) == true) {
                if (Model_ServicioOdontograma::getInstance()->verifOdontograma($_SESSION['id_tratamiento'], $tipo) == false) {
                    $odontograma = Model_ServicioOdontograma::getInstance()->getEstructuraBucal($_SESSION['id_tratamiento']);
                    $odontograma = $this->getScriptOdontograma($tipo, $odontograma['piezas']);
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
                } else {
                    $error = "Aun no se ha registrado un odontograma de estado inicial para el paciente en este tratamiento. Favor crearlo antes de continuar.";
                    $this->makeError($error, "tratamiento/tratamiento/");
                }
            } else {
                $error = "¡El plan ya se encuentra registrado en el tratamiento!";
                $this->makeError($error, "tratamiento/tratamiento/");
            }
        } catch (Exception $exc) {
            $this->makeError($exc->getTraceAsString(), "tratamiento/tratamiento/");
        }
    }

    public function tratamientoCurso() {
        try {
            if ($this->verifExistenciaPlan() == true) {
                if ((Model_ServicioOdontograma::getInstance()->verifOdontograma($_SESSION['id_tratamiento'], 5)) == TRUE) {
                    $odontograma = Model_ServicioOdontograma::getInstance()->getOdontogramaPrestaciones($_SESSION['id_tratamiento'], 5);
                    $_SESSION['id_odontograma'] = $odontograma['id'];
                    $odontograma = $this->getScriptOdontograma(7, $odontograma['piezas']);
                } else {
                    $odontograma = Model_ServicioOdontograma::getInstance()->getEstructuraBucal($_SESSION['id_tratamiento']);
                    $odontograma = $this->getScriptOdontograma(5, $odontograma['piezas']);
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
            } else {
                $error = "¡Todavía no se ha registrado un plan de tratamiento! ¡Favor registrar uno para continuar!";
                $this->makeError($error, "tratamiento/tratamiento/");
            }
        } catch (Exception $exc) {
            $this->makeError($exc->getTraceAsString(), "tratamiento/tratamiento/");
        }
    }

    public function tratamientoRealizado() {
        try {
            if ($this->verifExistenciaPlan() == true) {
                $odontograma = Model_ServicioOdontograma::getInstance()->getEstructuraBucal($_SESSION['id_tratamiento']);
                $odontograma = $this->getScriptOdontograma(6, $odontograma['piezas']);
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
            } else {
                $error = "¡Todavía no se ha registrado un plan de tratamiento! ¡Favor registrar uno para continuar!";
                $this->makeError($error, "tratamiento/tratamiento/");
            }
        } catch (Exception $exc) {
            $this->makeError($exc->getTraceAsString(), "tratamiento/tratamiento/");
        }
    }

    public function listarPrestacionesHtml() {
        try {
            $list = Model_ServicioPrestacion::getInstance()->listarPrestaciones();
            $items = "";
            foreach ($list as $item) {
                $items .= "<input class='item' onchange='agregar(this)' name='" . utf8_encode($item['descripcion']) . "' id='prestacion_" . $item['id'] . "' type='checkbox' value=" . $item['id'] . "><label
                  for='prestacion_" . $item['id'] . "' class='item_prestacion'>" . utf8_encode($item['descripcion']) . "</label>";
            }
            return $items;
        } catch (Exception $exc) {
            $this->makeError($exc->getTraceAsString(), "tratamiento/tratamiento/");
        }
    }

    private function getScriptOdontograma($tipo, $piezas) {
        $js = "<script type='text/javascript'>";
        $js.="var tipo =" . $tipo . ";";
        $js.="var piezas = " . json_encode($piezas) . ";";
        $js.="</script>";
        return $js;
    }

    public function visualizar_odontograma_estados($tipo) {
        try {
            if ($this->verifOdontograma(1) == TRUE) {
                $odontograma = Model_ServicioOdontograma::getInstance()->getOdontogramaEstados($_SESSION['id_tratamiento'], $tipo);
                $odontograma = $this->getScriptOdontograma($tipo, $odontograma['piezas']);
                $view_base = View::factory('base');
                $s = array('public/js/kinetic.js', 'public/js/jquery.js', 'public/js/cara.js', 'public/js/pieza.js', 'public/js/load_odontograma.js');
                $view_base->script('script', $s);
                $c = array('public/css/estilo.css', 'public/css/estilo_odontograma.css');
                $view_base->css('css', $c);
                $view = View::factory('visualizador_odontograma');
                $view_base->set('JsonOdontograma', $odontograma);
                $view_base->set('contenido', $view);
                echo $view_base->render();
            } else {
                $error = "¡No se ha encontrado ningun odontograma de estados para el paciente en este tratamiento!";
                $this->makeError($error, "tratamiento/tratamiento/");
            }
        } catch (Exception $exc) {
            $this->makeError($exc->getTraceAsString(), "tratamiento/tratamiento/");
        }
    }

    public function visualizar_plan($tipo) {
        try {
            if (Model_ServicioOdontograma::getInstance()->verifOdontograma($_SESSION['id_tratamiento'], $tipo) == true) {
                $odontograma = Model_ServicioOdontograma::getInstance()->visualizarOdontogramaPrestaciones($_SESSION['id_tratamiento'], $tipo);
                $odontograma = $this->getScriptOdontograma($tipo, $odontograma['piezas']);
                $view_base = View::factory('base');
                $s = array('public/js/kinetic.js', 'public/js/jquery.js', 'public/js/cara.js', 'public/js/pieza.js', 'public/js/load_odontograma.js');
                $view_base->script('script', $s);
                $c = array('public/css/estilo.css', 'public/css/estilo_odontograma.css');
                $view_base->css('css', $c);
                $view = View::factory('visualizador_odontograma');
                $view_base->set('JsonOdontograma', $odontograma);
                $view_base->set('contenido', $view);
                echo $view_base->render();
            } else {
                $error = "¡Este plan todavia no fue registrado para el paciente en este tratamiento!";
                $this->makeError($error, "tratamiento/tratamiento/");
            }
        } catch (Exception $exc) {
            $this->makeError($exc->getTraceAsString(), "tratamiento/tratamiento/");
        }
    }

    public function visualizar_tratamiento($tipo) {
        try {
            if ($this->verifOdontograma($tipo) == TRUE) {
                switch ($tipo) {
                    case 5:
                        $odontograma = Model_ServicioOdontograma::getInstance()->visualizarOdontogramaPrestaciones($_SESSION['id_tratamiento'], $tipo);
                        break;
                    case 6:
                        $odontograma = Model_ServicioOdontograma::getInstance()->getTratamientoRealizado($_SESSION['id_tratamiento']);
                        break;
                }
                $odontograma = $this->getScriptOdontograma($tipo, $odontograma['piezas']);
                $view_base = View::factory('base');
                $s = array('public/js/kinetic.js', 'public/js/jquery.js', 'public/js/cara.js', 'public/js/pieza.js', 'public/js/load_odontograma.js');
                $view_base->script('script', $s);
                $c = array('public/css/estilo.css', 'public/css/estilo_odontograma.css');
                $view_base->css('css', $c);
                $view = View::factory('visualizador_odontograma');
                $view_base->set('JsonOdontograma', $odontograma);
                $view_base->set('contenido', $view);
                echo $view_base->render();
            } else {
                $error = "¡No se ha encontrado registros de odontogramas de tratamientos de este tipo!";
                $this->makeError($error, "tratamiento/tratamiento/");
            }
        } catch (Exception $exc) {
            $this->makeError($exc->getTraceAsString(), "tratamiento/tratamiento/");
        }
    }

    public function verifOdontograma($tipo) {
        try {
            $b = Model_ServicioOdontograma::getInstance()->verifOdontograma($_SESSION['id_tratamiento'], $tipo);
            return $b;
        } catch (Exception $exc) {
            throw $exc->getMessage();
        }
        return true;
    }

    public function verifExistenciaPlan() {
        try {
            $a = Model_ServicioOdontograma::getInstance();
            return ($a->verifOdontograma($_SESSION['id_tratamiento'], 3) || $a->verifOdontograma($_SESSION['id_tratamiento'], 4)) ? true : false;
        } catch (Exception $exc) {
            throw $exc->getMessage();
        }
        return true;
    }

    public function guardarOdontogramaInicial() {
        try {
            if (isset($_POST['piezas'])) {
                $piezas = $_POST['piezas'];
                $p = Model_ServicioOdontograma::getInstance()->guardarOdontogramaEstados($piezas, $_SESSION['id_tratamiento']);
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
                $p = Model_ServicioOdontograma::getInstance()->actualizarOdontogramaEstados($piezas, $_SESSION['id_odontograma'], $_SESSION['id_tratamiento']);
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
                $p = Model_ServicioOdontograma::getInstance()->guardarTratamientos($piezas, 3, $_SESSION['id_tratamiento']);
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
                $p = Model_ServicioOdontograma::getInstance()->guardarTratamientos($piezas, 4, $_SESSION['id_tratamiento']);
                echo $p;
            }
        } catch (Exception $exc) {
            echo "Error: " . $exc->getMessage();
        }
    }

    public function guardarTratamientoCurso() {
        try {
            if (isset($_POST['piezas'])) {
                $piezas = $_POST['piezas'];
                $p = Model_ServicioOdontograma::getInstance()->guardarTratamientos($piezas, 5, $_SESSION['id_tratamiento']);
                echo $p;
            }
        } catch (Exception $exc) {
            echo "Error: " . $exc->getMessage();
        }
    }

    public function guardarTratamientoRealizado() {
        try {
            if (isset($_POST['piezas'])) {
                $piezas = $_POST['piezas'];
                $p = Model_ServicioOdontograma::getInstance()->guardarTratamientos($piezas, 6, $_SESSION['id_tratamiento']);
                echo $p;
            }
        } catch (Exception $exc) {
            echo "Error: " . $exc->getMessage();
        }
    }

    public function actualizarTratamientoCurso() {
        try {
            if (isset($_POST['piezas'])) {
                $piezas = $_POST['piezas'];
                $p = Model_ServicioOdontograma::getInstance()->actualizarOdontogramaPrestaciones($piezas, $_SESSION['id_odontograma'],$_SESSION['id_tratamiento']);
                echo $p;
            }
        } catch (Exception $exc) {
            echo "Error: " . $exc->getMessage();
        }
    }

    public function verEstandar() {
        $model_odotograma = Model_ServicioOdontograma::getInstance();
        $datos = $model_odotograma->getOdontogramaEstados($_SESSION['id_tratamiento'], 1);
        $view = View::factory('base');
        $scripts = array(
            'public/js/kinetic.js',
            'public/js/jquery.js',
            'public/js/cara.js',
            'public/js/pieza.js',
            'public/js/load_odontograma.js'
        );
        $JsonOdontograma = Model_ServicioOdontograma::getInstance()->getOdontogramaEstados($_SESSION['id_tratamiento'], 1);
        $JsonOdontograma = "var piezas = " . json_encode($JsonOdontograma['piezas']);
        $view->set('JsonOdontograma', $JsonOdontograma);
        $view->script('script', $scripts);
        $view_odontograma = View::factory('visualizador_odontograma');
        $view_estandar = View::factory('estandar');
        $view_estandar->set('odontograma', $view_odontograma);
        $view->set('contenido', $view_estandar);
        $view_estandar->set('datos', $datos);
        echo $view->render();
    }

    public function prueba() {
        Model::factory('servicioOdontograma');
    }

    private function makeError($error, $location) {
        $view = View::factory('error');
        $view->set('error', $error);
        $view->set('location', $location);
        echo $view->render();
    }

}

?>
