<?php 
/* SVN FILE: $Id$ */
/* Layout Fixture generated on: 2009-06-01 21:06:30 : 1243904850*/

class LayoutFixture extends CakeTestFixture {
	var $name = 'Layout';
	var $table = 'layouts';
	var $fields = array(
		'id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'primary'),
		'smallModules' => array('type'=>'integer', 'null' => false, 'default' => '0'),
		'mediumModules' => array('type'=>'integer', 'null' => false, 'default' => '0'),
		'largeModules' => array('type'=>'integer', 'null' => false, 'default' => '0'),
		'extralargeModules' => array('type'=>'integer', 'null' => false, 'default' => '0'),
		'xmlSource' => array('type'=>'string', 'null' => false),
		'created' => array('type'=>'datetime', 'null' => false),
		'modified' => array('type'=>'datetime', 'null' => false),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);
	var $records = array(array(
		'id'  => 1,
		'smallModules'  => 1,
		'mediumModules'  => 1,
		'largeModules'  => 1,
		'extralargeModules'  => 1,
		'xmlSource'  => 'Lorem ipsum dolor sit amet',
		'created'  => '2009-06-01 21:07:30',
		'modified'  => '2009-06-01 21:07:30'
	));
}
?>