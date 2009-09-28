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

class Topic extends AppModel {

	var $name = 'Topic';
	var $validate = array(
		'name' => array('notempty'),
		'abbr' => array('notempty'),
		'navIcon' => array('notempty')
	);
	
	function getTopicName($abbr) {
		$conditions = array(
			'abbr'=>$abbr
		);
		$rows = $this->find('all',array('conditions'=>$conditions));
		if(count($rows) == 1) {
			foreach($rows AS $row) {
				return $row['Topic']['name'];
			}
		}
		
		return false;
	}
	
	function getTopicAbbr($name) {
		$conditions = array(
			'name'=>$name
		);
		$rows = $this->find('all',array('conditions'=>$conditions));
		if(count($rows) == 1) {
			foreach($rows AS $row) {
				return $row['Topic']['abbr'];
			}
		}
		
		return false;
	}
}
?>