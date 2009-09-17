<?php 
/* SVN FILE: $Id$ */
/* Datafeed Test cases generated on: 2009-06-02 04:06:47 : 1243932767*/
App::import('Model', 'Datafeed');

class DatafeedTestCase extends CakeTestCase {
	var $Datafeed = null;
	var $fixtures = array('app.datafeed', 'app.datarow');

	function startTest() {
		$this->Datafeed =& ClassRegistry::init('Datafeed');
	}

	function testDatafeedInstance() {
		$this->assertTrue(is_a($this->Datafeed, 'Datafeed'));
	}

	function testDatafeedFind() {
		$this->Datafeed->recursive = -1;
		$results = $this->Datafeed->find('first');
		$this->assertTrue(!empty($results));

		$expected = array('Datafeed' => array(
			'id'  => 1,
			'name'  => 'Lorem ipsum dolor sit amet',
			'updateFreqInMinutes'  => 1,
			'defaultTags'  => 'Lorem ipsum dolor sit amet',
			'authUserName'  => 'Lorem ipsum dolor sit amet',
			'authPassword'  => 'Lorem ipsum dolor sit amet',
			'created'  => '2009-06-02 04:52:47',
			'modified'  => '2009-06-02 04:52:47',
			'crawlerID'  => 'Lorem ipsum dolor sit amet'
		));
		$this->assertEqual($results, $expected);
	}
}
?>