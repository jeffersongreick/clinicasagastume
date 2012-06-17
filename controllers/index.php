<?php

class Index  extends  Controller{

    
 public  function  index(){
     $view_name = "index/index";
     $view = View::factory($view_name);
     $value = "ajsdasds";
     $view->set('a', $value);
     echo $view->render();
    
     
     
 }
    public function otra($a = false){
        $this->view->render('index/index');
    }

    public function pepe(){
        echo $_POST['a'];


    }
}