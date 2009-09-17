<?php
// 
// This file is part of Nude.
// 
// Nude is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
// 
// Nude is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
// 
// You should have received a copy of the GNU General Public License
// along with Nude.  If not, see <http://www.gnu.org/licenses/>.
// 
// Copyright 2009, Crispin Porter + Bogusky

class Module extends AppModel {

	var $name = 'Module';
	var $validate = array(
		'name' => array('alphanumeric'),
		'minSize' => array('numeric'),
		'maxSize' => array('numeric'),
		'updateInSeconds' => array('numeric'),
		'datafeed_id' => array('numeric')
	);
	var $uses = array('Datafeed');
	//The Associations below have been created with all possible keys, those that are not needed can be removed
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