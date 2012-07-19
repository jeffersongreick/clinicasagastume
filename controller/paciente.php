<?php

class Controller_Paciente extends Controller {

    public function __construct() {
        parent::__construct();
    }

    public function getPacienteCI($ci) {
        return Model_servicioPacientes::getInstance()->getPacienteCI($ci);
    }

    public function getTratamiento($ciPaciente) {
        
    }

}

?>
