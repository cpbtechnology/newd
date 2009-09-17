<?php 
/* SVN FILE: $Id$ */
/* Datasource Test cases generated on: 2009-06-02 04:06:28 : 1243930228*/
App::import('Model', 'Datasource');

class DatasourceTestCase extends CakeTestCase {
	var $Datasource = null;
	var $fixtures = array('app.datasource', 'app.datarow');

	function startTest() {
		$this->Datasource =& ClassRegistry::init('Datasource');
	}

	function testDatasourceInstance() {
		$this->assertTrue(is_a($this->Datasource, 'Datasource'));
	}

	function testDatasourceFind() {
		$this->Datasource->recursive = -1;
		$results = $this->Datasource->find('first');
		$this->assertTrue(!empty($results));

		$expected = array('Datasource' => array(
			'id'  => 1,
			'name'  => 'Lorem ipsum dolor sit amet',
			'updateFreqInMinutes'  => 1,
			'defaultTags'  => 'Lorem ipsum dolor sit amet',
			'authUserName'  => 'Lorem ipsum dolor sit amet',
			'authPassword'  => 'Lorem ipsum dolor sit amet',
			'created'  => '2009-06-02 04:10:24',
			'modified'  => '2009-06-02 04:10:24',
			'crawlerID'  => 'Lorem ipsum dolor sit amet'
		));
		$this->assertEqual($results, $expected);
	}
}
?>