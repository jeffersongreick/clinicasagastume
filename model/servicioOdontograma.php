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

    public function verifOdontograma($idTratamiento, $tipo) {
        try {
            $sql = "select id from tbl_odontogramas where id_tratamiento =" . $idTratamiento . " and id_tipo = " . $tipo;
            $statement = $this->db->prepare($sql);
            $statement->execute();
            return $statement->rowCount() > 0;
        } catch (Exception $exc) {
            throw $exc->getMessage();
        }
    }

    public function crearOdontograma($elementos, $piezas, $tipo) {
        try {
            $odontograma = array();
            $colPiezas = array();
            $cara = NULL;
            $row = NULL;
            if (!empty($elementos)) {
                $row = $elementos->fetch();
            }
            while ($pieza = $piezas->fetch(PDO::FETCH_NAMED)) {
                $pieza['caras'] = array();
                if (isset($row)) {
                    if (!isset($odontograma['id'])) {
                        $odontograma['id'] = $row['id_odontograma'];
                    }
                    while ($row['id_pieza'] == $pieza['id']) {
                        if (!isset($cara)) {
                            $cara = array();
                            $cara['id'] = $row['id_cara'];
                            $cara['desc'] = $row['desc_cara'];
                            $cara['factores'] = array();
                        } else if ($row['id_cara'] != $cara['id']) {
                            array_push($pieza['caras'], $cara);
                            $cara = array();
                            $cara['id'] = $row['id_cara'];
                            $cara['desc'] = $row['desc_cara'];
                            $cara['factores'] = array();
                        }
                        $item = Array();
                        $item['id'] = $row['id_' . $tipo];
                        $item['descripcion'] = utf8_encode($row['desc_' . $tipo]);
//                        $item['url_img'] = $row['url_estado'];
                        $item['activo'] = $row['activo'];
                        array_push($cara['factores'], $item);
                        $row = $elementos->fetch();
                        if ($row['id_pieza'] != $pieza['id']) {
                            array_push($pieza['caras'], $cara);
                            $cara = null;
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

    public function getOdontogramaEstados($idTratamiento, $tipo) {
        try {
            $sql = "SELECT COUNT(o.id_odontograma) as cantidad ,o.id_odontograma,o.activo, o.id_pieza,o.id_cara,o.id_estado,
        c.descripcion as desc_cara,e.descripcion as desc_estado,e.url_img as url_estado FROM 
        tbl_odontograma_estados as o inner join tbl_piezas as p inner join
        tbl_caras as c inner join tbl_estados as e on o.id_pieza = p.id and o.id_cara = c.id and o.id_estado = e.id
        where id_odontograma = (select id from tbl_odontogramas where id_tratamiento = ? and id_tipo = ?)
        GROUP BY o.id_odontograma, o.id_pieza,o.id_cara,o.id_estado having cantidad % 2 != 0 order by o.id_odontograma, o.id_pieza,o.id_cara,o.id_estado";
            $statement = $this->db->prepare($sql);
            $statement->execute(array($idTratamiento, $tipo));
            if ($tipo == 1) {
                $piezas = Model_ServicioPieza::getInstance()->getPiezasPacienteFecha($idTratamiento, $tipo);
            } else {
                $piezas = Model_ServicioPieza::getInstance()->getPiezasPaciente($idTratamiento);
            }
            $odontograma = $this->crearOdontograma($statement, $piezas, "estado");
            return $odontograma;
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
    }

    public function getOdontogramaPrestaciones($idTratamiento, $tipo) {
        try {
            $sql = "SELECT COUNT(o.id_odontograma) as cantidad ,o.id_odontograma,o.activo, o.id_pieza,o.id_cara,o.id_prestacion,
        c.descripcion as desc_cara,e.descripcion as desc_prestacion FROM 
        tbl_odontograma_prestaciones as o inner join tbl_piezas as p inner join
        tbl_caras as c inner join tbl_prestaciones as e on o.id_pieza = p.id and o.id_cara = c.id and o.id_prestacion = e.id
        where id_odontograma = (select id from tbl_odontogramas where id_tratamiento = ? and id_tipo = ?)
        GROUP BY o.id_odontograma, o.id_pieza,o.id_cara,o.id_prestacion having cantidad % 2 != 0 order by o.id_odontograma, o.id_pieza,o.id_cara,o.id_prestacion";
            $statement = $this->db->prepare($sql);
            $statement->execute(array($idTratamiento, $tipo));
            $piezas = Model_ServicioPieza::getInstance()->getPiezasPaciente($idTratamiento);
            $odontograma = $this->crearOdontograma($statement, $piezas, "prestacion");
            return $odontograma;
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
    }

    public function visualizarOdontogramaPrestaciones($idTratamiento, $tipo) {
        try {
            $sql = "SELECT COUNT(o.id_odontograma) as cantidad ,o.id_odontograma,o.activo, o.id_pieza,o.id_cara,o.id_prestacion,
        c.descripcion as desc_cara,e.descripcion as desc_prestacion FROM 
        tbl_odontograma_prestaciones as o inner join tbl_piezas as p inner join
        tbl_caras as c inner join tbl_prestaciones as e on o.id_pieza = p.id and o.id_cara = c.id and o.id_prestacion = e.id
        where id_odontograma = (select id from tbl_odontogramas where id_tratamiento = ? and id_tipo = ?)
        GROUP BY o.id_odontograma, o.id_pieza,o.id_cara,o.id_prestacion having cantidad % 2 != 0 order by o.id_odontograma, o.id_pieza,o.id_cara,o.id_prestacion";
            $statement = $this->db->prepare($sql);
            $statement->execute(array($idTratamiento, $tipo));
            $piezas = Model_ServicioPieza::getInstance()->getPiezasPacienteFecha($idTratamiento, $tipo);
            $odontograma = $this->crearOdontograma($statement, $piezas, "prestacion");
            return $odontograma;
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
    }

    public function getTratamientoRealizado($idTratamiento) {
        try {
            $sql = "SELECT o.id_odontograma,o.activo, o.id_pieza,o.id_cara,o.id_prestacion,
        c.descripcion as desc_cara,e.descripcion as desc_prestacion FROM 
        tbl_odontograma_prestaciones as o inner join tbl_piezas as p inner join
        tbl_caras as c inner join tbl_prestaciones as e on o.id_pieza = p.id and o.id_cara = c.id and o.id_prestacion = e.id
        where id_odontograma = (select max(id) from tbl_odontogramas where id_tratamiento = ? and id_tipo = 6)
        GROUP BY o.id_odontograma, o.id_pieza,o.id_cara,o.id_prestacion order by o.id_odontograma, o.id_pieza,o.id_cara,o.id_prestacion";
            $statement = $this->db->prepare($sql);
            $statement->execute(array($idTratamiento));
            $piezas = Model_ServicioPieza::getInstance()->getPiezasPacienteFecha($idTratamiento, $tipo);
            $odontograma = $this->crearOdontograma($statement, $piezas, "prestacion");
            return $odontograma;
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
    }

    public function getEstructuraBucal($idTratamiento) {
        try {
            $piezas = Model_ServicioPieza::getInstance()->getPiezasPaciente($idTratamiento);
            $odontograma = $this->crearOdontograma($a = array(), $piezas, "");
            return $odontograma;
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
    }

    public function guardarOdontogramaEstados($piezas, $idTratamiento) {
        try {
            $fecha = date("Y/m/d H:i:s");
            $this->db->beginTransaction();
            $sql_odontograma1 = "INSERT INTO tbl_odontogramas (id_tratamiento,id_tipo,fecha) values(" . $idTratamiento . ",1,'" . $fecha . "')";
            $this->db->exec($sql_odontograma1);
            $id_odontograma1 = $this->db->lastInsertId("tbl_odontogramas");
            $sql_odontograma2 = "INSERT INTO tbl_odontogramas (id_tratamiento,id_tipo,fecha) values(" . $idTratamiento . ",2,'" . $fecha . "')";
            $this->db->exec($sql_odontograma2);
            $id_odontograma2 = $this->db->lastInsertId("tbl_odontogramas");
            $sql_estados1 = "INSERT INTO tbl_odontograma_estados (id_odontograma,id_pieza,id_cara,id_estado,activo) values";
            $sql_estados2 = "INSERT INTO tbl_odontograma_estados (id_odontograma,id_pieza,id_cara,id_estado,activo) values";
            $sql_pieza = "INSERT INTO tbl_paciente_pieza values";

            foreach ($piezas as $pieza) {
                $sql_pieza .= "(" . $idTratamiento . "," . $pieza['pos'] . "," . $pieza['id'] . ",'" . $fecha . "','" . $fecha . "'),";
                if (isset($pieza['caras'])) {
                    foreach ($pieza['caras'] as $cara) {
                        if (isset($cara['factores'])) {
                            foreach ($cara['factores'][0] as $estado) {
                                if ($estado['activo'] == 1) {
                                    $sql_estados1 .="(" . $id_odontograma1 . "," . $pieza['id'] . "," . $cara['id'] . "," . $estado['id'] . "," . $estado['activo'] . "),";
                                    $sql_estados2 .="(" . $id_odontograma2 . "," . $pieza['id'] . "," . $cara['id'] . "," . $estado['id'] . "," . $estado['activo'] . "),";
                                }
                            }
                        }
                    }
                }
            }
            $this->db->exec(substr($sql_estados1, 0, -1));
            $this->db->exec(substr($sql_estados2, 0, -1));
            $this->db->exec(substr($sql_pieza, 0, -1));
            $this->db->commit();
            return true;
        } catch (PDOException $exc) {
            $this->db->rollBack();
            throw new Exception($exc->getMessage());
        } catch (Exception $exc) {
            $this->db->rollBack();
            echo "Error: " . $exc->getMessage();
        }
    }

    public function guardarTratamientos($piezas, $tipo, $idTratamiento) {
        try {
            $this->db->beginTransaction();
            $fecha = date("Y/m/d H:i:s");
            $sql_odontograma = "INSERT INTO tbl_odontogramas (id_tratamiento,id_tipo,fecha) values(" . $idTratamiento . "," . $tipo . ",'" . $fecha . "')";
            $this->db->exec($sql_odontograma);
            $id_odontograma = $this->db->lastInsertId("tbl_odontogramas");
            $sql_estados = "INSERT INTO tbl_odontograma_prestaciones (id_odontograma,id_pieza,id_cara,id_prestacion,activo) values(?,?,?,?,?)";
            $statement = $this->db->prepare($sql_estados);
            foreach ($piezas as $pieza) {
                if (isset($pieza['caras'])) {
                    foreach ($pieza['caras'] as $cara) {
                        if (isset($cara['factores'])) {
                            foreach ($cara['factores'][0] as $prestacion) {
                                if ($prestacion['activo'] == 1) {
                                    $statement->execute(array($id_odontograma, $pieza['id'], $cara['id'], $prestacion['id'], $prestacion['activo']));
                                }
                            }
                        }
                    }
                }
            }
            $upd_piezas = "UPDATE tbl_paciente_pieza set fecha_upd = '" . $fecha . "'  where id_tratamiento = " . $idTratamiento;
            $stat = $this->db->prepare($upd_piezas);
            $stat->execute();
            $this->db->commit();
            return true;
        } catch (PDOException $exc) {
            $this->db->rollBack();
            throw new Exception($exc->getMessage());
        } catch (Exception $exc) {
            $this->db->rollBack();
            echo "Error: " . $exc->getMessage();
        }
    }

    public function actualizarOdontogramaEstados($piezas, $idOdontograma, $idTratamiento) {
        try {
            $this->db->beginTransaction();
            $fecha = date("Y/m/d H:i:s");
            foreach ($piezas as $pieza) {
                $sel = "SELECT * FROM  tbl_paciente_pieza where id_tratamiento = " . $idTratamiento . " and posicion = " . $pieza['pos'];
                $statement = $this->db->prepare($sel);
                $statement->execute();
                $p = $statement->fetch();
                if ($p['id_pieza'] != $pieza['id']) {
                    $sql_his = "INSERT INTO tbl_historico_piezas " . $sel;
                    $stat = $this->db->prepare($sql_his);
                    $stat->execute();
                    $sql_piezas = "UPDATE tbl_paciente_pieza SET id_pieza = " . $pieza['id'] . ",fecha_ins = '" . $fecha . "' ,
                        fecha_upd = '" . $fecha . "' where id_tratamiento = " . $idTratamiento . " and posicion = " . $pieza['pos'];
                    $stat = $this->db->prepare($sql_piezas);
                    $stat->execute();
                }
                if (isset($pieza['caras'])) {
                    foreach ($pieza['caras'] as $cara) {
                        if (isset($cara['factores'])) {
                            foreach ($cara['factores'][0] as $estado) {
                                $sel = "SELECT id FROM  tbl_odontograma_estados where id_odontograma = " . $idOdontograma . " and id_pieza = ? and id_cara = ? and id_estado = ? ";
                                $statement = $this->db->prepare($sel);
                                $statement->execute(array($pieza['id'], $cara['id'], $estado['id']));
                                if ($estado['activo'] == 0 && ($statement->rowCount() % 2) != 0) {
                                    $ins = "INSERT INTO tbl_odontograma_estados (id_odontograma,id_pieza,id_cara,id_estado,usr_ins, activo) values (" . $idOdontograma . " , ? , ? , ? ,1, ?)";
                                    $stat = $this->db->prepare($ins);
                                    $stat->execute(array($pieza['id'], $cara['id'], $estado['id'], $estado['activo']));
                                } else if ($estado['activo'] == 1 && ($statement->rowCount() % 2) == 0) {
                                    $ins = "INSERT INTO tbl_odontograma_estados (id_odontograma,id_pieza,id_cara,id_estado,usr_ins, activo) values (" . $idOdontograma . " , ? , ? , ? ,1, ?)";
                                    $stat = $this->db->prepare($ins);
                                    $stat->execute(array($pieza['id'], $cara['id'], $estado['id'], $estado['activo']));
                                }
                            }
                        }
                    }
                }
            }

            $upd_odont = "UPDATE tbl_odontogramas set fecha = '" . $fecha . "'  where id = " . $idOdontograma;
            $stat = $this->db->prepare($upd_odont);
            $stat->execute();
            $upd_piezas = "UPDATE tbl_paciente_pieza set fecha_upd = '" . $fecha . "'  where id_tratamiento = " . $idTratamiento;
            $stat = $this->db->prepare($upd_piezas);
            $stat->execute();
            $this->db->commit();
            return true;
        } catch (PDOException $exc) {
            $this->db->rollBack();
            throw new Exception($exc->getMessage());
        } catch (Exception $exc) {
            $this->db->rollBack();
            echo "Error: " . $exc->getMessage();
        }
    }

    public function actualizarOdontogramaPrestaciones($piezas, $idOdontograma,$idTratamiento) {
        try {
            $this->db->beginTransaction();
            foreach ($piezas as $pieza) {
                if (isset($pieza['caras'])) {
                    foreach ($pieza['caras'] as $cara) {
                        if (isset($cara['factores'])) {
                            foreach ($cara['factores'][0] as $prestacion) {
                                $sel = "SELECT id FROM  tbl_odontograma_prestaciones where id_odontograma = " . $idOdontograma . " and id_pieza = ? and id_cara = ? and id_prestacion = ? ";
                                $statement = $this->db->prepare($sel);
                                $statement->execute(array($pieza['id'], $cara['id'], $prestacion['id']));
                                if ($prestacion['activo'] == 0 && ($statement->rowCount() % 2) != 0) {
                                    $ins = "INSERT INTO tbl_odontograma_prestaciones (id_odontograma,id_pieza,id_cara,id_prestacion,usr_ins, activo) values (" . $idOdontograma . " , ? , ? , ? ,1, ?)";
                                    $stat = $this->db->prepare($ins);
                                    $stat->execute(array($pieza['id'], $cara['id'], $prestacion['id'], $prestacion['activo']));
                                } else if ($prestacion['activo'] == 1 && ($statement->rowCount() % 2) == 0) {
                                    $ins = "INSERT INTO tbl_odontograma_prestaciones (id_odontograma,id_pieza,id_cara,id_prestacion,usr_ins, activo) values (" . $idOdontograma . " , ? , ? , ? ,1, ?)";
                                    $stat = $this->db->prepare($ins);
                                    $stat->execute(array($pieza['id'], $cara['id'], $prestacion['id'], $prestacion['activo']));
                                }
                            }
                        }
                    }
                }
            }
            $upd_piezas = "UPDATE tbl_paciente_pieza set fecha_upd = '" . date("Y/m/d H:i:s") . "'  where id_tratamiento = " . $idTratamiento;
            $stat = $this->db->prepare($upd_piezas);
            $stat->execute();
            $this->db->commit();
            return true;
        } catch (PDOException $exc) {
            $this->db->rollBack();
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
