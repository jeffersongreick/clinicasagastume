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
            $p = $this->getPiezasPaciente($id_paciente);
            $row = $rows->fetch();
            $cara;
            while ($pieza = $p->fetch()) {
                $pieza['caras'] = array();
                if ($pieza['id_pieza'] <= 28) {
                    $pieza['posX'] = $posS;
                    $pieza['posY'] = 0;
                    $posS += 60;
                } else {
                    $pieza['posX'] = $posI;
                    $pieza['posY'] = 270;
                    $posI += 60;
                }

                if ($pieza['id_pieza'] == 0) {
                    $pieza['faltante'] = $pieza['num'];
                }
                if (isset($row)) {
                    if (!isset($odontograma['id'])) {
                        $odontograma['id'] = $row['id_odontograma'];
                    }
                    while ($row['id_pieza'] == $pieza['id_pieza']) {
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
                        if ($row['id_pieza'] != $pieza['id_pieza']) {
                            array_push($pieza['caras'], $cara);
                        }
                    }
                }
                array_push($colPiezas, $pieza);
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
            $sql = "select id from tbl_odontograma where id_tratamiento =" . $idTratamiento;
            $statement = $this->db->prepare($sql);
            $statement->execute();
            $r = $statement->fetchAll();
            return !empty($r);
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

    public function getPiezasPaciente($id_paciente) {
        try {
            $sql = "SELECT num,id_pieza,nombre FROM tbl_paciente_piezas inner join tbl_piezas on tbl_paciente_piezas.id_pieza = tbl_piezas.id where id_paciente = " . $id_paciente;
            $statement = $this->db->prepare($sql);
            $statement->execute();
            return $statement;
        } catch (Exception $exc) {
            throw $exc->getMessage();
        }
    }

}

?>
