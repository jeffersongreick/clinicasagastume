<?php

class Model_ServicioEstado extends Model {

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
    
    public function obtenerEstados() {
        $sql = "SELECT * FROM tbl_estados";
        $query = $this->db->query($sql);
        $list = $query->fetchAll(PDO::FETCH_OBJ);
        return $list;
    }

}

?>
