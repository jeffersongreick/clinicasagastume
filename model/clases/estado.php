<?php

class Model_Estado extends Model{
    private $id;
    private $estado;
    private $url_img;
    public function __construct() {
        parent::__construct();
    }
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getEstado() {
        return $this->estado;
    }

    public function setEstado($estado) {
        $this->estado = $estado;
    }

    public function getUrl_img() {
        return $this->url_img;
    }

    public function setUrl_img($url_img) {
        $this->url_img = $url_img;
    }


}

?>
