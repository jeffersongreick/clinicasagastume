<?php

class Model_ServicioOdontograma extends Model {

    private static $instance = null;

    public static function getInstance() {
        if (!isset(self::$instance)) {
            $c = __CLASS__;
            self::$instance = new $c;
        }
        return self::$instance;
    }

    protected function __construct() {
        parent::__construct();
    }

    private function getOdontogramaId($idTratamiento, $tipo) {
        try {
            $sql = "select max(id) as id from tbl_odontogramas WHERE id_tratamiento = ? and id_tipo = ?";
            $statement = $this->db->prepare($sql);
            $statement->execute(array($idTratamiento, $tipo));
            $id = $statement->fetch();
            return $id['id'];
        } catch (Exception $exc) {
            throw $exc->getMessage();
        }
    }

    public function verifOdontograma($idTratamiento, $tipo) {
        try {
            $sql = "select id from tbl_odontogramas WHERE id_tratamiento =" . $idTratamiento . " and id_tipo = " . $tipo;
            $statement = $this->db->prepare($sql);
            $statement->execute();
            return $statement->rowCount() > 0;
        } catch (Exception $exc) {
            throw $exc->getMessage();
        }
    }

    public function crearOdontograma($elementos, $piezas, $tipo, $idOdontograma) {
        try {
            $odontograma = array();
            $colPiezas = array();
            $cara = NULL;
            $row = NULL;
            if (!empty($elementos)) {
                $row = $elementos->fetch();
            }
            $odontograma['id'] = $idOdontograma;
            while ($pieza = $piezas->fetch(PDO::FETCH_NAMED)) {
                $pieza['caras'] = array();
                if (isset($row)) {
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

    public function getOdontogramaEstadosInicial($idTratamiento) {
        try {
            $idOdontograma = $this->getOdontogramaId($idTratamiento, 1);
            $estados = Model_ServicioEstado::getInstance()->getEstados($idOdontograma);
            $piezas = Model_ServicioPieza::getInstance()->getPiezasPacienteFecha($idTratamiento, 1);
            $odontograma = $this->crearOdontograma($estados, $piezas, "estado", $idOdontograma);
            return $odontograma;
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
    }

    public function getOdontogramaEstadosActual($idTratamiento) {
        try {
            $idOdontograma = $this->getOdontogramaId($idTratamiento, 2);
            $estados = Model_ServicioEstado::getInstance()->getEstados($idOdontograma);
            $piezas = Model_ServicioPieza::getInstance()->getPiezasPaciente($idTratamiento);
            $odontograma = $this->crearOdontograma($estados, $piezas, "estado", $idOdontograma);
            return $odontograma;
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
    }

    public function getOdontogramaPlanTratamientoPropuesto($idTratamiento) {
        try {
            $idOdontograma = $this->getOdontogramaId($idTratamiento, 3);
            $prestaciones = Model_ServicioPrestacion::getInstance()->getPrestaciones($idOdontograma);
            $piezas = Model_ServicioPieza::getInstance()->getPiezasPacienteFecha($idTratamiento, 3);
            $odontograma = $this->crearOdontograma($prestaciones, $piezas, "prestacion", $idOdontograma);
            return $odontograma;
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
    }

    public function getOdontogramaPlanTratamientoCompromiso($idTratamiento) {
        try {
            $idOdontograma = $this->getOdontogramaId($idTratamiento, 4);
            $prestaciones = Model_ServicioPrestacion::getInstance()->getPrestaciones($idOdontograma);
            $piezas = Model_ServicioPieza::getInstance()->getPiezasPacienteFecha($idTratamiento, 4);
            $odontograma = $this->crearOdontograma($prestaciones, $piezas, "prestacion", $idOdontograma);
            return $odontograma;
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
    }

    public function getOdontogramaTratamientosCurso($idTratamiento) {
        try {
            $idOdontograma = $this->getOdontogramaId($idTratamiento, 5);
            $prestaciones = Model_ServicioPrestacion::getInstance()->getPrestaciones($id_odontograma);
            $piezas = Model_ServicioPieza::getInstance()->getPiezasPaciente($idTratamiento);
            $odontograma = $this->crearOdontograma($prestaciones, $piezas, "prestacion", $idOdontograma);
            return $odontograma;
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
    }

    public function getOdontogramaTratamientosRealizado($idTratamiento) {
        try {
            $idOdontograma = $this->getOdontogramaId($idTratamiento, 6);
            $prestaciones = Model_ServicioPrestacion::getInstance()->getPrestaciones($idOdontograma);
            $piezas = Model_ServicioPieza::getInstance()->getPiezasPacienteFecha($idTratamiento, 6);
            $odontograma = $this->crearOdontograma($prestaciones, $piezas, "prestacion", $idOdontograma);
            return $odontograma;
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
    }

    public function visualizarOdontogramaTratamientosCurso($idTratamiento) {
        try {
            $idOdontograma = $this->getOdontogramaId($idTratamiento, 5);
            $prestaciones = Model_ServicioPrestacion::getInstance()->getPrestaciones($idOdontograma);
            $piezas = Model_ServicioPieza::getInstance()->getPiezasPacienteFecha($idTratamiento, 5);
            $odontograma = $this->crearOdontograma($prestaciones, $piezas, "prestacion", $idOdontograma);
            return $odontograma;
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
    }

    public function getEstructuraBucal($idTratamiento) {
        try {
            $piezas = Model_ServicioPieza::getInstance()->getPiezasPaciente($idTratamiento);
            $odontograma = $this->crearOdontograma($a = array(), $piezas, "", 0);
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
            $sql_estados1 = "INSERT INTO tbl_odontograma_estados (id_odontograma,id_pieza,id_cara,id_estado,usr_ins,activo) values";
            $sql_estados2 = "INSERT INTO tbl_odontograma_estados (id_odontograma,id_pieza,id_cara,id_estado,usr_ins,activo) values";
            $sql_pieza = "INSERT INTO tbl_paciente_piezas values";
            foreach ($piezas as $pieza) {
                $sql_pieza .= "(" . $idTratamiento . "," . $pieza['pos'] . "," . $pieza['id'] . ",'" . $fecha . "','" . $fecha . "'),";
                if (isset($pieza['caras'])) {
                    foreach ($pieza['caras'] as $cara) {
                        if (isset($cara['factores'])) {
                            foreach ($cara['factores'][0] as $estado) {
                                if ($estado['activo'] == 1) {
                                    $sql_estados1 .="(" . $id_odontograma1 . "," . $pieza['id'] . "," . $cara['id'] . "," . $estado['id'] . ",9," . $estado['activo'] . "),";
                                    $sql_estados2 .="(" . $id_odontograma2 . "," . $pieza['id'] . "," . $cara['id'] . "," . $estado['id'] . ",9," . $estado['activo'] . "),";
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
            $sql_estados = "INSERT INTO tbl_odontograma_prestaciones (id_odontograma,id_pieza,id_cara,id_prestacion,usr_ins,activo) values(?,?,?,?,9,?)";
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
            $upd_piezas = "UPDATE tbl_paciente_piezas set fecha_upd = '" . $fecha . "'  WHERE id_tratamiento = " . $idTratamiento;
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
        echo $idOdontograma . "__";
        try {
            $this->db->beginTransaction();
            $fecha = date("Y/m/d H:i:s");
            foreach ($piezas as $pieza) {
                $sel = "SELECT * FROM  tbl_paciente_piezas WHERE id_tratamiento = " . $idTratamiento . " and posicion = " . $pieza['pos'];
                $statement = $this->db->prepare($sel);
                $statement->execute();
                $p = $statement->fetch();
                if ($p['id_pieza'] != $pieza['id']) {

                    $sql_his = "INSERT INTO tbl_historico_piezas " . $sel;
                    $stat = $this->db->prepare($sql_his);
                    $stat->execute();
                    $sql_piezas = "UPDATE tbl_paciente_piezas SET id_pieza = " . $pieza['id'] . ",fecha_ins = '" . $fecha . "' ,
                        fecha_upd = '" . $fecha . "' WHERE id_tratamiento = " . $idTratamiento . " and posicion = " . $pieza['pos'];
                    $stat = $this->db->prepare($sql_piezas);
                    $stat->execute();
                    $sql_estados_upd = "UPDATE tbl_odontograma_estados set activo = 0 where id_odontograma = " . $idOdontograma .
                            " and id_pieza = " . $p['id_pieza'];
                    echo $sql_estados_upd;
                    $stat = $this->db->prepare($sql_estados_upd);
                    $stat->execute();

                    $sql_prestaciones_upd = "UPDATE tbl_odontograma_prestaciones set activo = 0 where id_odontograma = " . $idOdontograma .
                            " and id_pieza = " . $p['id_pieza'];
                    $stat = $this->db->prepare($sql_prestaciones_upd);
                    $stat->execute();
                    echo "hola4";
                }
                if (isset($pieza['caras'])) {
                    foreach ($pieza['caras'] as $cara) {
                        if (isset($cara['factores'])) {
                            foreach ($cara['factores'][0] as $estado) {

                                $sel = "SELECT id FROM  tbl_odontograma_estados WHERE id_odontograma = " . $idOdontograma .
                                        " and id_pieza = ? and id_cara = ? and id_estado = ? and activo = 1 ";
                                $statement = $this->db->prepare($sel);
                                $statement->execute(array($pieza['id'], $cara['id'], $estado['id']));
                                if ($estado['activo'] == 0 && $statement->rowCount() > 0) {
                                    $ins = "UPDATE tbl_odontograma_estados SET activo = 0 WHERE id_odontograma = " . $idOdontograma .
                                            " and id_pieza = ? and id_cara = ? and id_estado = ? and activo = 1 ";
                                    $stat = $this->db->prepare($ins);
                                    $stat->execute(array($pieza['id'], $cara['id'], $estado['id']));
                                } else if ($estado['activo'] == 1 && $statement->rowCount() == 0) {
                                    $ins = "INSERT INTO tbl_odontograma_estados (id_odontograma,id_pieza,id_cara,id_estado,usr_ins, activo) values (" . $idOdontograma . " , ? , ? , ? ,9, ?)";
                                    $stat = $this->db->prepare($ins);
                                    $stat->execute(array($pieza['id'], $cara['id'], $estado['id'], $estado['activo']));
                                }
                            }
                        }
                    }
                }
            }

            $upd_odont = "UPDATE tbl_odontogramas set fecha = '" . $fecha . "'  WHERE id = " . $idOdontograma;
            $stat = $this->db->prepare($upd_odont);
            $stat->execute();
            $upd_piezas = "UPDATE tbl_paciente_piezas set fecha_upd = '" . $fecha . "'  WHERE id_tratamiento = " . $idTratamiento;
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

    public function actualizarOdontogramaPrestaciones($piezas, $idOdontograma, $idTratamiento) {
        try {
            $this->db->beginTransaction();
            foreach ($piezas as $pieza) {
                if (isset($pieza['caras'])) {
                    foreach ($pieza['caras'] as $cara) {
                        if (isset($cara['factores'])) {
                            foreach ($cara['factores'][0] as $prestacion) {
                                $sel = "SELECT id FROM  tbl_odontograma_prestaciones WHERE id_odontograma = " . $idOdontograma .
                                        " and id_pieza = ? and id_cara = ? and id_prestacion = ? and activo = 1";
                                $statement = $this->db->prepare($sel);
                                $statement->execute(array($pieza['id'], $cara['id'], $prestacion['id']));
                                if ($prestacion['activo'] == 0 && $statement->rowCount() > 0) {
                                    $ins = "UPDATE tbl_odontograma_prestaciones SET activo = 0 WHERE id_odontograma = " . $idOdontograma .
                                            " and id_pieza = ? and id_cara = ? and id_prestacion = ? and activo = 1 ";
                                    $stat = $this->db->prepare($ins);
                                    $stat->execute(array($pieza['id'], $cara['id'], $prestacion['id'], $prestacion['activo']));
                                } else if ($prestacion['activo'] == 1 && $statement->rowCount() == 0) {
                                    $ins = "INSERT INTO tbl_odontograma_prestaciones 
                                        (id_odontograma,id_pieza,id_cara,id_prestacion,usr_ins, activo) values 
                                        (" . $idOdontograma . " , ? , ? , ? ,9, ?)";
                                    $stat = $this->db->prepare($ins);
                                    $stat->execute(array($pieza['id'], $cara['id'], $prestacion['id'], $prestacion['activo']));
                                }
                            }
                        }
                    }
                }
            }
            $upd_piezas = "UPDATE tbl_paciente_piezas set fecha_upd = '" . date("Y/m/d H:i:s") . "'  WHERE id_tratamiento = " . $idTratamiento;
            $stat = $this->db->prepare($upd_piezas);
            $stat->execute();
            $this->db->commit();
            return true;
        } catch (PDOException $exc) {
            $this->db->rollBack();
            throw new Exception($exc->getMessage());
        }
    }

    public function cargarEstandar($idTratamiento, $tipo) {
        $idOdontograma = $this->getOdontogramaId($idTratamiento, $tipo);
        switch ($tipo) {
            case 1:
            case 2:
                $o = Model_ServicioEstado::getInstance()->getEstados($idOdontograma);
                break;
            case 3:
            case 4:
            case 5:
            case 6:
                $o = Model_ServicioPrestacion::getInstance()->getPrestaciones($idOdontograma);
                break;
        }
        $odontograma = $o->fetchAll(PDO::FETCH_NAMED);
        return $odontograma;
    }

}

?>