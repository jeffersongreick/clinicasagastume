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

    public function crearOdontograma($rows) {
        try {
            $odontograma = array();
            $colPiezas = array();

            $row = $rows->fetch();

            $p = Model_ServicioPieza::getInstance()->getPiezasPaciente($row['id_odontograma']);
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
            $sql = "select count(id) from tbl_odontogramas where id_tratamiento =" . $idTratamiento . " and id_tipo = 1";
            $statement = $this->db->prepare($sql);
            $statement->execute();
            $p = $statement->fetch();
            $b = false;
            if ($p[0] > 0) {
                $b = true;
            }
            return $b;
        } catch (Exception $exc) {
            throw $exc->getMessage();
        }
    }

    public function getOdontograma($idTratamiento, $tipo) {
        try {
            $sql = "SELECT o.id_odontograma, o.id_pieza,o.id_cara,o.id_estado,
        c.descripcion as desc_cara,e.estado as desc_estado,e.url_img as url_estado FROM 
        tbl_odontograma_estados as o inner join tbl_piezas as p inner join
        tbl_caras as c inner join tbl_estados as e on o.id_pieza = p.id and o.id_cara = c.id and o.id_estado = e.id
        where id_odontograma = (select id from tbl_odontogramas where id_tratamiento = " . $idTratamiento . " and id_tipo = " . $tipo . ")
        order by o.id_odontograma, o.id_pieza,o.id_cara,o.id_estado";
            $statement = $this->db->prepare($sql);
            $statement->execute();
            $odontograma = $this->crearOdontograma($statement);
            return $odontograma;
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
    }

    public function guardarOdontograma($piezas, $tipo) {
        try {
            $this->db->beginTransaction();
            $sql_odontograma = "INSERT INTO tbl_odontogramas (id_tratamiento,id_tipo) values(1," . $tipo . ")";
            $this->db->exec($sql_odontograma);
            $id_odontograma = $this->db->lastInsertId("tbl_odontogramas");
            $sql_piezas = "INSERT INTO tbl_paciente_piezas values(" . $id_odontograma . ",";
            $sql_estados = "INSERT INTO tbl_odontograma_estados (id_odontograma,id_pieza,id_cara,id_estado,fecha_ins,activo) 
            values(:id,:pieza,:cara,:estado,:fecha,:activo)";
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
                                $statement->bindValue(':estado', $estado['id']);
                                $statement->bindValue(':fecha', date('Y/m/d H:i:s'));
                                $statement->bindValue(':activo', $estado['activo']);
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

    public function actualizarOdontograma($piezas, $idOdontograma) {
        try {
            $sel = "SELECT * FROM  tbl_odontograma_estados where id_odontograma = " . $idOdontograma . " and id_pieza = ? and id_cara = ? and id_estado = ? and activo = ?";
            $statement = $this->db->prepare($sel);
//            $sql_piezas = "UPDATE tbl_paciente_piezas values(NULL," . $id_odontograma . ",CURRENT_TIMESTAMP,";
            foreach ($piezas as $pieza) {
                if (isset($pieza['caras'])) {
                    foreach ($pieza['caras'] as $cara) {
                        if (isset($cara['estados'])) {
                            foreach ($cara['estados'][0] as $estado) {
                                if ($estado['accion'] = 0) {
                                    
                                    $statement->execute(array($pieza['id'], $cara['id'], $estado['id'], 1));
                                    if (($statement->rowCount() % 2) != 0) {
                                        $ins = "INSERT INTO tbl_odontograma_estados (id_odontograma,id_pieza,id_cara,id_estado,usr_ins, activo) values (" . $idOdontograma . " , ? , ? , ? ,1, ?)";
                                        $statement = $this->db->prepare($ins);
                                        $statement->execute(array($pieza['id'], $cara['id'], $estado['id'], $estado['activo']));
                                    }
                                } else {
                                    $statement->execute(array($pieza['id'], $cara['id'], $estado['id'], $estado['activo']));
                                    if ($statement->rowCount() == 0) {
                                        $ins = "INSERT INTO tbl_odontograma_estados (id_odontograma,id_pieza,id_cara,id_estado,usr_ins, activo) values (" . $idOdontograma . " , ? , ? , ? ,1, ?)";
                                        $statement = $this->db->prepare($ins);
                                        $statement->execute(array($pieza['id'], $cara['id'], $estado['id'], $estado['activo']));
                                    }
                                }
                            }
                        }
                    }
                }
            }

//            $sql_piezas = "INSERT INTO tbl_paciente_piezas (id_odontograma,id_pieza,id_cara,id_estado,fecha_ins,id_accion)values(" . $id_odontograma . ",";
//            $sql_estados = "INSERT INTO tbl_odontograma_estados (id_odontograma,id_pieza,id_cara,id_estado,fecha_ins,id_accion) 
//            values(:id,:pieza,:cara,:estado,:fecha,:accion)";
//            $statement = $this->db->prepare($sql_estados);
//            $statement->bindValue(':id', $id_odontograma);
//           
//            $sql_piezas = substr_replace($sql_piezas, ')', (strlen($sql_piezas) - 1));
//            $this->db->exec($sql_piezas);
//            $this->db->commit();
            return true;
        } catch (PDOException $exc) {
//            $this->db->rollBack();
            throw new Exception($exc->getMessage());
        }
    }

    public function cargarEstandar($id) {
        $sql = "Select id_pieza,id_cara,id_estado,estado 
            From tbl_odontograma_estados inner join tbl_estados on id_estado = id where id =" . $id . " order by id_pieza,id_cara";
        $result = $this->db->query($sql);
        return $result->fetchAll();
    }

}

?>
