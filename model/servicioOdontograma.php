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
}
?>
