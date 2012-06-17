<?php

class Bootstrap
{
    /*function __construct()
    {
        $url = isset($_GET['url']) ? $_GET['url'] : null;
        $url = rtrim($url, '/');
        $url = explode('/', $url);

        if(empty ($url[0])){
            require 'controllers/index.php';
            $controller = new Index();
            $controller->index();
            return false;
        }

        $file = 'controllers/' . $url[0] . '.php';

        if (file_exists($file)) {
            require $file;
        }else{
            require 'controllers/error.php';
            $error = new Error();
            return false;
        }

        $controller = new $url[0];
//llamar metodos
        if (isset($url[2])) {
            if(method_exists($controller,$url[1]))
        {
            $controller->$url[1]($url[2]);

        }}
         else {
            if (isset($url[1])) {
                $controller->$url[1]();
            }
        }
        //falta un controller aca abajo
    }*/

    public static function run(Request $request){

        $controller = $request->get_controller();
        $method = $request->get_method();
        $arguments = $request->get_aguments();
        $route = ROOT.'controllers'.DS.$controller.'.php';

        if(is_readable($route)){
            require_once $route;
            $controller = new $controller;
            if(is_callable(array($controller,$method))){
                $method = $request->get_method();
            }else{
                $method = 'index';
            }

            if(isset($arguments)){
                call_user_func_array(array($controller,$method),$request->get_aguments());
            }else{
                call_user_func(array($controller,$method));
            }
        }else{
            throw new Exception('Error '.$route.' No fue encontrado');


        }

    }
}