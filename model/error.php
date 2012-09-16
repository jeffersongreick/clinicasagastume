<?php
class Model_Error extends Model {

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

    public function makeError($error, $location) {
        $view = View::factory('error');
        $view->set('error', $error);
        $view->set('location', $location);
        echo $view->render();
    }

}

?>
