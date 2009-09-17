<?php 
/* SVN FILE: $Id$ */
/* ModulesController Test cases generated on: 2009-06-02 05:06:22 : 1243933762*/
App::import('Controller', 'Modules');

class TestModules extends ModulesController {
	var $autoRender = false;
}

class ModulesControllerTest extends CakeTestCase {
	var $Modules = null;

	function startTest() {
		$this->Modules = new TestModules();
		$this->Modules->constructClasses();
	}

	function testModulesControllerInstance() {
		$this->assertTrue(is_a($this->Modules, 'ModulesController'));
	}

	function endTest() {
		unset($this->Modules);
	}
}
?>