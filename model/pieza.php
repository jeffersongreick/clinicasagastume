<?php

class Model_Pieza extends Model {

    private $id;
    private $nombre;
    private $url_imagen;
    private $caras;

    public function __construct() {
        parent::__construct();
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function getUrl_imagen() {
        return $this->url_imagen;
    }

    public function setUrl_imagen($url_imagen) {
        $this->url_imagen = $url_imagen;
    }
    public function getCaras() {
        return $this->caras;
    }

    public function setCaras($caras) {
        $this->caras = $caras;
    }
}

?>
