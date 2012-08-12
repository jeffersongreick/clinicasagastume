<?php

class Model_ServicioOdontograma extends Model {

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
            $sql = "SELECT tbl_persona.ci,tbl_persona.nombre,tbl_persona.apellido FROM clinicadb.tbl_persona 
                inner join tbl_paciente on tbl_paciente.ci_persona= tbl_persona.ci where tbl_paciente.ci_persona =" . $ci;
            $statement = $this->db->prepare($sql);
            $statement->execute();
            return $statement->fetch(PDO::FETCH_NAMED);
        } catch (Exception $exc) {
            throw $exc->getMessage();
        }
    }

    public function crearOdontograma($rows, $id_paciente) {
        try {
            $odontograma = array();
            $colPiezas = array();
            $row = $rows->fetch();
            $p = $this->getPiezasPaciente($row['id_odontograma']);
            asort($p);
            foreach ($p as $key => $value) {
                if ($key == "id_odontograma") {
                    $odontograma['id'] = $value;
                } else {
                    $pieza = array();
                    $pieza['id'] = $value;
                    $pieza['caras'] = array();
                    $pieza['pos'] = $key;
                    if (isset($row)) {
                        while ($row['id_pieza'] == $pieza['id']) {
                            if (!isset($cara)) {
                                $cara = array();
                                $cara['id'] = $row['id_cara'];
                                $cara['desc'] = $row['desc_cara'];
                                $cara['estados'] = array();
                            } else if ($row['id_cara'] != $cara['id']) {
                                array_push($pieza['caras'], $cara);
                                $cara = array();
                                $cara['id'] = $row['id_cara'];
                                $cara['desc'] = $row['desc_cara'];
                                $cara['estados'] = array();
                            }
                            $estado = Array();
                            $estado['id'] = $row['id_estado'];
                            $estado['desc_estado'] = $row['desc_estado'];
                            $estado['url_img'] = $row['url_estado'];
                            array_push($cara['estados'], $estado);
                            $row = $rows->fetch();
                            if ($row['id_pieza'] != $pieza['id']) {
                                array_push($pieza['caras'], $cara);
                                $cara = null;
                            }
                        }
                    }
                    array_push($colPiezas, $pieza);
                }
            }
            $odontograma['piezas'] = $colPiezas;
            return $odontograma;
        } catch (Exception $exc) {
            throw $exc->getMessage();
        }
    }

    public function verifODontInicial($idTratamiento) {
        try {
            $sql = "select count(id) from tbl_odontograma where id_tratamiento =" . $idTratamiento;
            $statement = $this->db->prepare($sql);
            $statement->execute();
            $p = $statement->fetch();
            $b = false;
            if (!$p[0] > 0) {
                $b = true;
            }
            return $b;
        } catch (Exception $exc) {
            throw $exc->getMessage();
        }
    }

    public function getOdontograma($idTratamiento, $tipo, $idPaciente) {
        try {
            $sql = "SELECT o.id_odontograma, o.id_pieza,o.id_cara,o.id_estado,
        c.descripcion as desc_cara,e.estado as desc_estado,e.url_img as url_estado FROM 
        tbl_odontograma_estado as o inner join tbl_piezas as p inner join
        tbl_cara as c inner join tbl_estado as e on o.id_pieza = p.id and o.id_cara = c.id and o.id_estado = e.id
        where id_odontograma = (select " . $tipo . "(id) from tbl_odontograma where id_tratamiento = " . $idTratamiento . ")
        order by o.id_odontograma, o.id_pieza,o.id_cara,o.id_estado";
            $statement = $this->db->prepare($sql);
            $statement->execute();
            $odontograma = $this->crearOdontograma($statement, $idPaciente);
            return $odontograma;
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
    }

    public function getOdontogramasTratamiento($idTratamiento, $desdeFecha, $hastaFecha) {
        try {
            $sql = "SELECT o.id_odontograma, o.id_pieza,o.id_cara,o.id_estado,p.nombre as nombre_pieza, p.url_img as url_pieza,
        c.descripcion as desc_cara,e.estado as desc_estado,e.url_img as url_estado FROM 
        tbl_odontograma_estado as o inner join tbl_piezas as p inner join
        tbl_cara as c inner join tbl_estado as e on o.id_pieza = p.id and o.id_cara = c.id and o.id_estado = e.id
        where id_odontograma = (select id from tbl_odontograma where id_tratamiento =" . $idTratamiento;
            if (isset($desdeFecha) & isset($hastaFecha)) {
                $sql .=" and fecha BETWEEN '$desdeFecha' AND '$hastaFecha'";
            }
            $sql .=") order by o.id_odontograma, o.id_pieza,o.id_cara,o.id_estado";
            echo $sql;
            $statement = $this->db->prepare($sql);
            $statement->execute();
            $colOdontogramas = array();
            if (isset($statement)) {
                $colOdontogramas = $this->crearOdontograma($statement);
            }
            return $colOdontogramas;
        } catch (Exception $exc) {
            throw $exc->getMessage();
        }
    }

    public function getEstados() {
        $sql = "SELECT * FROM tbl_estado";
        $query = $this->db->query($sql);
        $list = $query->fetchAll(PDO::FETCH_OBJ);
        return $list;
    }

    public function getPiezasPaciente($id_odontograma) {
        try {
            $sql = "SELECT * FROM tbl_paciente_piezas where id_odontograma = " . $id_odontograma;
            $statement = $this->db->prepare($sql);
            $statement->execute();
            return $statement->fetch(PDO::FETCH_NAMED);
        } catch (PDOException $exc) {
            echo new Exception($exc->getMessage());
        }
    }

    public function guardarOdontograma($piezas) {
        try {
            $this->db->beginTransaction();
            $sql_odontograma = "INSERT INTO tbl_odontograma (id_tratamiento,fecha) values(1,'" . date("Y/m/d H:i:s") . "')";
            $this->db->exec($sql_odontograma);
            $id_odontograma = $this->db->lastInsertId("tbl_odontograma");
            $sql_piezas = "INSERT INTO tbl_paciente_piezas values(" . $id_odontograma . ",";
            $sql_estados = "INSERT INTO tbl_odontograma_estado (id_odontograma,id_pieza,id_cara,id_estado,fecha_ins) 
            values(:id,:pieza,:cara,:estado,:fecha)";
            $statement = $this->db->prepare($sql_estados);
            $statement->bindValue(':id', $id_odontograma);
            foreach ($piezas as $pieza) {
                $sql_piezas.=$pieza['id'] . ",";
                $statement->bindValue(':pieza', $pieza['id']);
                if (isset($pieza['caras'])) {
                    foreach ($pieza['caras'] as $cara) {
                        $statement->bindValue(':cara', $cara['id']);
                        if (isset($cara['estados'])) {
                            foreach ($cara['estados'][0] as $estado) {
                                $statement->bindValue(':estado', $estado);
                                $statement->bindValue(':fecha', date('Y/m/d H:i:s'));
                                $statement->execute();
                            }
                        }
                    }
                }
            }
            $sql_piezas = substr_replace($sql_piezas, ')', (strlen($sql_piezas) - 1));
            $this->db->exec($sql_piezas);
            $this->db->commit();
            return true;
        } catch (PDOException $exc) {
            $this->db->rollBack();
            throw new Exception($exc->getMessage());
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

    public function cargarEstandar($id) {
        $sql = "Select id_pieza,id_cara,id_estado,estado 
            From tbl_odontograma_estado inner join tbl_estado on id_estado = id where id =" . $id . " order by id_pieza,id_cara";
        $result = $this->db->query($sql);
        return $result->fetchAll();
    }

}

?>
