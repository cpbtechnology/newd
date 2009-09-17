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

class DatafeedsController extends AppController {

	var $name = 'Datafeeds';
	var $helpers = array('Html', 'Form');
	var $uses = array('Datafeed', 'Datarow', 'Tag');
	var $components = array('Auth');
	var $crawlerInstance;
	
	/*
	 * utilility function used to format the tag
	 */

    function beforeFilter()
    {
		if($this->Session->read('Auth.User.changePassword')==1){
			$this->redirect(array('controller' => 'cpbadmin','action' => 'resetpassword'));
			exit();
		}
    }

	function formatTag($tag) {
		return '"' . str_replace('"', "'", $tag) . '"';
	}
	
	/*
	 * utility function used for logging the results of a crawler
	 */
	
	function log($type,$msg) {
		echo date("Y-m-d H:i:s")." - [$type] $msg"."\n";
	}
	
	/*
	 * searches a provided feed for new data
	 */
	
	function searchfeed($sourceName = '') {
		$modified = false;

		// Retrieve the datasource model, and the last time we searched
		$dsource = $this->Datafeed->getFeed($sourceName);
		$updatedSince = $dsource['Datafeed']['modified'];
		$datafeedId = $dsource['Datafeed']["id"];
		// Determine what tags if any are available to search
		if ($dsource['Datafeed']["defaultTags"] != "") {
			// Find tags by all the comma delimited IDs in this field
		} else {
			// Use all crawlable tags
			$tags = $this->Tag->getTags($datafeedId);
		}
		
		//var_dump($tags);
		
		// Instantiate the datasource feed reader
		require_once('models/datasources/' . $sourceName . '.php');
		
		if (is_null($this->crawlerInstance)) {
			$this->crawlerInstance = $crawler;
		}
		
		foreach ($tags as $tag) {
			$feedResults = $this->crawlerInstance->crawlFeed($updatedSince, $tag, $datafeedId);
			if ($modified = count($feedResults)) {
				echo date("Y-m-d H:i:s")." - [NOTICE][$sourceName][$tag]: $modified results returned."."\n";
			}
			//determine sleep time (per tag)
			$sleep_time = $sourceName == "twitter"?0:60;
			if($sleep_time>0) {sleep($sleep_time);}
		}
		
		//determine sleep time (per cycle)
		$sleep_time = $sourceName == "twitter"?15:0;
		if($sleep_time>0) {sleep($sleep_time);}
		
		// Update last run current modified time
		if($modified) {$dsource['Datafeed']["modified"] = date("Y-m-d H:i:s");}
		
		//clean up
		unset($dsource);
		unset($conditions);
		unset($tags);
	}
	
	
	
	function admin_index() {
		$this->layout = "admin";
		$this->set('activeTab','datafeeds');
		$this->Datafeed->recursive = 0;
		$this->set('datafeeds', $this->paginate());
	}
	
	function admin_view($id = null) {
		$this->layout = "admin";
		$this->set('activeTab','datafeeds');
		if (!$id) {
			$this->Session->setFlash(__('Invalid Datafeed.', true));
			$this->redirect(array('controller' => 'datafeeds','action' => 'admin_index'));
		}
		$this->set('datafeed', $this->Datafeed->read(null, $id));
	}

	function admin_add() {
		$this->layout = "admin";
		$this->set('activeTab','datafeeds');
		if (!empty($this->data)) {
			$this->Datafeed->create();
			if ($this->Datafeed->save($this->data)) {
				$this->Session->setFlash(__('The Datafeed has been saved', true));
				$this->redirect(array('controller' => 'datafeeds','action' => 'admin_index'));
			} else {
				$this->Session->setFlash(__('The Datafeed could not be saved. Please, try again.', true));
			}
		}
	}

	function admin_edit($id = null) {
		$this->layout = "admin";
		$this->set('activeTab','datafeeds');
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Datafeed', true));
			$this->redirect(array('controller' => 'datafeeds','action' => 'admin_index'));
		}
		if (!empty($this->data)) {
			if ($this->Datafeed->save($this->data)) {
				$this->Session->setFlash(__('The Datafeed has been saved', true));
				$this->redirect(array('controller' => 'datafeeds','action' => 'admin_index'));
			} else {
				$this->Session->setFlash(__('The Datafeed could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Datafeed->read(null, $id);
		}
	}

	function admin_delete($id = null) {
		$this->layout = "admin";
		$this->set('activeTab','datafeeds');
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Datafeed', true));
			$this->redirect(array('controller' => 'datafeeds','action' => 'admin_index'));
		}
		if ($this->Datafeed->del($id)) {
			$this->Session->setFlash(__('Datafeed deleted', true));
			$this->redirect(array('controller' => 'datafeeds','action' => 'admin_index'));
		}
	}
}
?>