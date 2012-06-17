<?php

/**
 * Created by JetBrains PhpStorm.
 * User: diegoplada
 * Date: 04/06/12
 * Time: 06:34
 * To change this template use File | Settings | File Templates.
 */
class View {

    private $file;
    private $data = array();

    public function __construct($name) {
        $this->file = 'views/' . $name . '.php';
    }

    public static function factory($view_name) {

        return new View($view_name);
    }

    public function render() {

        extract($this->data, EXTR_SKIP);
        ob_start();
        try {
            //Load the view 
            include $this->file;
        } catch (Exception $e) {
            // Delete the output buffer
            ob_end_clean();

            // Re-throw the exception
            throw $e;
        }
        return ob_get_clean();
    }

    public function set($key, $value = NULL) {

        if (is_array($key)) {
            foreach ($key as $name => $value) {
                $this->data[$name] = $value;
            }
        } else {
            $this->data[$key] = $value;
        }

        return $this;
    }

}
