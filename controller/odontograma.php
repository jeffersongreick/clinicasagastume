<?php

session_start();

class Controller_Odontograma {

    private $idTratamiento = 1;

//    private $idTratamiento = 1;
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
                            $JsonOdontograma = "var piezas = {superior:[{id:18,estados:[],posX:15},{id:17,estados:[],posX:75},{id:16,estados:[],posX:135},{id:15,estados:[],posX:195},
                                {id:14,estados:[],posX:255},{id:13,estados:[],posX:315},{id:12,estados:[],posX:375},{id:11,estados:[],posX:435},{id:21,estados:[],posX:495},{id:22,estados:[],posX:555},
                                {id:23,estados:[],posX:615},{id:24,estados:[],posX:675},{id:25,estados:[],posX:735},{id:26,estados:[],posX:795},{id:27,estados:[],posX:855},{id:0,estados:[],faltante:'28',posX:915}],
        inferior:[{id:48,estados:[],posX:15},{id:47,estados:[],posX:75},{id:46,estados:[],posX:135},{id:45,estados:[],posX:195},{id:44,estados:[],posX:255},{id:43,estados:[],posX:315},{id:42,estados:[],posX:375},
        {id:41,estados:[],posX:435},{id:31,estados:[],posX:495},{id:32,estados:[],posX:555},{id:0,estados:[],faltante:'33',posX:615},{id:34,estados:[],posX:675},{id:35,estados:[],posX:735},{id:36,estados:[],posX:795},{id:37,estados:[], posX:855},{id:38,estados:[],posX:915}]}";
                        } else {
                            $JsonOdontograma = "var piezas = {superior:[{id:0,estados:[], faltante:'18',posX:15},{id:0,estados:[], faltante:'17',posX:75},{id:0,estados:[], faltante:'16',posX:135},{id:55,estados:[],posX:195},
                                {id:54,estados:[],posX:255},{id:53,estados:[],posX:315},{id:52,estados:[],posX:375},{id:51,estados:[],posX:435},{id:61,estados:[],posX:495},{id:62,estados:[],posX:555},
                                {id:63,estados:[],posX:615},{id:64,estados:[],posX:675},{id:65,estados:[],posX:735},{id:0,estados:[] ,faltante:'26',posX:795},{id:0,estados:[], faltante:'27',posX:855},{id:0,estados:[],faltante:'28',posX:915}],
        inferior:[{id:0,estados:[], faltante:'48',posX:15},{id:0,estados:[], faltante:'47',posX:75},{id:0,estados:[], faltante:'46',posX:135},{id:85,estados:[],posX:195},{id:84,estados:[],posX:255},{id:83,estados:[],posX:315},{id:82,estados:[],posX:375},
        {id:81,estados:[],posX:435},{id:71,estados:[],posX:495},{id:72,estados:[],posX:555},{id:73,estados:[],posX:615},{id:74,estados:[],posX:675},{id:75,estados:[],posX:735},{id:0,estados:[], faltante:'36',posX:795},{id:0,estados:[], faltante:'37',posX:855},{id:0,estados:[], faltante:'38',posX:915}]}";
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
                    if ($this->verifOdontInicial()) {
                        $JsonOdontograma = $this->getEstadoActual();
                        var_dump($JsonOdontograma);
                        $JsonOdontograma = json_encode($JsonOdontograma);
                        echo $JsonOdontograma;
//                        $view = View::factory('odontograma');
//                        $view->set('listaEstados', $this->getEstados());
//                        $view->set('JsonOdontograma', $JsonOdontograma);
//                        echo $view->render();
                    }
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

    public function getEstadoActual() {
        try {
            $odontograma = Model_ServicioOdontograma::getInstance()->getOdontograma($this->idTratamiento, "max");
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
            $odontograma_model->guardar_odontograma($piezas);
        }
        
    }
   
}

?>
