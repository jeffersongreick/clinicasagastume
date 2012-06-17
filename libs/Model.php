<?php
/**
 * Created by JetBrains PhpStorm.
 * User: diegoplada
 * Date: 04/06/12
 * Time: 06:51
 * To change this template use File | Settings | File Templates.
 */
abstract class Model extends Database
{
  function __construct(){
      $this->db = new Database();
  }
}
