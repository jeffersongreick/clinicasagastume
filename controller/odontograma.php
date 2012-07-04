<?php

class Controller_Odontograma {

    public function index() {
        try {
//        $view = View::factory('layout');
//        $contenido = View::factory('index');
//        $view->set('contenido', $contenido);
//        echo $view->render();
            $odontogram = '{"id_pieza": 44, "id_cara": 4, "id_estado": 4}';
            echo $this->nuevoEstadoActual($odontogram, 1);
        } catch (Exception $exc) {
            echo  $exc->getMessage();
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
            $arr = json_decode($odontogramaInicial);
            return Model_ServicioOdontograma::getInstance()->nuevoOdontograma($arr, $idTratamiento);
        } catch (Exception $exc) {
            throw $exc->getMessage();
        }
    }

    public function verifODontInicial($idTratamiento) {
        try {
            $b = Model_ServicioOdontograma::getInstance()->verifODontInicial($idTratamiento);
            return "hola";
        } catch (Exception $exc) {
            throw $exc->getMessage();
        }
    }   

    public function nuevoEstadoActual($odontograma, $idTratamiento) {
        try {
            if ($this->verifOdontInicial($idTratamiento)) {
                $arr = json_decode($odontograma,true);
                
                return Model_ServicioOdontograma::getInstance()->nuevoOdontograma($arr, $idTratamiento);
            } else {
                throw new Exception('El odontograma no podrá ser guardado. No existe un odontograma de estado inicial registrado.');
            }
        } catch (Exception $exc) {
            throw $exc->getMessage();
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

}

?>
