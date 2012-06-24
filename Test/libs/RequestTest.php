<?php

require_once dirname(__FILE__) . '/../../libs/Request.php';
require_once dirname(__FILE__) . '/../../config/constant.php';

class RequestTest extends PHPUnit_Framework_TestCase {

    public function testObtenerValoresDeURL() {

        $_GET['url'] = 'pacientes/obtener/2/5/4/48';

        $r = new Request();

        $this->assertEquals('pacientes', $r->get_controller());
        $this->assertEquals('obtener', $r->get_method());
        $this->assertContains(2, $r->get_aguments());
        $this->assertContains(4, $r->get_aguments());
        $this->assertContains(5, $r->get_aguments());
        $this->assertContains(48, $r->get_aguments());
    }

    public function testValoresPorDefecto() {
        $request = new Request();
        $this->assertEquals('usuarios', $request->get_controller());
        $this->assertEquals('index', $request->get_method());
        $this->assertEmpty($request->get_aguments());
    }

  
}

?>
