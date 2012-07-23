<?php

session_start();

class Controller_Odontograma {

    private $idTratamiento = 1;
    private $idPaciente = 1;

    public function index() {
        try {

//            $c = new Controller_Paciente();
//            $_SESSION['paciente'] = $c->getPacienteCi(7);
            $view = View::factory('escritorio');
            echo $view->render();
        } catch (Exception $exc) {
            throw $exc->getMessage();
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
                    if ($this->verifOdontInicial(1)) {
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
                        $view = View::factory('odontograma');
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
                    $view = View::factory('odontograma');
                    $view->set('listaEstados', $this->getEstados());
                    $view->set('JsonOdontograma', $JsonOdontograma);
                    echo $view->render();
                    break;
            }
        } catch (Exception $exc) {
            throw $exc->getMessage();
        }
    }

    public function getEstadoInicial($idTratamiento) {
        try {
            $odontograma = Model_ServicioOdontograma::getInstance()->getOdontograma($idTratamiento, "min");
            return $odontograma;
        } catch (Exception $exc) {
            throw $exc->getMessage();
        }
    }

    public function nuevoOdontogramaInicial($odontogramaInicial, $idTratamiento) {
        try {
            $this->accion = 1;

            $arr = json_decode($odontogramaInicial);
            return Model_ServicioOdontograma::getInstance()->nuevoOdontograma($arr, $idTratamiento);
        } catch (Exception $exc) {
            throw $exc->getMessage();
        }
    }

    public function verifODontInicial($idTratamiento) {
        try {
            $b = Model_ServicioOdontograma::getInstance()->verifODontInicial($idTratamiento);
            return $b;
        } catch (Exception $exc) {
            throw $exc->getMessage();
        }
        return true;
    }

    public function nuevoEstadoActual($odontograma, $idTratamiento) {
        try {
            if ($this->verifOdontInicial($idTratamiento)) {
                $arr = json_decode($odontograma, true);
                var_dump($arr);
                return Model_ServicioOdontograma::getInstance()->nuevoOdontograma($arr, $idTratamiento);
            } else {
                throw new Exception('El odontograma no podrá ser guardado. No existe un odontograma de estado inicial registrado.');
            }
        } catch (Exception $exc) {
            throw new Exception($exc->getMessage());
        }
    }

    public function getEstadoActual() {
        try {
            $odontograma = Model_ServicioOdontograma::getInstance()->getOdontograma($this->idTratamiento, "max", $this->idPaciente);
            return $odontograma;
        } catch (Exception $exc) {
            throw $exc->getMessage();
        }
    }

    public function guardarEstadoActual($odontograma, $idTratamiento) {
        try {
            
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

    public function guardar() {
        if (isset($_POST['piezas'])) {
            $piezas = $_POST['piezas'];
            $odontograma_model = Model_ServicioOdontograma::getInstance();
            $p = $odontograma_model->guardar_odontograma($piezas);
            echo $p;
        }
    }

    public function cargar($id) {
        $model_odotograma = Model_ServicioOdontograma::getInstance();
        $datos = $model_odotograma->obtener_odontograma($id);
        $view = View::factory('carga');
        $view->set('json', json_encode($datos));
        echo $view->render();
        //  var_dump(json_encode($datos));
    }

}

?>
