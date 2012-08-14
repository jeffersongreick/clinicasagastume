<?php

class Model_ServicioPaciente extends Model {

     private static $instance;

    public static function getInstance() {
        if (!isset(self::$instance)) {
            $a = __CLASS__;
            self::$instance = new $a;
        }
        return self::$instance;
    }

    public function __construct() {
        parent::__construct();
    }

    public function getDatosPaciente($ci) {
        try {
            $sql = "SELECT ci,nombre,apellido FROM clinicadb.tbl_persona inner join tbl_paciente on tbl_paciente.ci_persona= tbl_persona.ci where tbl_paciente.ci_persona =" . $ci;
            $statement = $this->db->prepare($sql);
            $statement->execute();
            return $statement->fetch(PDO::FETCH_NAMED);
        } catch (Exception $exc) {
            throw $exc->getMessage();
        }
    }


    public function getPaciente($ci) {
        try {
            $sql = "SELECT * FROM clinicadb.tbl_persona inner join tbl_paciente on tbl_paciente.ci_persona= tbl_persona.ci where tbl_paciente.ci_persona =" . $ci;
            $statement = $this->db->prepare($sql);
            $statement->execute();
            $t = $statement->fetch(PDO::FETCH_NAMED);
            $paciente = new Model_Paciente();
            $paciente->setCi($t['ci']);
            $paciente->setNombre($t['nombre']);
            $paciente->setApellidos($t['apellido']);
            $paciente->setEmail($t['email']);
            $paciente->setSexo($t['sexo']);
            $paciente->setCiudad($t['ciudad']);
            $paciente->setDireccion($t['direccion']);
            $paciente->setFecha_nac($t['fecha_nac']);
            $paciente->setFoto($t['foto']);
            return $paciente;
        } catch (Exception $exc) {
            throw $exc->getMessage();
        }
    }
}

?>
