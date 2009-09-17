<?php 
/* SVN FILE: $Id$ */
/* DatafeedsController Test cases generated on: 2009-06-02 04:06:41 : 1243932821*/
App::import('Controller', 'Datafeeds');

class TestDatafeeds extends DatafeedsController {
	var $autoRender = false;
}

class DatafeedsControllerTest extends CakeTestCase {
	var $Datafeeds = null;

	function startTest() {
		$this->Datafeeds = new TestDatafeeds();
		$this->Datafeeds->constructClasses();
	}

	function testDatafeedsControllerInstance() {
		$this->assertTrue(is_a($this->Datafeeds, 'DatafeedsController'));
	}

	function endTest() {
		unset($this->Datafeeds);
	}
}
?>