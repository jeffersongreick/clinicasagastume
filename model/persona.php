<?php

class Model_Persona extends Model {

    private $ci;
    private $nombre;
    private $apellidos;
    private $email;
    private $foto;
    private $activo;

    public function __construct() {
        parent::__construct();
    }
    public function getCi() {
        return $this->ci;
    }

    public function setCi($ci) {
        $this->ci = $ci;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function getApellidos() {
        return $this->apellidos;
    }

    public function setApellidos($Apellidos) {
        $this->apellidos = $Apellidos;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getFoto() {
        return $this->foto;
    }

    public function setFoto($foto) {
        $this->foto = $foto;
    }

    public function getActivo() {
        return $this->activo;
    }

    public function setActivo($activo) {
        $this->activo = $activo;
    }
    public function toString(){
        return $this->nombre." ".$this->apellidos;
    }
}

?>
