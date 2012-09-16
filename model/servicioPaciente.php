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
            $sql = "SELECT ci,CONCAT(nombre, ' ', apellido) as nombre FROM tbl_personas where ci =" . $ci;
            $statement = $this->db->prepare($sql);
            $statement->execute();
            return $statement->fetch(PDO::FETCH_NAMED);
        } catch (Exception $exc) {
            throw new Exception("¡Error en la busqueda del paciente!");
        }
    }

    public function getPacientes($str) {
        try {
            $sql = "SELECT ci,CONCAT(nombre, ' ', apellido) as nombre
                    FROM tbl_personas inner join tbl_pacientes
                    on ci_persona = ci
                    where nombre like '" . $str . "%'";
            $statement = $this->db->prepare($sql);
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_NAMED);
        } catch (Exception $exc) {
            throw $exc->getMessage();
        }
    }
    public function getPaciente($ci) {
        try {
            $sql = "SELECT * FROM tbl_personas inner join tbl_pacientes on tbl_pacientes.ci_persona= tbl_personas.ci where tbl_pacientes.ci_persona =" . $ci;
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
