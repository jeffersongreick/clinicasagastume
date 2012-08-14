<?php

class Controller_Usuario{
    
        public function index() {
        try {
            $view = View::factory('login');
            echo $view->render();
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
    }
    
    public function principal() {
        try {
            $view = View::factory('principal');
            echo $view->render();
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
    }
}

?>
