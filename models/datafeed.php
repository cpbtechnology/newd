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

class Datafeed extends AppModel {

	var $name = 'Datafeed';
	var $validate = array(
		'name' => array('alphanumeric'),
		'updateFreqInMinutes' => array('numeric')
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $hasMany = array(
		'Datarow' => array(
			'className' => 'Datarow',
			'foreignKey' => 'datafeed_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);
	
	function getFeed($name) {
		// Retrieve the datasource model, and the last time we searched
		$this->recursive=0;
		$dsource = $this->find(array('name' => $name));
		if ($dsource == false) {
			$this->log('error',"Unable to locate datafeed");
			exit();
		}
		return $dsource;
	}
}
?>