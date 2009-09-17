<?php 
/* SVN FILE: $Id$ */
/* ClientsController Test cases generated on: 2009-06-01 21:06:38 : 1243904918*/
App::import('Controller', 'Clients');

class TestClients extends ClientsController {
	var $autoRender = false;
}

class ClientsControllerTest extends CakeTestCase {
	var $Clients = null;

	function startTest() {
		$this->Clients = new TestClients();
		$this->Clients->constructClasses();
	}

	function testClientsControllerInstance() {
		$this->assertTrue(is_a($this->Clients, 'ClientsController'));
	}

	function endTest() {
		unset($this->Clients);
	}
}
?>