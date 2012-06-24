<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of usuarios
 *
 * @author Diego
 */
class Model_Usuarios extends Model{
    
    public function __construct() {
        parent::__construct();
    }
   
    public $pepe = "hoasasa";
    
    public function pepe(){
      $sql = "Select * From Productos";
      $query= $this->db->query($sql);
      
      return $query->fetchAll();
    }
}

?>
