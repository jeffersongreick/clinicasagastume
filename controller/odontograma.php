<?php

class Controller_Odontograma {

    private $idTratamiento = 1;
    private $idPaciente = 1;

    public function getEstados() {
        try {
            $estados = Model_ServicioOdontograma::getInstance()->getEstados();
            return $estados;
        } catch (Exception $exc) {
            throw $exc->getMessage();
        }
    }

    public function inicial() {
        try {
            if ($this->verifOdontInicial()) {
                $JsonOdontograma;
                $today = new DateTime("now");
                $intervalo = date_diff($today, $_SESSION['tratamiento']->getPaciente()->getFecha_nac());
                if ($intervalo->format('d') > 2922) {
                    $JsonOdontograma = Model_ServicioOdontograma::getInstance()->getPiezasAdultos();
                    $JsonOdontograma = "var piezas = " . json_encode($JsonOdontograma);
                } else {
                    $JsonOdontograma = Model_ServicioOdontograma::getInstance()->getPiezasInfantiles();
                    $JsonOdontograma = "var piezas = " . json_encode($JsonOdontograma);
                }
                $view = View::factory('editor_odontograma');
                $view->set('listaEstados', $this->getEstados());
                $view->set('JsonOdontograma', $JsonOdontograma);
                echo $view->render();
            } else {
                throw new Exception('El odontograma no podrá ser guardado. No existe un odontograma de estado inicial registrado.');
            }
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    public function actual() {
        try {
            $JsonOdontograma = Model_ServicioOdontograma::getInstance()->getOdontograma($this->idTratamiento, "max", $this->idPaciente);
            $JsonOdontograma = "var piezas = " . json_encode($JsonOdontograma['piezas']);
            $view = View::factory('editor_odontograma');
            $view->set('listaEstados', $this->getEstados());
            $view->set('JsonOdontograma', $JsonOdontograma);
            echo $view->render();
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    public function visualizar_odontograma($id) {
        switch ($id) {
            case "inicial":
                $JsonOdontograma = Model_ServicioOdontograma::getInstance()->getOdontograma($this->idTratamiento, "min", $this->idPaciente);
                break;
            case "actual":
                $JsonOdontograma = Model_ServicioOdontograma::getInstance()->getOdontograma($this->idTratamiento, "max", $this->idPaciente);
                break;
        }
        $JsonOdontograma = "var piezas = " . json_encode($JsonOdontograma['piezas']);
        $view_base = View::factory('base');
        $s = array('public/js/kinetic.js','public/js/jquery.js','public/js/cara.js', 'public/js/pieza.js', 'public/js/load_view.js');
        $view_base->script('script', $s);
        $c = array('public/css/estilo.css','public/css/estilo_odontograma.css');
        $view_base->css('css', $c);
        $view = View::factory('visualizador_odontograma');
        $view->set('JsonOdontograma', $JsonOdontograma);
        $view_base->set('contenido', $view);
        echo $view_base->render();
    }

    public function verifODontInicial() {
        try {
            $b = Model_ServicioOdontograma::getInstance()->verifODontInicial($this->idTratamiento);
            echo $b;
            return $b;
        } catch (Exception $exc) {
            throw $exc->getMessage();
        }
        return true;
    }

    public function guardarOdontograma() {
        try {
            if (isset($_POST['piezas'])) {
                $piezas = $_POST['piezas'];
                $odontograma_model = Model_ServicioOdontograma::getInstance();
                $p = $odontograma_model->guardarOdontograma($piezas);
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

}

?>
