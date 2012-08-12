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

    public function getPaciente($ci) {
        try {
            $sql = "SELECT * FROM clinicadb.tbl_persona inner join tbl_paciente on tbl_paciente.ci_persona= tbl_persona.ci where tbl_paciente.ci_persona =" . $ci;
            $statement = $this->db->prepare($sql);
            $statement->execute();
            return $statement->fetch();
        } catch (Exception $exc) {
            throw $exc->getMessage();
        }
    }

}

?>
