<?php 
/* SVN FILE: $Id$ */
/* Layout Test cases generated on: 2009-06-01 21:06:30 : 1243904850*/
App::import('Model', 'Layout');

class LayoutTestCase extends CakeTestCase {
	var $Layout = null;
	var $fixtures = array('app.layout');

	function startTest() {
		$this->Layout =& ClassRegistry::init('Layout');
	}

	function testLayoutInstance() {
		$this->assertTrue(is_a($this->Layout, 'Layout'));
	}

	function testLayoutFind() {
		$this->Layout->recursive = -1;
		$results = $this->Layout->find('first');
		$this->assertTrue(!empty($results));

		$expected = array('Layout' => array(
			'id'  => 1,
			'smallModules'  => 1,
			'mediumModules'  => 1,
			'largeModules'  => 1,
			'extralargeModules'  => 1,
			'xmlSource'  => 'Lorem ipsum dolor sit amet',
			'created'  => '2009-06-01 21:07:30',
			'modified'  => '2009-06-01 21:07:30'
		));
		$this->assertEqual($results, $expected);
	}
}
?>