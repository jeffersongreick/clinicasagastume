<?php

class Model_ServicioPieza extends Model {

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

    public function getPiezasPaciente($id_odontograma) {
        try {
            $sql = "SELECT * FROM tbl_paciente_piezas where id_odontograma = " . $id_odontograma;
            $statement = $this->db->prepare($sql);
            $statement->execute();
            return $statement->fetch(PDO::FETCH_NAMED);
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function getPiezasAdultos() {
        $piezas = array();
        $piezas = $this->auxGetPiezasIzquierda(1, 1, "adulto", $piezas);
        $piezas = $this->auxGetPiezasDerecha(2, 2, "adulto", $piezas);
        $piezas = $this->auxGetPiezasIzquierda(4, 4, "adulto", $piezas);
        $piezas = $this->auxGetPiezasDerecha(3, 3, "adulto", $piezas);
        return $piezas;
    }

    public function getPiezasInfantiles() {
        $piezas = array();
        $piezas = $this->auxGetPiezasIzquierda(5, 1, "infantil", $piezas);
        $piezas = $this->auxGetPiezasDerecha(6, 2, "infantil", $piezas);
        $piezas = $this->auxGetPiezasIzquierda(8, 4, "infantil", $piezas);
        $piezas = $this->auxGetPiezasDerecha(7, 3, "infantil", $piezas);
        return $piezas;
    }

    public function auxGetPiezasIzquierda($id, $num, $tipo, $colPiezas) {
        for ($i = 8; $i >= 1; $i--) {
            $pieza = array();
            if ($tipo == "infantil" & $i > 5) {
                $pieza['id'] = 0;
            } else {
                $pieza['id'] = $id . $i;
            }
            $pieza['pos'] = $num . $i;
            array_push($colPiezas, $pieza);
        }
        return $colPiezas;
    }

    public function auxGetPiezasDerecha($id, $num, $tipo, $colPiezas) {
        for ($i = 1; $i <= 8; $i++) {
            $pieza = array();
            if ($tipo == "infantil" & $i > 5) {
                $pieza['id'] = 0;
            } else {
                $pieza['id'] = $id . $i;
            }
            $pieza['pos'] = $num . $i;
            array_push($colPiezas, $pieza);
        }

        return $colPiezas;
    }

}

?>