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
            $sql = "select * from tbl_tratamiento where activo = 1 and ci_paciente = " . $ci;
            $statement = $this->db->prepare($sql);
            $statement->execute();
            return $statement->fetch(PDO::FETCH_NAMED);
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
    }

    public function nuevoTratamiento($ci) {
        try {
            $sql = "INSERT INTO tbl_tratamiento (ci_paciente,activo,fecha_ins,usr_ins) values(".$ci.",true,'" . date("Y/m/d H:i:s") . "',3)";
            $statement = $this->db->prepare($sql);
            $statement->execute();
            return true;
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
    }
}
?>
