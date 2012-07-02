<?php
class Model_Paciente extends Model_Persona{
    private $fecha_nac;
    private $direccion;
    private $sexo;
    private $ciudad;
    
    public function __construct() {
        parent::__construct();
    }
    public function getFecha_nac() {
        return $this->fecha_nac;
    }

    public function setFecha_nac($fecha_nac) {
        $this->fecha_nac = $fecha_nac;
    }

    public function getDireccion() {
        return $this->direccion;
    }

    public function setDireccion($direccion) {
        $this->direccion = $direccion;
    }

    public function getSexo() {
        return $this->sexo;
    }

    public function setSexo($sexo) {
        $this->sexo = $sexo;
    }

    public function getCiudad() {
        return $this->ciudad;
    }

    public function setCiudad($ciudad) {
        $this->ciudad = $ciudad;
    }


}

?>
