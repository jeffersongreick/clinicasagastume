<?php

class Bootstrap
{
    public static function run(Request $request){

        $controlador = $request->get_controller();
        $method = $request->get_method();
        $arguments = $request->get_aguments();
        $route = ROOT.'controller'.DS.$controlador.'.php';

        if(is_readable($route)){            
            $class ='Controller_'.ucfirst($controlador);
            $controlador = new $class ;
            if(is_callable(array($controlador,$method))){
                $method = $request->get_method();
            }else{
                $method = 'index';
            }

            if(isset($arguments)){
                call_user_func_array(array($controlador,$method),$request->get_aguments());
            }else{
                call_user_func(array($controlador,$method));
            }
        }else{
            throw new Exception('Error '.$route.' No fue encontrado');


        }

    }
}