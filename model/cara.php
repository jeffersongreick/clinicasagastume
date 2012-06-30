<?php

class Model_Cara extends Model {
    private $id;
    private $descripcion;
    private $estados;
    
    public function __construct() {
        parent::__construct();
    }
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getDescripcion() {
        return $this->descripcion;
    }

    public function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }
    public function getEstados() {
        return $this->estados;
    }

    public function setEstados($estados) {
        $this->estados = $estado;
    }



}

?>
