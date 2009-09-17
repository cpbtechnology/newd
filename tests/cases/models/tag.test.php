<?php 
/* SVN FILE: $Id$ */
/* Tag Test cases generated on: 2009-06-02 05:06:51 : 1243933611*/
App::import('Model', 'Tag');

class TagTestCase extends CakeTestCase {
	var $Tag = null;
	var $fixtures = array('app.tag');

	function startTest() {
		$this->Tag =& ClassRegistry::init('Tag');
	}

	function testTagInstance() {
		$this->assertTrue(is_a($this->Tag, 'Tag'));
	}

	function testTagFind() {
		$this->Tag->recursive = -1;
		$results = $this->Tag->find('first');
		$this->assertTrue(!empty($results));

		$expected = array('Tag' => array(
			'id'  => 1,
			'name'  => 'Lorem ipsum dolor sit amet',
			'datafeed_ids'  => 'Lorem ipsum dolor sit amet',
			'created'  => '2009-06-02 05:06:48',
			'modified'  => '2009-06-02 05:06:48'
		));
		$this->assertEqual($results, $expected);
	}
}
?>