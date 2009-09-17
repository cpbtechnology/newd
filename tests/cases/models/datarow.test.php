<?php 
/* SVN FILE: $Id$ */
/* Datarow Test cases generated on: 2009-06-02 04:06:27 : 1243932687*/
App::import('Model', 'Datarow');

class DatarowTestCase extends CakeTestCase {
	var $Datarow = null;
	var $fixtures = array('app.datarow', 'app.datafeed');

	function startTest() {
		$this->Datarow =& ClassRegistry::init('Datarow');
	}

	function testDatarowInstance() {
		$this->assertTrue(is_a($this->Datarow, 'Datarow'));
	}

	function testDatarowFind() {
		$this->Datarow->recursive = -1;
		$results = $this->Datarow->find('first');
		$this->assertTrue(!empty($results));

		$expected = array('Datarow' => array(
			'id'  => 1,
			'datafeed_id'  => 1,
			'timestamp'  => '2009-06-02 04:51:22',
			'title'  => 'Lorem ipsum dolor sit amet',
			'content'  => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida,phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam,vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit,feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'thumb'  => 'Lorem ipsum dolor sit amet',
			'author'  => 'Lorem ipsum dolor sit amet',
			'rating'  => 1,
			'created'  => '2009-06-02 04:51:22',
			'modified'  => '2009-06-02 04:51:22',
			'tags'  => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida,phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam,vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit,feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'cpbTags'  => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida,phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam,vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit,feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.'
		));
		$this->assertEqual($results, $expected);
	}
}
?>