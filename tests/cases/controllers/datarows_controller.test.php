<?php 
/* SVN FILE: $Id$ */
/* DatarowsController Test cases generated on: 2009-06-02 04:06:07 : 1243932787*/
App::import('Controller', 'Datarows');

class TestDatarows extends DatarowsController {
	var $autoRender = false;
}

class DatarowsControllerTest extends CakeTestCase {
	var $Datarows = null;

	function startTest() {
		$this->Datarows = new TestDatarows();
		$this->Datarows->constructClasses();
	}

	function testDatarowsControllerInstance() {
		$this->assertTrue(is_a($this->Datarows, 'DatarowsController'));
	}

	function endTest() {
		unset($this->Datarows);
	}
}
?>