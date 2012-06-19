<?php
//carga las configuraciones
require 'config/database.php';
require 'config/constant.php';
//carga las clases principales
require 'libs/Bootstrap.php';
require 'libs/Controller.php';
require 'libs/Database.php';
require 'libs/Model.php';
require 'libs/Request.php';
require 'libs/View.php';



//funcion que carga automaticamente los controladores y modelos que se creen;
function auto_load($class) {
    try {
        // trasforma el nombre de la clase en una ruta
        $file = str_replace('_', '/', strtolower($class)).'.php';

        if (file_exists($file)) {
            // carga la clase
            require $file;
            return TRUE;
        }

        return FALSE;
    } catch (Exception $e) {

        die;
    }
}

spl_autoload_register('auto_load');

try {
    Bootstrap::run(new Request);
} catch (Exception $e) {
    echo $e->getMessage();
}
