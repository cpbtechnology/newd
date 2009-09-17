<?php 
/* SVN FILE: $Id$ */
/* Module Fixture generated on: 2009-06-02 05:06:02 : 1243933742*/

class ModuleFixture extends CakeTestFixture {
	var $name = 'Module';
	var $table = 'modules';
	var $fields = array(
		'id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'primary'),
		'name' => array('type'=>'string', 'null' => false, 'key' => 'unique'),
		'minSize' => array('type'=>'integer', 'null' => false),
		'maxSize' => array('type'=>'integer', 'null' => false),
		'updateid' => array('type'=>'string', 'null' => false),
		'updateInMinutes' => array('type'=>'integer', 'null' => false, 'default' => '0'),
		'datafeed_id' => array('type'=>'integer', 'null' => false),
		'datafeed_tags' => array('type'=>'string', 'null' => false),
		'layout_tag' => array('type'=>'string', 'null' => false),
		'created' => array('type'=>'datetime', 'null' => false),
		'modified' => array('type'=>'datetime', 'null' => false),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'name' => array('column' => 'name', 'unique' => 1))
	);
	var $records = array(array(
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
}
?>