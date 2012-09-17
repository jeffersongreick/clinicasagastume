<?php

session_start();

class Controller_Odontograma {

    public function inicial() {
        try {
            if ($this->verifOdontograma(1) == true) {
                $this->visualizar_odontograma_estados(1);
            } else {
                $error = "Aun no se ha registrado un odontograma de estado inicial para el paciente en este tratamiento";
                Model_Error::getInstance()->makeError($error, "tratamiento/tratamiento/");
            }
        } catch (Exception $exc) {
            Model_Error::getInstance()->makeError($exc->getTraceAsString(), "tratamiento/tratamiento/");
        }
    }

    public function estados() {
        try {
            if ($this->verifOdontograma(1) == TRUE) {
                $odontograma = Model_ServicioOdontograma::getInstance()->getOdontogramaEstadosActual($_SESSION['id_tratamiento']);
                $_SESSION['id_odontograma'] = $odontograma['id'];
                $odontograma = $this->getScriptOdontograma(2, $odontograma['piezas']);
                $nombre = "Estado actual";
            } else {
                $today = new DateTime("now");
                $intervalo = $today;
                if ($intervalo->format('d') > 2922) {
                    $odontograma = Model_ServicioPieza::getInstance()->getPiezasAdultos();
                } else {
                    $odontograma = Model_ServicioPieza::getInstance()->getPiezasInfantiles();
                }
                $odontograma = $this->getScriptOdontograma(1, $odontograma);
                $nombre = "Estado inicial";
            }
            $view_base = View::factory('base');
            $s = array('public/js/kinetic.js', 'public/js/jquery.js', 'public/js/cara.js', 'public/js/pieza.js', 'public/js/functions_odontograma.js', 'public/js/load_odontograma.js', 'public/js/functions_odontograma_estado.js');
            $view_base->script('script', $s);
            $c = array('public/css/estilo.css', 'public/css/estilo_odontograma.css');
            $view_base->css('css', $c);
            $view = View::factory('editor_odontograma_estados');
            $view->set('listaEstados', Model_ServicioEstado::getInstance()->obtenerEstados());
            $view->set('nombre', $nombre);
            $view_base->set('JsonOdontograma', $odontograma);
            $view_base->set('contenido', $view);
            echo $view_base->render();
        } catch (Exception $exc) {
            Model_Error::getInstance()->makeError($exc->getTraceAsString(), "tratamiento/tratamiento/");
        }
    }

    public function planTratamiento($tipo) {
        try {
            if (Model_ServicioOdontograma::getInstance()->verifOdontograma($_SESSION['id_tratamiento'], 1) == true) {
                if (Model_ServicioOdontograma::getInstance()->verifOdontograma($_SESSION['id_tratamiento'], $tipo) == false) {
                    $odontograma = Model_ServicioOdontograma::getInstance()->getEstructuraBucal($_SESSION['id_tratamiento']);
                    $odontograma = $this->getScriptOdontograma($tipo, $odontograma['piezas']);
                    $nombre = ($tipo == 3) ? "Plan propuesto" : "Plan de compromiso";
                    $view_base = View::factory('base');
                    $s = array('public/js/kinetic.js', 'public/js/jquery.js', 'public/js/cara.js', 'public/js/pieza.js', 'public/js/load_odontograma.js', 'public/js/functions_odontograma.js', 'public/js/functions_odontograma_tratamiento.js');
                    $view_base->script('script', $s);
                    $c = array('public/css/estilo.css', 'public/css/estilo_odontograma.css');
                    $view_base->css('css', $c);
                    $view = View::factory('editor_odontograma_prestaciones');
                    $view->set('nombre', $nombre);
                    $view->set('prestaciones', $this->listarPrestacionesHtml());
                    $view_base->set('JsonOdontograma', $odontograma);
                    $view_base->set('contenido', $view);
                    echo $view_base->render();
                } else {
                    $error = "Aun no se ha registrado un odontograma de estado inicial para el paciente en este tratamiento. Favor crearlo antes de continuar.";
                    Model_Error::getInstance()->makeError($error, "tratamiento/tratamiento/");
                }
            } else {
                $error = "¡El plan ya se encuentra registrado en el tratamiento!";
                Model_Error::getInstance()->makeError($error, "tratamiento/tratamiento/");
            }
        } catch (Exception $exc) {
            Model_Error::getInstance()->makeError($exc->getTraceAsString(), "tratamiento/tratamiento/");
        }
    }

    public function tratamientoCurso() {
        try {
            if ((Model_ServicioOdontograma::getInstance()->verifOdontograma($_SESSION['id_tratamiento'], 5)) == TRUE) {
                $odontograma = Model_ServicioOdontograma::getInstance()->getOdontogramaTratamientosCurso($_SESSION['id_tratamiento']);
                $_SESSION['id_odontograma'] = $odontograma['id'];
                $odontograma = $this->getScriptOdontograma(7, $odontograma['piezas']);
            } else {
                if ($this->verifExistenciaPlan() == true) {
                    $odontograma = Model_ServicioOdontograma::getInstance()->getEstructuraBucal($_SESSION['id_tratamiento']);
                    $odontograma = $this->getScriptOdontograma(5, $odontograma['piezas']);
                } else {
                    $error = "¡Todavía no se ha registrado un plan de tratamiento! ¡Favor registrar uno para continuar!";
                    Model_Error::getInstance()->makeError($error, "tratamiento/tratamiento/");
                    exit();
                }
            }
            $view_base = View::factory('base');
            $s = array('public/js/kinetic.js', 'public/js/jquery.js', 'public/js/cara.js', 'public/js/pieza.js', 'public/js/load_odontograma.js', 'public/js/functions_odontograma.js', 'public/js/functions_odontograma_tratamiento.js');
            $view_base->script('script', $s);
            $c = array('public/css/estilo.css', 'public/css/estilo_odontograma.css');
            $view_base->css('css', $c);
            $view = View::factory('editor_odontograma_prestaciones');
            $view->set('nombre', "Tratamientos en curso");
            $view->set('prestaciones', $this->listarPrestacionesHtml());
            $view_base->set('JsonOdontograma', $odontograma);
            $view_base->set('contenido', $view);
            echo $view_base->render();
        } catch (Exception $exc) {
            Model_Error::getInstance()->makeError($exc->getTraceAsString(), "tratamiento/tratamiento/");
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
                $view->set('nombre', "Tratamientos realizados");
                $view->set('prestaciones', $this->listarPrestacionesHtml());
                $view_base->set('JsonOdontograma', $odontograma);
                $view_base->set('contenido', $view);
                echo $view_base->render();
            } else {
                $error = "¡Todavía no se ha registrado un plan de tratamiento! ¡Favor registrar uno para continuar!";
                Model_Error::getInstance()->makeError($error, "tratamiento/tratamiento/");
            }
        } catch (Exception $exc) {
            Model_Error::getInstance()->makeError($exc->getTraceAsString(), "tratamiento/tratamiento/");
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
            Model_Error::getInstance()->makeError($exc->getTraceAsString(), "tratamiento/tratamiento/");
        }
    }

    private function getScriptOdontograma($tipo, $piezas) {
        $js = "<script type='text/javascript'>";
        $js.="var tipo =" . $tipo . ";";
        $js.="var piezas = " . json_encode($piezas) . ";";
        $js.="</script>";
        echo $js;
        return $js;
    }

    public function visualizar_odontograma_estados($tipo) {
        try {
            if ($this->verifOdontograma(1) == TRUE) {
                switch ($tipo) {
                    case 1:
                        $odontograma = Model_ServicioOdontograma::getInstance()->getOdontogramaEstadosInicial($_SESSION['id_tratamiento']);
                        break;
                    case 2:
                        $odontograma = Model_ServicioOdontograma::getInstance()->getOdontogramaEstadosActual($_SESSION['id_tratamiento']);
                        break;
                }
                $_SESSION['id_odontograma'] = $odontograma['id'];
                $odontograma = $this->getScriptOdontograma($tipo, $odontograma['piezas']);
                $nombre = ($tipo == 1) ? "Estado inicial" : "Estado actual";
                $view_base = View::factory('base');
                $s = array('public/js/kinetic.js', 'public/js/jquery.js', 'public/js/cara.js', 'public/js/pieza.js', 'public/js/load_odontograma.js');
                $view_base->script('script', $s);
                $c = array('public/css/estilo.css', 'public/css/estilo_odontograma.css');
                $view_base->css('css', $c);
                $view = View::factory('visualizador_odontograma');
                $view->set('nombre', $nombre);
                $view_base->set('JsonOdontograma', $odontograma);
                $view_base->set('contenido', $view);
                echo $view_base->render();
            } else {
                $error = "¡No se ha encontrado ningun odontograma de estados para el paciente en este tratamiento!";
                Model_Error::getInstance()->makeError($error, "tratamiento/tratamiento/");
            }
        } catch (Exception $exc) {
            Model_Error::getInstance()->makeError($exc->getTraceAsString(), "tratamiento/tratamiento/");
        }
    }

    public function visualizar_plan($tipo) {
        try {
            if (Model_ServicioOdontograma::getInstance()->verifOdontograma($_SESSION['id_tratamiento'], $tipo) == true) {
                  switch ($tipo) {
                    case 3:
                        $odontograma = Model_ServicioOdontograma::getInstance()->getOdontogramaPlanTratamientoPropuesto($_SESSION['id_tratamiento']);
                        break;
                    case 4:
                        $odontograma = Model_ServicioOdontograma::getInstance()->getOdontogramaPlanTratamientoCompromiso($_SESSION['id_tratamiento']);
                        break;
                }
                $_SESSION['id_odontograma'] = $odontograma['id'];
                $odontograma = $this->getScriptOdontograma($tipo, $odontograma['piezas']);
                $nombre = ($tipo == 3) ? "Plan propuesto" : "Plan de compromiso";
                $view_base = View::factory('base');
                $s = array('public/js/kinetic.js', 'public/js/jquery.js', 'public/js/cara.js', 'public/js/pieza.js', 'public/js/load_odontograma.js');
                $view_base->script('script', $s);
                $c = array('public/css/estilo.css', 'public/css/estilo_odontograma.css');
                $view_base->css('css', $c);
                $view = View::factory('visualizador_odontograma');
                $view->set('nombre', $nombre);
                $view_base->set('JsonOdontograma', $odontograma);
                $view_base->set('contenido', $view);
                echo $view_base->render();
            } else {
                $error = "¡Este plan todavia no fue registrado para el paciente en este tratamiento!";
                Model_Error::getInstance()->makeError($error, "tratamiento/tratamiento/");
            }
        } catch (Exception $exc) {
            Model_Error::getInstance()->makeError($exc->getTraceAsString(), "tratamiento/tratamiento/");
        }
    }

    public function visualizar_tratamiento($tipo) {
        try {
            if ($this->verifOdontograma($tipo) == TRUE) {
                switch ($tipo) {
                    case 5:
                        $odontograma = Model_ServicioOdontograma::getInstance()->visualizarOdontogramaTratamientosCurso($_SESSION['id_tratamiento']);
                        $nombre = "Tratamientos en curso";
                        break;
                    case 6:
                        $odontograma = Model_ServicioOdontograma::getInstance()->getOdontogramaTratamientosRealizado($_SESSION['id_tratamiento']);
                        $nombre = "Tratamientos realizados";
                        break;
                }
                $_SESSION['id_odontograma'] = $odontograma['id'];
                $odontograma = $this->getScriptOdontograma($tipo, $odontograma['piezas']);
                $view_base = View::factory('base');
                $s = array('public/js/kinetic.js', 'public/js/jquery.js', 'public/js/cara.js', 'public/js/pieza.js', 'public/js/load_odontograma.js');
                $view_base->script('script', $s);
                $c = array('public/css/estilo.css', 'public/css/estilo_odontograma.css');
                $view_base->css('css', $c);
                $view = View::factory('visualizador_odontograma');
                $view->set('nombre', $nombre);
                $view_base->set('JsonOdontograma', $odontograma);
                $view_base->set('contenido', $view);
                echo $view_base->render();
            } else {
                $error = "¡No se ha encontrado registros de odontogramas de tratamientos de este tipo!";
                Model_Error::getInstance()->makeError($error, "tratamiento/tratamiento/");
            }
        } catch (Exception $exc) {
            Model_Error::getInstance()->makeError($exc->getTraceAsString(), "tratamiento/tratamiento/");
        }
    }

    private function verifOdontograma($tipo) {
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
                $p = Model_ServicioOdontograma::getInstance()->actualizarOdontogramaPrestaciones($piezas, $_SESSION['id_odontograma'], $_SESSION['id_tratamiento']);
                echo $p;
            }
        } catch (Exception $exc) {
            echo "Error: " . $exc->getMessage();
        }
    }

    public function verEstandar($tipo) {
        try {
            $odontograma = Model_ServicioOdontograma::getInstance()->cargarEstandar($_SESSION['id_tratamiento'],$tipo);
            $odontograma = $this->getScriptOdontograma($tipo, $odontograma);
            $view_base = View::factory('base');
            $s = array('public/js/kinetic.js', 'public/js/jquery.js', 'public/js/cara.js', 'public/js/load_odontograma_estandar.js', 'public/js/pieza_estandar.js');
            $view_base->script('script', $s);
            $c = array('public/css/estilo.css', 'public/css/estilo_estandar.css');
            $view_base->css('css', $c);
            $view = View::factory('estandar');
            $view_base->set('JsonOdontograma', $odontograma);
            $view_base->set('contenido', $view);
            echo $view_base->render();
        } catch (Exception $exc) {
            Model_Error::getInstance()->makeError($exc->getTraceAsString(), "tratamiento/tratamiento/");
        }
    }

}

?>
