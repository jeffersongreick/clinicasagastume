<?php
//esta clase se encarga de llamar a los controladores y metodos
class Bootstrap
{
    public static function run(Request $request){

        $controlador = $request->get_controller();
        $method = $request->get_method();
        $arguments = $request->get_aguments();
        //crea la ruta al archivo
        $route = ROOT.'controller'.DS.$controlador.'.php';
        //pregunto si existe el archivo 
        if(is_readable($route)){            
            $class ='Controller_'.ucfirst($controlador);
            $controlador = new $class ;
            //pregunto si existe el existe el metodo en la clase
            if(is_callable(array($controlador,$method))){
                $method = $request->get_method();
            }else{
                $method = 'index';
            }
            //llama a la funcion con los parametros q fueron pasados anteriomente por la url
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