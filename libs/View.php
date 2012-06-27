<?php

class View {

    private $file;
    private $data = array();

    public function __construct($name) {
        $this->file = 'views/' . $name . '.php';
    }

    public static function factory($view_name) {
        return new View($view_name);
    }
    //funcion encargada de generar el html de las vistas
    public function render() {
        //esto carga las varibales de la vista, toma los valores del array data
        // y seta las varibales de la vista donde el nombre conside con las claves del array
        extract($this->data, EXTR_SKIP);
        // Captura la salida de la vista si esto te muestra la vista enseguida.
        // esto te permita trabajar con la vista y mostrarla cuando quieras 
        ob_start();
        try {
            // carga el archivo de la vista dada
            include $this->file;
        } catch (Exception $e) {
            //elimina lo  q fue capturado por ob_start();
            ob_end_clean();

            // Re-throw the exception
            throw $e;
        }

        // retorna lo  q fue caputrado por ob_start y limpia el buffer
        return ob_get_clean();
    }

    //funcion para setiar las variables en la vista     
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

    public function __toString() {
        return $this->render();
    }

}
