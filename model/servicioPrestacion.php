<?php

class Model_ServicioPrestacion extends Model {

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

    public function listarPrestaciones() {
        try {
            $sql = "select * from tbl_prestaciones order by descripcion";
            $statement = $this->db->prepare($sql);
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_NAMED);
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
    }
}
?>
