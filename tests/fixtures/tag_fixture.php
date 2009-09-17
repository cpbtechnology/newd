<?php 
/* SVN FILE: $Id$ */
/* Tag Fixture generated on: 2009-06-02 05:06:48 : 1243933608*/

class TagFixture extends CakeTestFixture {
	var $name = 'Tag';
	var $table = 'tags';
	var $fields = array(
		'id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'primary'),
		'name' => array('type'=>'string', 'null' => false, 'key' => 'unique'),
		'datafeed_ids' => array('type'=>'string', 'null' => false),
		'created' => array('type'=>'datetime', 'null' => false),
		'modified' => array('type'=>'datetime', 'null' => false),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'name' => array('column' => 'name', 'unique' => 1))
	);
	var $records = array(array(
		'id'  => 1,
		'name'  => 'Lorem ipsum dolor sit amet',
		'datafeed_ids'  => 'Lorem ipsum dolor sit amet',
		'created'  => '2009-06-02 05:06:48',
		'modified'  => '2009-06-02 05:06:48'
	));
}
?>