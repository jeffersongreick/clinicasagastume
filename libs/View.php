<?php
/**
 * Created by JetBrains PhpStorm.
 * User: diegoplada
 * Date: 04/06/12
 * Time: 06:34
 * To change this template use File | Settings | File Templates.
 */
class View
{
    public static function factory($view){

    }
    public function render($name){

        require 'views/'.$name.'.php';

    }
}
