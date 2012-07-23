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

    public function crearOdontograma($rows, $id_paciente) {
        try {
            $odontograma = array();
            $colPiezas = array();
            $posS = 15;
            $posI = 15;
            $row = $rows->fetch();
            $p = $this->getPiezasPaciente($row['id_odontograma']);
            foreach ($p as $key => $value) {
                if ($key == "0") {
                    $odontograma['id'] = $value;
                } else {
                    $pieza = array();
                    $pieza['id'] = $value;
                    $pieza['caras'] = array();
                    if ($value <= 28) {
                        $pieza['posX'] = $posS;
                        $pieza['posY'] = 0;
                        $posS += 60;
                    } else {
                        $pieza['posX'] = $posI;
                        $pieza['posY'] = 270;
                        $posI += 60;
                    }
                    if ($pieza['id'] == 0) {
                        $pieza['faltante'] = $key;
                    }
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

    public function nuevoOdontograma($odontogramaInicial, $idTratamiento) {
        try {
            $sql = "INSERT INTO tbl_odontograma (id_tratamiento,fecha) values($idTratamiento," . date("Y/m/d") . ")";
            $statement = $this->db->prepare($sql);
            $statement->execute();
            foreach ($odontogramaInicial as $a) {
                $id_pieza = $a['id_pieza'];
                $id_cara = $a['id_cara'];
                $id_estado = $a['id_estado'];
                $sql = "INSERT INTO tbl_odontograma_estado(id_odontograma,id_pieza,id_cara,id_estado,fecha_ins,usr_ins,fecha_upd,usr_upd) values
                ((select max(id) from tbl_odontograma),$id_pieza,$id_cara,$id_estado,'" . date("Y/m/d H:i:s") . "',1,'" . date("Y/m/d H:i:s") . "',1)";
                $statement = $this->db->prepare($sql);
                $statement->execute();
            }
            return true;
        } catch (PDOException $exc) {
            throw new Exception($exc->getMessage());
        }
    }

    public function verifODontInicial($idTratamiento) {
        try {
            $sql = "select min(id) from tbl_odontograma where id_tratamiento =" . $idTratamiento;
            $statement = $this->db->prepare($sql);
            $statement->execute();
            $b = false;
            if (!empty($statement)) {
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
            $sql = "SELECT * FROM tbl_paciente_piezas where id_odontograma = " . $id_odontograma . ")";
            $statement = $this->db->prepare($sql);
            $statement->execute();
            return $statement->fetch(PDO::FETCH_NUM);
        } catch (Exception $exc) {
            throw $exc->getMessage();
        }
    }

    public function guardar_odontograma($piezas) {
        $sql = "INSERT INTO tbl_odontograma values()";
        $this->db->query($sql);
        $sql_piezas = "INSERT INTO tbl_paciente_piezas values(";

        $id_odontograma = $this->db->lastInsertId("tbl_odontograma");
        $pieza_sql = "INSERT INTO tbl_odontograma_estado (id_odontograma,id_pieza,id_cara,id_estado,fecha_ins) 
            values(:id,:pieza,:cara,:estado,:fecha)";
        $statement = $this->db->prepare($pieza_sql);
        $statement->bindValue(':id', $id_odontograma);
        foreach ($piezas as $pieza) {
            $sql_piezas.=$pieza['id'] . ",";
            $statement->bindValue(':pieza', $pieza['id']);
            echo "Pieza id: " . $pieza['id'] . "**";
            if (isset($pieza['caras'])) {
                foreach ($pieza['caras'] as $cara) {
                    echo " Cara : " . $cara['id'] . " **";
                    $statement->bindValue(':cara', $cara['id']);
                    if (isset($cara['estados'])) {
                        foreach ($cara['estados'][0] as $estado) {
                            echo "Estado : " . $estado . " **";
                            $statement->bindValue(':estado', $estado);
                            $statement->bindValue(':fecha', date('Y/m/d H:i:s'));
                            $statement->execute();
                        }
                    }
                }
            }
        }
        $sql_piezas.=")";
        str_replace(",)", ")", $sql_piezas);
        echo $sql_piezas;
    }

    public function obtener_odontograma($id) {
        $sql = "SELECT * FROM tbl_odontograma_estado where id_odontograma = " . $id;
        $result = $this->db->query($sql);
        return $result->fetchAll();
    }

    public function getPiezasAdultos() {
        $piezas = array();
        $piezas = $this->auxGetPiezasIzquierda(1, 8, $piezas, 15, 0, null);
        $piezas = $this->auxGetPiezasDerecha(2, 8, $piezas, 495, 0, null);
        $piezas = $this->auxGetPiezasIzquierda(4, 8, $piezas, 15, 270, null);
        $piezas = $this->auxGetPiezasDerecha(3, 8, $piezas, 495, 270, null);
        return $piezas;
    }

    public function getPiezasInfantiles() {
        $piezas = array();
        $piezas = $this->auxGetPiezasIzquierda(0, 3, $piezas, 15, 0, 18);
        $piezas = $this->auxGetPiezasIzquierda(5, 5, $piezas, 195, 0, null);
        $piezas = $this->auxGetPiezasDerecha(6, 5, $piezas, 495, 0, null);
        $piezas = $this->auxGetPiezasDerecha(0, 3, $piezas, 795, 0, 26);
        $piezas = $this->auxGetPiezasIzquierda(0, 3, $piezas, 15, 270, 48);
        $piezas = $this->auxGetPiezasIzquierda(8, 5, $piezas, 195, 270, null);
        $piezas = $this->auxGetPiezasDerecha(7, 5, $piezas, 495, 270, null);
        $piezas = $this->auxGetPiezasDerecha(0, 3, $piezas, 795, 270, 36);
        return $piezas;
    }

    public function auxGetPiezasIzquierda($num, $limit, $colPiezas, $posX, $posY, $faltante) {
        for ($i = $limit; $i >= 1; $i--) {
            $pieza = array();
            if ($num == 0) {
                $pieza['id'] = $num;
                $pieza['faltante'] = $faltante;
                $faltante -=1;
            } else {
                $pieza['id'] = $num . $i;
                $pieza['caras'] = array();
            }
            $pieza['posX'] = $posX;
            $pieza['posY'] = $posY;
            $posX += 60;
            array_push($colPiezas, $pieza);
        }
        return $colPiezas;
    }

    public function auxGetPiezasDerecha($num, $limit, $colPiezas, $posX, $posY, $faltante) {
        for ($i = 1; $i <= $limit; $i++) {
            $pieza = array();
            if ($num == 0) {
                $pieza['id'] = $num;
                $pieza['faltante'] = $faltante;
                $faltante +=1;
            } else {
                $pieza['id'] = $num . $i;
                $pieza['caras'] = array();
            }
            $pieza['caras'] = array();
            $pieza['posX'] = $posX;
            $pieza['posY'] = $posY;
            $posX += 60;
            array_push($colPiezas, $pieza);
        }
        return $colPiezas;
    }

}

?>
