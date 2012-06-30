<?php

class Model_ServicioPacientes extends Model {

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

    public function getPacienteCI($ci) {
        $sql = "SELECT * FROM tbl_paciente WHERE ci_persona =".$ci;
        $statement = $this->db->prepare($sql);
        $statement->execute();
        $res = $statement->fetchObject();
        return $res;
    }
}

?>
