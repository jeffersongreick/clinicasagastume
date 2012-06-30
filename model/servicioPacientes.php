<?php

class servicioPacientes extends Model {
    private static $instance ;

    public static function getInstance(){
          return self::$instance;
    }

    private function __construct() {
        parent::__construct();
    }

}

?>
