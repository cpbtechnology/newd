<?php 
/* SVN FILE: $Id$ */
/* Module Test cases generated on: 2009-06-02 05:06:06 : 1243933746*/
App::import('Model', 'Module');

class ModuleTestCase extends CakeTestCase {
	var $Module = null;
	var $fixtures = array('app.module', 'app.datafeed');

	function startTest() {
		$this->Module =& ClassRegistry::init('Module');
	}

	function testModuleInstance() {
		$this->assertTrue(is_a($this->Module, 'Module'));
	}

	function testModuleFind() {
		$this->Module->recursive = -1;
		$results = $this->Module->find('first');
		$this->assertTrue(!empty($results));

		$expected = array('Module' => array(
			'id'  => 1,
			'name'  => 'Lorem ipsum dolor sit amet',
			'minSize'  => 1,
			'maxSize'  => 1,
			'updateid'  => 'Lorem ipsum dolor sit amet',
			'updateInMinutes'  => 1,
			'datafeed_id'  => 1,
			'datafeed_tags'  => 'Lorem ipsum dolor sit amet',
			'layout_tag'  => 'Lorem ipsum dolor sit amet',
			'created'  => '2009-06-02 05:09:02',
			'modified'  => '2009-06-02 05:09:02'
		));
		$this->assertEqual($results, $expected);
	}
}
?>