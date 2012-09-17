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

    protected function __construct() {
        parent::__construct();
    }

    public function obtenerEstados() {
        $sql = "SELECT * FROM tbl_estados";
        $query = $this->db->query($sql);
        $list = $query->fetchAll(PDO::FETCH_OBJ);
        return $list;
    }

    public function getEstados($id_odontograma) {
        try {
            $sql = "SELECT o.id_odontograma,o.activo, o.id_pieza,o.id_cara,o.id_estado,
                    c.descripcion as desc_cara,e.descripcion as desc_estado 
                    FROM tbl_odontograma_estados as o INNER JOIN tbl_piezas as p 
                    INNER JOIN tbl_caras as c INNER JOIN tbl_estados as e 
                    on o.id_pieza = p.id and o.id_cara = c.id and o.id_estado = e.id
                    WHERE id_odontograma = " . $id_odontograma . " and activo = true
                    order by o.id_odontograma, o.id_pieza,o.id_cara,o.id_estado";
            $statement = $this->db->prepare($sql);
            $statement->execute();
            return $statement;
        } catch (Exception $exc) {
            throw $exc->getMessage();
        }
    }

}

?>
