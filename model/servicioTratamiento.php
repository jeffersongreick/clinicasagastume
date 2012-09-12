<?php

class Model_ServicioTratamiento extends Model {

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

    public function getTratamientoPaciente($ci) {
        try {
            $sql = "select * from tbl_tratamientos where activo = 1 and ci_paciente = " . $ci;
            $statement = $this->db->prepare($sql);
            $statement->execute();
            return $statement->fetch(PDO::FETCH_NAMED);
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
    }

    public function getTratamiento($id) {
        try {
            $sql = "select * from tbl_tratamientos where id = " . $id;
            $statement = $this->db->prepare($sql);
            $statement->execute();
            $t = $statement->fetch(PDO::FETCH_NAMED);
            $tratamiento = new Model_Tratamiento();
            $tratamiento->setId($t['id']);
            $tratamiento->setPaciente(Model_ServicioPaciente::getInstance()->getPaciente($t['ci_paciente']));
            $tratamiento->setFecha_ins($t['fecha_ins']);
            $tratamiento->setUsr_ins($t['usr_ins']);
            return $tratamiento;
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
    }

    public function nuevoTratamiento($ci) {
        try {
            $sql = "INSERT INTO tbl_tratamientos (ci_paciente,activo,fecha_ins,usr_ins) values(" . $ci . ",true,'" . date("Y/m/d H:i:s") . "',9)";
            $statement = $this->db->prepare($sql);
            $statement->execute();
            $tratamiento = new Model_Tratamiento();
            $id = $this->db->lastInsertId("tbl_tratamientos");
            $tratamiento->setId($id);
            $tratamiento->setPaciente(Model_ServicioPaciente::getInstance()->getPaciente($ci));
            $tratamiento->setFecha_ins(date("Y/m/d H:i:s"));
            $tratamiento->setUsr_ins(3);
            return $tratamiento;
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
    }

    public function finalizarTratamiento($idTratamiento) {
        try {
            $sql = "UPDATE tbl_tratamiento SET activo = 0 WHERE id = " . $idTratamiento;
            $statement = $this->db->prepare($sql);
            $statement->execute();
            return true;
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
    }
}

?>