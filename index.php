<?php

require 'config/database.php';
require 'config/constant.php';


function autoload_libs($class){
    include 'libs/' . $class . '.php';
}


spl_autoload_register('autoload_libs');

//$app = new Bootstrap();
try{
Bootstrap::run(new Request);
}catch (Exception $e){
echo $e->getMessage();
}
