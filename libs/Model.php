<?php

abstract class Model
{
  protected $db;
  public function __construct(){
        $this->db = new Database();
  }
  public static function factory($name){
      $class = 'Model_'.$name;
      return new $class;
  }
}
