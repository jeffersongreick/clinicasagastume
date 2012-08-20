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

    public function crearOdontograma($estados, $piezas) {
        try {
            $odontograma = array();
            $colPiezas = array();
            $cara = NULL;
            $row = NULL;
            if (!empty($estados)) {
                $row = $estados->fetch();
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
                        $estado['activo'] = $row['activo'];
                        array_push($cara['estados'], $estado);
                        $row = $estados->fetch();

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

    public function getOdontogramaEstados($idTratamiento, $tipo) {
        try {
            $sql = "SELECT COUNT(o.id_odontograma) as cantidad ,o.id_odontograma,o.activo, o.id_pieza,o.id_cara,o.id_estado,
        c.descripcion as desc_cara,e.estado as desc_estado,e.url_img as url_estado FROM 
        tbl_odontograma_estados as o inner join tbl_piezas as p inner join
        tbl_caras as c inner join tbl_estados as e on o.id_pieza = p.id and o.id_cara = c.id and o.id_estado = e.id
        where id_odontograma = (select id from tbl_odontogramas where id_tratamiento = ? and id_tipo = ?)
        GROUP BY o.id_odontograma, o.id_pieza,o.id_cara,o.id_estado having cantidad % 2 != 0 order by o.id_odontograma, o.id_pieza,o.id_cara,o.id_estado";
            $statement = $this->db->prepare($sql);
            $statement->execute(array($idTratamiento, $tipo));
            $piezas = Model_ServicioPieza::getInstance()->getPiezasPaciente($idTratamiento, $tipo);
            $odontograma = $this->crearOdontograma($statement, $piezas);
            return $odontograma;
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
    }

    public function getEstructuraBucal($idTratamiento) {
        try {
            $piezas = Model_ServicioPieza::getInstance()->getPiezasPaciente($idTratamiento, 2);
            $odontograma = $this->crearOdontograma($a = array(), $piezas);
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
            $sql_estados = "INSERT INTO tbl_odontograma_estados (id_odontograma,id_pieza,id_cara,id_estado,activo) values(?,?,?,?,?)";
            $statement = $this->db->prepare($sql_estados);
            foreach ($piezas as $pieza) {
                $sql_pieza = "INSERT INTO tbl_paciente_pieza values(" . $id_odontograma . "," . $pieza['pos'] . "," . $pieza['id'] . ")";
                $this->db->exec($sql_pieza);
                if (isset($pieza['caras'])) {
                    foreach ($pieza['caras'] as $cara) {
                        if (isset($cara['estados'])) {
                            foreach ($cara['estados'][0] as $estado) {
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

    public function actualizarOdontograma($piezas, $idOdontograma) {
        try {
            $this->db->beginTransaction();
            foreach ($piezas as $pieza) {
                $sql_piezas = "UPDATE tbl_paciente_pieza SET id_pieza = " . $pieza['id'] . " where id_odontograma = " . $idOdontograma . " and posicion = " . $pieza['pos'];
                $stat = $this->db->prepare($sql_piezas);
                $stat->execute();
                if (isset($pieza['caras'])) {
                    foreach ($pieza['caras'] as $cara) {
                        if (isset($cara['estados'])) {
                            foreach ($cara['estados'][0] as $estado) {
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

    public function guardarPlanTratamiento($piezas, $tipo) {
        
    }

    public function cargarEstandar($id) {
        $sql = "Select id_pieza,id_cara,id_estado,estado 
            From tbl_odontograma_estados inner join tbl_estados on id_estado = id where id =" . $id . " order by id_pieza,id_cara";
        $result = $this->db->query($sql);
        return $result->fetchAll();
    }

}

?>
