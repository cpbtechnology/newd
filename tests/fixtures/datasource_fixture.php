<?php 
/* SVN FILE: $Id$ */
/* Datasource Fixture generated on: 2009-06-02 04:06:24 : 1243930224*/

class DatasourceFixture extends CakeTestFixture {
	var $name = 'Datasource';
	var $table = 'datasources';
	var $fields = array(
		'id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'primary'),
		'name' => array('type'=>'string', 'null' => false, 'default' => NULL, 'key' => 'unique'),
		'updateFreqInMinutes' => array('type'=>'integer', 'null' => false, 'default' => '0'),
		'defaultTags' => array('type'=>'string', 'null' => false, 'default' => NULL),
		'authUserName' => array('type'=>'string', 'null' => false, 'default' => NULL),
		'authPassword' => array('type'=>'string', 'null' => false, 'default' => NULL),
		'created' => array('type'=>'datetime', 'null' => false, 'default' => NULL),
		'modified' => array('type'=>'datetime', 'null' => false, 'default' => NULL),
		'crawlerID' => array('type'=>'string', 'null' => false, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'name' => array('column' => 'name', 'unique' => 1))
	);
	var $records = array(array(
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
}
?>