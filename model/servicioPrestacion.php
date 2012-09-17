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
        public function getPrestaciones($id_odontograma) {
        try {
            $sql = "SELECT o.id_odontograma,o.activo, o.id_pieza,o.id_cara,o.id_prestacion,
                    c.descripcion as desc_cara,e.descripcion as desc_prestacion 
                    FROM tbl_odontograma_prestaciones as o 
                    INNER JOIN tbl_piezas as p INNER JOIN tbl_caras as c INNER JOIN tbl_prestaciones as e 
                    on o.id_pieza = p.id and o.id_cara = c.id and o.id_prestacion = e.id
                    WHERE id_odontograma = " . $id_odontograma . " and activo = true
                    order by o.id_odontograma, o.id_pieza,o.id_cara,o.id_prestacion";
            $statement = $this->db->prepare($sql);
            $statement->execute();
            return $statement;
        } catch (Exception $exc) {
            throw $exc->getMessage();
        }
    }
}
?>
