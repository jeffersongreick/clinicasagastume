<?php

abstract class Model 
{
  
    private function __construct(){     
    
  }
  
  public static function factory($name){
      
      $class = 'Model_'.$name;
      return new $class;
  }
  
  
}
