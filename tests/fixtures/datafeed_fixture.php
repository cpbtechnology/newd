<?php 
/* SVN FILE: $Id$ */
/* Datafeed Fixture generated on: 2009-06-02 04:06:47 : 1243932767*/

class DatafeedFixture extends CakeTestFixture {
	var $name = 'Datafeed';
	var $table = 'datafeeds';
	var $fields = array(
		'id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'primary'),
		'name' => array('type'=>'string', 'null' => false, 'key' => 'unique'),
		'updateFreqInMinutes' => array('type'=>'integer', 'null' => false, 'default' => '0'),
		'defaultTags' => array('type'=>'string', 'null' => false),
		'authUserName' => array('type'=>'string', 'null' => false),
		'authPassword' => array('type'=>'string', 'null' => false),
		'created' => array('type'=>'datetime', 'null' => false),
		'modified' => array('type'=>'datetime', 'null' => false),
		'crawlerID' => array('type'=>'string', 'null' => false),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'name' => array('column' => 'name', 'unique' => 1))
	);
	var $records = array(array(
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
}
?>