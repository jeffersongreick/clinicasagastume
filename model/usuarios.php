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
    public $pepe = "hoasasa";
    public function pepe(){
        $db = new Database();
        $sql = "Select * From usuarios";
        $db->query($sql)->execute();
        
    }
}

?>
