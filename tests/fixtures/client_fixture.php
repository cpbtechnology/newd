<?php 
/* SVN FILE: $Id$ */
/* Client Fixture generated on: 2009-06-01 21:06:00 : 1243904820*/

class ClientFixture extends CakeTestFixture {
	var $name = 'Client';
	var $table = 'clients';
	var $fields = array(
		'id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'primary'),
		'name' => array('type'=>'string', 'null' => false, 'key' => 'unique'),
		'tag_id' => array('type'=>'integer', 'null' => false),
		'navIcon' => array('type'=>'string', 'null' => false),
		'created' => array('type'=>'datetime', 'null' => false),
		'modified' => array('type'=>'datetime', 'null' => false),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'name' => array('column' => 'name', 'unique' => 1))
	);
	var $records = array(array(
		'id'  => 1,
		'name'  => 'Lorem ipsum dolor sit amet',
		'tag_id'  => 1,
		'navIcon'  => 'Lorem ipsum dolor sit amet',
		'created'  => '2009-06-01 21:07:00',
		'modified'  => '2009-06-01 21:07:00'
	));
}
?>