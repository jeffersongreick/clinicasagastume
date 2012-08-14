<?php

class Model_Tratamiento extends Model {

    private $id;
    private $fecha_ins;
    private $usr_ins;
    private $paciente;

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getFecha_ins() {
        return $this->fecha_ins;
    }

    public function setFecha_ins($fecha_ins) {
        $this->fecha_ins = $fecha_ins;
    }

    public function getUsr_ins() {
        return $this->usr_ins;
    }

    public function setUsr_ins($usr_ins) {
        $this->usr_ins = $usr_ins;
    }

    public function getPaciente() {
        return $this->paciente;
    }

    public function setPaciente($paciente) {
        $this->paciente = $paciente;
    }

}

?>
