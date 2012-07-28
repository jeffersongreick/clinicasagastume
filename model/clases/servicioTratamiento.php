<?php

class Model_ServicioTratamiento {

    private static $instance;

    public static function getInstance() {
        if (!isset(self::$instance)) {
            $a = __CLASS__;
            self::$instance = new $a;
        }
        return self::$instance;
    }

    private function __construct() {
        parent::__construct();
    }

    public function getTratamientoId($id) {
        $tratamiento = new Model_Tratamiento();
        $tratamiento->setId($id);
        $tratamiento->setOdontogramas(Model_ServicioOdontograma::getInstance()->getOdontogramasTratamiento(1));
        return $tratamiento;
    }

}

?>
