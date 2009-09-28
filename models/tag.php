<?php
// 
// This file is part of Newd.
// 
// Newd is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
// 
// Newd is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
// 
// You should have received a copy of the GNU General Public License
// along with Newd.  If not, see <http://www.gnu.org/licenses/>.
// 
// Copyright 2009, Crispin Porter + Bogusky

class Tag extends AppModel {

	var $name = 'Tag';
	var $validate = array(
		'name' => array('notempty'),
		'topic_id' => array('notempty')
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
		'Topic' => array(
			'className' => 'Topic',
			'foreignKey' => 'topic_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	
	function getTags($id) {
		$conditions = array(  
		   'AND' => array(  
			  'datafeed_ids LIKE' => '%,' . $id . ',%',
			  'status' => 'crawlable'
			)  
		);
		//echo "<pre>";print_r($this->find('list', array('conditions' => $conditions)));echo "</pre>";
		return $this->find('list', array('conditions' => $conditions));
	}
}
?>