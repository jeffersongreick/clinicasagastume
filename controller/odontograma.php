<?php

session_start();

class Controller_Odontograma {

    public function index() {
        try {

            $c = new Controller_Paciente();
            $_SESSION['paciente'] = $c->getPacienteCi(7);
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
                            $JsonOdontograma = "var piezas = {superior:[{id:18,posX:15},{id:17,posX:75},{id:16,posX:135},{id:15,posX:195},
                                {id:14,posX:255},{id:13,posX:315},{id:12,posX:375},{id:11,posX:435},{id:21,posX:495},{id:22,posX:555},
                                {id:23,posX:615},{id:24,posX:675},{id:25,posX:735},{id:26,posX:795},{id:27,posX:855},{id:0,posX:915}],
        inferior:[{id:48,posX:15},{id:47,posX:75},{id:46,posX:135},{id:45,posX:195},{id:44,posX:255},{id:43,posX:315},{id:42,posX:375},
        {id:41,posX:435},{id:31,posX:495},{id:32,posX:555},{id:0,posX:615},{id:34,posX:675},{id:35,posX:735},{id:36,posX:795},{id:37,
        posX:855},{id:38,posX:915}]}";
                        } else {
                            $JsonOdontograma = "var piezas = {superior:[{id:0,posX:15},{id:0,posX:75},{id:0,posX:135},{id:55,posX:195},
                                {id:54,posX:255},{id:53,posX:315},{id:52,posX:375},{id:51,posX:435},{id:61,posX:495},{id:62,posX:555},
                                {id:63,posX:615},{id:64,posX:675},{id:65,posX:735},{id:0,posX:795},{id:0,posX:855},{id:0,posX:915}],
        inferior:[{id:0,posX:15},{id:0,posX:75},{id:0,posX:135},{id:85,posX:195},{id:84,posX:255},{id:83,posX:315},{id:82,posX:375},
        {id:81,posX:435},{id:71,posX:495},{id:72,posX:555},{id:73,posX:615},{id:74,posX:675},{id:75,posX:735},{id:0,posX:795},{id:0,
        posX:855},{id:0,posX:915}]}
";
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
                    break;
            }
        } catch (Exception $exc) {
            throw $exc->getMessage();
        }
    }

    public function getPiezas() {
        try {
            $piezas = Model_ServicioOdontograma::getInstance()->getPiezas();
            return $piezas;
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
//        try {
//            $b = Model_ServicioOdontograma::getInstance()->verifODontInicial($idTratamiento);
//            return $b;
//        } catch (Exception $exc) {
//            throw $exc->getMessage();
//        }
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

    public function getEstadoActual($idTratamiento) {
        try {
            $odontograma = Model_ServicioOdontograma::getInstance()->getOdontograma($idTratamiento, "max");
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
            foreach ($piezas as $p) {
                
            }
        }
    }

}

?>
