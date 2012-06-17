<?php

class Index  extends  Controller{

    function __construct(){
        parent::__construct();

    }
 public  function  index(){
     $this->view->render('index/index');
 }
    public function otra($a = false){
        $this->view->render('index/index');
    }

    public function pepe(){
        echo $_POST['a'];


    }
}