<?php 
/* SVN FILE: $Id$ */
/* Datarow Fixture generated on: 2009-06-02 04:06:22 : 1243932682*/

class DatarowFixture extends CakeTestFixture {
	var $name = 'Datarow';
	var $table = 'datarows';
	var $fields = array(
		'id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'primary'),
		'datafeed_id' => array('type'=>'integer', 'null' => false),
		'timestamp' => array('type'=>'datetime', 'null' => false),
		'title' => array('type'=>'string', 'null' => false),
		'content' => array('type'=>'text', 'null' => false),
		'thumb' => array('type'=>'string', 'null' => false),
		'author' => array('type'=>'string', 'null' => false),
		'rating' => array('type'=>'integer', 'null' => false),
		'created' => array('type'=>'datetime', 'null' => false),
		'modified' => array('type'=>'datetime', 'null' => false),
		'tags' => array('type'=>'text', 'null' => false),
		'cpbTags' => array('type'=>'text', 'null' => false),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);
	var $records = array(array(
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
}
?>