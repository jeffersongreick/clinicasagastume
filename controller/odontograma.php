<?php

session_start();

class Controller_Odontograma {

    public function inicial() {
        try {
                $JsonOdontograma;
                $today = new DateTime("now");
                $intervalo = $today;
                if ($intervalo->format('d') > 2922) {
                    $JsonOdontograma = Model_ServicioPieza::getInstance()->getPiezasAdultos();
                    $JsonOdontograma = "var piezas = " . json_encode($JsonOdontograma).";var tipo ='guardarOdontogramaInicial'";
                } else {
                    $JsonOdontograma = Model_ServicioPieza::getInstance()->getPiezasInfantiles();
                    $JsonOdontograma = "var piezas = " . json_encode($JsonOdontograma).";var tipo ='guardarOdontogramaInicial'";
                }
                $view = View::factory('editor_odontograma_estados');
                $view->set('listaEstados', Model_ServicioEstado::getInstance()->obtenerEstados());
                $view->set('JsonOdontograma', $JsonOdontograma);
                echo $view->render();
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    public function actual() {
        try {
            $JsonOdontograma = Model_ServicioOdontograma::getInstance()->getOdontograma($_SESSION['id_tratamiento'], 2);
            $_SESSION['id_odontograma'] = $JsonOdontograma['id'];
            $JsonOdontograma = "var piezas = " . json_encode($JsonOdontograma['piezas']).";var tipo ='guardarOdontogramaActual';";
            
            $view = View::factory('editor_odontograma_estados');

            $view->set('listaEstados', Model_ServicioEstado::getInstance()->obtenerEstados());
            $view->set('JsonOdontograma', $JsonOdontograma);
            echo $view->render();
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    public function visualizar_odontograma($tipo) {
        switch ($tipo) {
            case "inicial":
                $JsonOdontograma = Model_ServicioOdontograma::getInstance()->getOdontograma($_SESSION['id_tratamiento'], 1);
                break;
            case "actual":
                $JsonOdontograma = Model_ServicioOdontograma::getInstance()->getOdontograma($_SESSION['id_tratamiento'], 2);
                break;
        }
        $JsonOdontograma = "var piezas = " . json_encode($JsonOdontograma['piezas']);
        $view_base = View::factory('base');
        $s = array('public/js/kinetic.js', 'public/js/jquery.js', 'public/js/cara.js', 'public/js/pieza.js', 'public/js/load_view.js');
        $view_base->script('script', $s);
        $c = array('public/css/estilo.css', 'public/css/estilo_odontograma.css');
        $view_base->css('css', $c);
        $view = View::factory('visualizador_odontograma');
        $view->set('JsonOdontograma', $JsonOdontograma);
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
                $odontograma_model = Model_ServicioOdontograma::getInstance();
                $p = $odontograma_model->guardarOdontograma($piezas,1);
                $p = $odontograma_model->guardarOdontograma($piezas,2);
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
                $odontograma_model = Model_ServicioOdontograma::getInstance();
                $p = $odontograma_model->actualizarOdontograma($piezas, $_SESSION['id_odontograma'] );
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
    
    public function prueba(){
        Model::factory('servicioOdontograma');
    }
            
}

?>
