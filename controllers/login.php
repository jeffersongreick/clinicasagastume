<?php
/**
 * Created by JetBrains PhpStorm.
 * User: diegoplada
 * Date: 04/06/12
 * Time: 16:25
 * To change this template use File | Settings | File Templates.
 */
class login extends Controller
{
    function __construct(){
        parent::__construct();
    }

    public function test()
    {
      require 'models/login_model.php';
      $model = new Login_Model();
      $result = $model->db->query('SELECT * FROM usuarios');
      $model->db->
      var_dump($result->fetchAll());
      $this->view->render('login/index');
    }
}
