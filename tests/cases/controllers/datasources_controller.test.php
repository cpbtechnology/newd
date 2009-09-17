<?php 
/* SVN FILE: $Id$ */
/* DatasourcesController Test cases generated on: 2009-06-02 04:06:23 : 1243930283*/
App::import('Controller', 'Datasources');

class TestDatasources extends DatasourcesController {
	var $autoRender = false;
}

class DatasourcesControllerTest extends CakeTestCase {
	var $Datasources = null;

	function startTest() {
		$this->Datasources = new TestDatasources();
		$this->Datasources->constructClasses();
	}

	function testDatasourcesControllerInstance() {
		$this->assertTrue(is_a($this->Datasources, 'DatasourcesController'));
	}

	function endTest() {
		unset($this->Datasources);
	}
}
?>