<?php

class Block extends AppModel {

	var $name = 'Block';
	var $validate = array(
		'datafeed_id' => array('numeric')
//		'uniqueIdentifier' => array('alphanumeric')
	);

	var $uses = array('Datafeed');
	
	var $belongsTo = array(
		'Datafeed' => array(
			'className' => 'Datafeed',
			'foreignKey' => 'datafeed_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	
}
?>
