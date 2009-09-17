<?php 
/* SVN FILE: $Id$ */
/* Client Test cases generated on: 2009-06-01 21:06:00 : 1243904820*/
App::import('Model', 'Client');

class ClientTestCase extends CakeTestCase {
	var $Client = null;
	var $fixtures = array('app.client', 'app.tag');

	function startTest() {
		$this->Client =& ClassRegistry::init('Client');
	}

	function testClientInstance() {
		$this->assertTrue(is_a($this->Client, 'Client'));
	}

	function testClientFind() {
		$this->Client->recursive = -1;
		$results = $this->Client->find('first');
		$this->assertTrue(!empty($results));

		$expected = array('Client' => array(
			'id'  => 1,
			'name'  => 'Lorem ipsum dolor sit amet',
			'tag_id'  => 1,
			'navIcon'  => 'Lorem ipsum dolor sit amet',
			'created'  => '2009-06-01 21:07:00',
			'modified'  => '2009-06-01 21:07:00'
		));
		$this->assertEqual($results, $expected);
	}
}
?>