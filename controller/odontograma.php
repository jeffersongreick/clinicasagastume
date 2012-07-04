<?php

class Controller_Odontograma {

    public function index() {
        $view = View::factory('layout');
        $contenido = View::factory('index');
        $view->set('contenido', $contenido);
        echo $view->render();
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
            return $b;
        } catch (Exception $exc) {
            throw $exc->getMessage();
        }
    }

    public function nuevoEstadoActual($odontograma, $idTratamiento) {
        try {
            $arr = json_decode($odontograma);
            return Model_ServicioOdontograma::getInstance()->nuevoOdontograma($arr, $idTratamiento);
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
