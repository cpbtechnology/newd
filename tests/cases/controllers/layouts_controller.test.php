<?php 
/* SVN FILE: $Id$ */
/* LayoutsController Test cases generated on: 2009-06-01 21:06:30 : 1243904970*/
App::import('Controller', 'Layouts');

class TestLayouts extends LayoutsController {
	var $autoRender = false;
}

class LayoutsControllerTest extends CakeTestCase {
	var $Layouts = null;

	function startTest() {
		$this->Layouts = new TestLayouts();
		$this->Layouts->constructClasses();
	}

	function testLayoutsControllerInstance() {
		$this->assertTrue(is_a($this->Layouts, 'LayoutsController'));
	}

	function endTest() {
		unset($this->Layouts);
	}
}
?>