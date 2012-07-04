<?php

class Controller_Odontograma {

    public function index() {
        $view = View::factory('layout');
        $contenido = View::factory('index');
        $view->set('contenido', $contenido);
        echo $view->render();
    }

    public function getEstadoInicial($idTratamiento) {
        $odontograma = Model_ServicioOdontograma::getInstance()->getOdontograma($idTratamiento,"min");
        return $odontograma;
    }

    public function nuevoOdontogramaInicial($odontogramaInicial, $idTratamiento) {
     
    }

    public function verifODontInicial($idTratamiento) {
        $b = Model_ServicioOdontograma::getInstance()->verifODontInicial($idTratamiento);
        return $b;
    }

    public function nuevoEstadoActual($odontograma, $idTratamiento) {
        
    }

    public function getEstadoActual($idTratamiento) {
        $odontograma = Model_ServicioOdontograma::getInstance()->getOdontograma($idTratamiento,"max");
        return $odontograma;
    }

    public function guardarEstadoActual($odontograma, $idTratamiento) {
        
    }

    public function getOdontogramasTratamiento($idTratamiento) {
        $odontogramas = Model_ServicioOdontograma::getInstance()->getOdontogramasTratamiento($idTratamiento);
        return $odontogramas;
    }

    public function getOdontogramasTratamientofecha($idTratamiento, $desdeFecha, $hastaFecha) {
        
    }

}

?>
