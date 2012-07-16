<?php

class Controller_Odontograma {

    public function index() {
        try {
            $view = View::factory('escritorio');

            echo $view->render();
        } catch (Exception $exc) {
            throw $exc->getMessage();
        }
    }

    public function getEstados() {
        try {
           $estados = Model_ServicioOdontograma::getInstance()->getEstados();
           $list = "";
            while ($filas = $estados->fetch()) {
                $id = $filas['id'];
                $list .= "<input type='checkbox' id='estado_$id'; class='item' value=$id onchange='agregarEstado(this)'/><label for='estado_$id';>
                <img src='".URL . $filas['url_img'] . "' class='iconos' id=$id name='" . $filas['estado'] . "'/></label>";
            }
            return $list;
        } catch (Exception $exc) {
            throw $exc->getMessage();
        }
    }

    public function getOdontograma($idTratamiento) {
        try {
            if ($this->verifOdontInicial($idTratamiento)) {
                $view = View::factory('odontograma');
               $view->set('listaEstados',$this->getEstados());
                echo $view->render();
            } else {
                throw new Exception('El odontograma no podrá ser guardado. No existe un odontograma de estado inicial registrado.');
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

}

?>
