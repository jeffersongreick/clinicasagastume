<?php

class Model_Odontograma extends Model {
    private $id;
    private $fecha;
    private $piezas;
    
    
    public function __construct() {
        parent::__construct();
    }
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getCi_paciente() {
        return $this->ci_paciente;
    }

    public function setCi_paciente($ci_paciente) {
        $this->ci_paciente = $ci_paciente;
    }

    public function getFecha() {
        return $this->fecha;
    }

    public function setFecha($fecha) {
        $this->fecha = $fecha;
    }

    public function getPiezas() {
        return $this->piezas;
    }

    public function setPiezas($piezas) {
        $this->piezas = $piezas;
    }


}

?>
