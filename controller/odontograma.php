<?php

class Controller_Odontograma {
    private $idTratamiento = 1;
    private $idPaciente = 1;

    public function index() {
        try {
            $view = View::factory('escritorio');
            echo $view->render();
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
    }

    public function getEstados() {
        try {
            $estados = Model_ServicioOdontograma::getInstance()->getEstados();
            return $estados;
        } catch (Exception $exc) {
            throw $exc->getMessage();
        }
    }

    public function getViewOdontogramaFactory($accion) {
        try {
            switch ($accion) {
                case 1:
                    if ($this->verifOdontInicial()) {
                        $JsonOdontograma;
                        $datetime1 = new DateTime("now");
                        $datetime2 = new DateTime("2008/12/12");
                        $intervalo = date_diff($datetime1, $datetime2);
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
                        break;
                    } else {
                        throw new Exception('El odontograma no podrá ser guardado. No existe un odontograma de estado inicial registrado.');
                    }
                case 2:
                    $JsonOdontograma = $this->getEstadoActual();
                    $JsonOdontograma = "var piezas = " . json_encode($JsonOdontograma['piezas']);
                    $view = View::factory('editor_odontograma');
                    $view->set('listaEstados', $this->getEstados());
                    $view->set('JsonOdontograma', $JsonOdontograma);
                    echo $view->render();

                    break;
            }
        } catch (Exception $exc) {
            throw $exc->getMessage();
        }
    }

    public function visualizar_odontograma($id) {

        switch ($id) {
            case "inicial":
                $JsonOdontograma = $this->getEstadoInicial();
                break;
            case "actual":
                $JsonOdontograma = $this->getEstadoActual();
                break;

            
        }
        $JsonOdontograma = "var piezas = " . json_encode($JsonOdontograma['piezas']);
        $view = View::factory('visualizador_odontograma');
        $view->set('listaEstados', $this->getEstados());
        $view->set('JsonOdontograma', $JsonOdontograma);
        echo $view->render();
    }

    public function getEstadoInicial() {
        try {
            $odontograma = Model_ServicioOdontograma::getInstance()->getOdontograma($this->idTratamiento, "min", $this->idPaciente);
            return $odontograma;
        } catch (Exception $exc) {
            throw $exc->getMessage();
        }
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

    public function getEstadoActual() {
        try {
            $odontograma = Model_ServicioOdontograma::getInstance()->getOdontograma($this->idTratamiento, "max", $this->idPaciente);
            return $odontograma;
        } catch (Exception $exc) {
            throw $exc->getMessage();
        }
    }
    public function getOdontogramasTratamiento($idTratamiento) {
        try {
            $odontogramas = Model_ServicioOdontograma::getInstance()->getOdontogramasTratamiento($idTratamiento);
            return $odontogramas;
        } catch (Exception $exc) {
            throw $exc->getMessage();
        }
    }

    public function getOdontogramasTratamientofecha($idTratamiento, $desdeFecha, $hastaFecha) {
        try {
            $odontogramas = Model_ServicioOdontograma::getInstance()->getOdontogramasTratamiento($idTratamiento, $desdeFecha, $hastaFecha);
            return $odontogramas;
        } catch (Exception $exc) {
            throw $exc->getMessage();
        }
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
}

?>
