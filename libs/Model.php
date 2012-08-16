<?php

abstract class Model {

    protected $db;

    public function __construct() {
        $this->db = new Database();
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public static function factory($name)  {
        $class = 'Model_' . $name;
        try {
            return new $class;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

}
