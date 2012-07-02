<?php
class Model_Tratamiento extends Model {
    private $id;
    private $odontogramas;
        
    public function __construct() {
        parent::__construct();
    }
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getOdontogramas() {
        return $this->odontogramas;
    }

    public function setOdontogramas($odontogramas) {
        $this->odontogramas = $odontogramas;
    }
}

?>
