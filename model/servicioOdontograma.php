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
                        $item['descripcion'] = $row['desc_' . $tipo];
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
            $piezas = Model_ServicioPieza::getInstance()->getPiezasPaciente($idTratamiento, $tipo);
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
            $piezas = Model_ServicioPieza::getInstance()->getPiezasPaciente($idTratamiento, 2);
            $odontograma = $this->crearOdontograma($statement, $piezas, "prestacion");
            return $odontograma;
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
    }

    public function getEstructuraBucal($idTratamiento) {
        try {
            $piezas = Model_ServicioPieza::getInstance()->getPiezasPaciente($idTratamiento, 2);
            $odontograma = $this->crearOdontograma($a = array(), $piezas, "");
            return $odontograma;
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
    }

    public function guardarOdontogramaEstados($piezas, $tipo, $idTratamiento) {
        try {
            $this->db->beginTransaction();
            $sql_odontograma = "INSERT INTO tbl_odontogramas (id_tratamiento,id_tipo) values(" . $idTratamiento . "," . $tipo . ")";
            $this->db->exec($sql_odontograma);
            $id_odontograma = $this->db->lastInsertId("tbl_odontogramas");
            $sql_estados = "INSERT INTO tbl_odontograma_estados (id_odontograma,id_pieza,id_cara,id_estado,activo) values(?,?,?,?,?)";
            $statement = $this->db->prepare($sql_estados);
            foreach ($piezas as $pieza) {
                $sql_pieza = "INSERT INTO tbl_paciente_pieza values(" . $id_odontograma . "," . $pieza['pos'] . "," . $pieza['id'] . ")";
                $this->db->exec($sql_pieza);
                if (isset($pieza['caras'])) {
                    foreach ($pieza['caras'] as $cara) {
                        if (isset($cara['factores'])) {
                            foreach ($cara['factores'][0] as $estado) {
                                $statement->execute(array($id_odontograma, $pieza['id'], $cara['id'], $estado['id'], $estado['activo']));
                            }
                        }
                    }
                }
            }
            $this->db->commit();
            return true;
        } catch (PDOException $exc) {
            $this->db->rollBack();
            throw new Exception($exc->getMessage());
        }
    }

    public function guardarTratamientos($piezas, $tipo, $idTratamiento) {
        try {
            $this->db->beginTransaction();
            $sql_odontograma = "INSERT INTO tbl_odontogramas (id_tratamiento,id_tipo) values(" . $idTratamiento . "," . $tipo . ")";
            $this->db->exec($sql_odontograma);
            $id_odontograma = $this->db->lastInsertId("tbl_odontogramas");
            $sql_estados = "INSERT INTO tbl_odontograma_prestaciones (id_odontograma,id_pieza,id_cara,id_prestacion,activo) values(?,?,?,?,?)";
            $statement = $this->db->prepare($sql_estados);
            foreach ($piezas as $pieza) {
                if (isset($pieza['caras'])) {
                    foreach ($pieza['caras'] as $cara) {
                        if (isset($cara['factores'])) {
                            foreach ($cara['factores'][0] as $prestacion) {
                                $statement->execute(array($id_odontograma, $pieza['id'], $cara['id'], $prestacion['id'], $prestacion['activo']));
                            }
                        }
                    }
                }
            }
            $this->db->commit();
            return true;
        } catch (PDOException $exc) {
            $this->db->rollBack();
            throw new Exception($exc->getMessage());
        }
    }

    public function actualizarOdontogramaEstados($piezas, $idOdontograma) {
        try {
            $this->db->beginTransaction();
            foreach ($piezas as $pieza) {
                $sql_piezas = "UPDATE tbl_paciente_pieza SET id_pieza = " . $pieza['id'] . " where id_odontograma = " . $idOdontograma . " and posicion = " . $pieza['pos'];
                $stat = $this->db->prepare($sql_piezas);
                $stat->execute();
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
            $this->db->commit();
            return true;
        } catch (PDOException $exc) {
            $this->db->rollBack();
            throw new Exception($exc->getMessage());
        }
    }

    public function actualizarOdontogramaPrestaciones($piezas, $idOdontograma) {
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
