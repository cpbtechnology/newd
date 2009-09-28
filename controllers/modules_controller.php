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

class ModulesController extends AppController {

	var $name = 'Modules';
	var $helpers = array('Html', 'Form','HtmlCache.HtmlCache');
	var $uses = array('Module','Datarow','Topic');
	var $components = array('RequestHandler', 'Auth');
	
	/*
	 * mapping function
	 */
    function beforeFilter()
    {
		$this->Auth->allow('getModules', 'refreshMobileModule', 'refreshModule', 'getModuleAlias', 'getModuleJSON', 'moduleMaxSize');
		if($this->Session->read('Auth.User.changePassword')==1){
			$this->redirect(array('controller' => 'cpbadmin','action' => 'resetpassword'));
			exit();
		}
    }

	function moduleMaxSize($size){
		switch($size){
			case "large":
				return 15;
				break;
			case "medium":
				return 8;
				break;
			case "small":
				return 4;
				break;
		}
	}
	
	/*
	 * retrieves modules by specific/size and pulls all the information regarding each module
	 */
	
	function getModules($layoutTokens){//get module by name, size
		$availableModules = $this->Module->find('all');
		$dataModuleResult = array(
			'specific' => array(),
			'size' => array()
		);
		if(sizeof($layoutTokens['specific'])>0){
			for($i = 0; $i < sizeof($layoutTokens['specific']); ++$i){//loop specific modules
				$size = $this->moduleMaxSize($layoutTokens['specific'][$i]['size']);
				$moduleFound = false;
				for($j = 0; $j < sizeof($availableModules); ++$j){
					if ($availableModules[$j]['Module']['name']==$layoutTokens['specific'][$i]['moduleName'] /*&& $availableModules[$j]['Module']['maxSize']==$size*/){
						array_push($dataModuleResult['specific'], $availableModules[$j]);
						$moduleFound = true;
						break;
					}
				}
				if(!$moduleFound){
					array_push($dataModuleResult['specific'], $availableModules[0]);
				}
			}
		}
		if(sizeof($layoutTokens['size'])>0){
			for($i = 0; $i < sizeof($layoutTokens['size']); ++$i){//loop modules by size
				$size = $this->moduleMaxSize($layoutTokens['size'][$i]);
				$moduleFound = false;
				for($j = 0; $j < sizeof($availableModules); ++$j){
					if ($availableModules[$j]['Module']['maxSize']==$size){
						array_push($dataModuleResult['size'], $availableModules[$j]);
						$moduleFound = true;
						break;
					}
				}
				if(!$moduleFound){// if no matching module...
					//search previously taken modules...
					for($j = 0; $j < sizeof($dataModuleResult['specific']); ++$j){
						if ($dataModuleResult['specific'][$j]['Module']['maxSize']==$size){
							array_push($dataModuleResult['size'], $dataModuleResult['specific'][$j]);
							$moduleFound = true;
							break;
						}
					}
					if(!$moduleFound){//assign default module...
						array_push($dataModuleResult['size'], $availableModules[0]);
					}
				}
			}
		}
		
		return $dataModuleResult;
	}
	
	/*
	 * refreshes a mobile module given the module name
	 */
	function refreshMobileModule($module="") {
		App::import("Controller", "Datarows");
		$Datarows = new DatarowsController();
		$Datarows->constructClasses();
		$Content = $Datarows->setMobileContent($module);
		$this->set("items", $Content);
		$this->viewPath = "../views/mobile/$module";
		$this->layout = "empty";
		$this->render($module);
	}
	
	/*
	 * refreshes a given module (stores/retrieves cache)
	 */
	
	function refreshModule($module="",$topic="",$tag="") {
		require_once('../config/utility.php');
		App::import("Controller", "Datarows");
		$Datarows = new DatarowsController();
		$Datarows->constructClasses();
		$Content = $Datarows->setContent($module, $tag, $topic);
		$this->set($module . "s", $Content);
		$this->viewPath = '../views/modules/' . $module;
		$renderContent = $this->render($module);
	}

	
	function getModuleAlias($module){
		switch($module){
			case "youtube":
				$module = "queue";
				break;
			case "bubble":
				$module = "featured";
				break;
			default:
				//$module = "featured";
		}
		return $module;
	}
	
	function getModuleJSON($name,$tag,$topic,&$json, $options) {
		//get content
		App::import("Controller", "Datarows");
		$Datarows = new DatarowsController();
		$Datarows->constructClasses();
		$module_content = $Datarows->setContent($name, $tag, $topic, $options);
		
		$output = array();
		//echo "<pre>"; print_r($module_content); echo "</pre>";
		foreach($module_content AS $item) {
			
			$date = date('Y-m-d',strtotime($item["Datarow"]["published"]));
			$date_published = date('M d, Y',strtotime($date));
			$date_twitter = getTwitterDateFormat($item["Datarow"]["published"]);
			
			if(!isset($output[$date])) {
				$output[$date] = array();
			}
			
			if($name == "twitter") {
				//parse author
				$parts = explode(" (",$item["Datarow"]["author"]);
				if(count($parts) == 2) {
					$screen_name = trim($parts[0]);
					$real_name = trim(str_replace(")","",$parts[1]));
				}
				else {
					$screen_name = $item["Datarow"]["author"];
					$real_name = $item["Datarow"]["author"];
				}
				//adjust date
				
				
				$post = array(
					"topic"=>$this->Topic->getTopicAbbr($topic),
					"user"=>array(
						"profile_image_url"=>$item["Datarow"]["thumb"],
						"screen_name"=>$screen_name,
						"name"=>$real_name,
						"protected"=>false
					),
					"id"=>$item["Datarow"]["id"],
					"text"=>$item["Datarow"]["content"],
					"created_at"=>$date_twitter,
					"truncated"=>false,
					"status_id"=>substr($item["Datarow"]["articleId"], strrpos($item["Datarow"]["articleId"], "statuses")+9 , 60) 
				);
			}
			else if($name == "youtube" || $name == "queue") {
				$post = array(
					"topic"=>$this->Topic->getTopicAbbr($topic),
					"title"=>$item["Datarow"]["title"],
					"text"=>$item["Datarow"]["content"],
					"truncated"=>false,
					"image_url"=>$item["Datarow"]["thumb"],
					"service"=>"youtube",
					"video_id"=>$item["Datarow"]["articleId"],
					"id"=>$item["Datarow"]["id"]
				);
			}
			else if($name == "blogs" || $name == "news" || $name == "articles") {
			
				//get source loaction
				$location = $item["Datarow"]["articleId"];
				$location = str_replace("http://","",$location);
				$parts = explode("/",$location);
				$location = "http://".$parts[0];
				
				$post = array(
					"topic"=>$this->Topic->getTopicAbbr($topic),
					"source"=>array(
						"name"=>$item["Datarow"]["author"],
						"location"=>$location
					),
					"title"=>$item["Datarow"]["title"],
					"text"=>$item["Datarow"]["content"],
					"created_at"=>$date_published,
					"truncated"=>false,
					"location"=>$item["Datarow"]["articleId"],
					"id"=>$item["Datarow"]["id"]
				);
			}
			else if($name == "bubble" || $name == "featured") {
				$post = array(
					"topic"=>$this->Topic->getTopicAbbr($topic),
					"title"=>$item["Datarow"]["title"],
					"text"=>"",
					"truncated"=>false,
					"location"=>$item["Datarow"]["content"],
					"image_url"=>$item["Datarow"]["thumb"],
					"id"=>$item["Datarow"]["id"]
				);
			}
			else if($name == "jobs") {
				$post = array(
					"topic"=>$this->Topic->getTopicAbbr($topic),
					"title"=>$item["Datarow"]["title"],
					"content"=>$item["Datarow"]["content"],
					"truncated"=>false,
					"position"=>$item["Datarow"]["thumb"],
					"job_type"=>$item["Datarow"]["author"],
					"id"=>$item["Datarow"]["articleId"],
					"created"=>$item["Datarow"]["created"],
					"modified"=>$item["Datarow"]["modified"]
				);
			}
			
			array_push($output[$date],$post);
		}
		
		//sort
		krsort($output);
		
		foreach($output AS $date=>$posts) {
		
			$date_year = date('Y',strtotime($date));
			$date_day = date('j',strtotime($date));
			$date_month = date('F',strtotime($date));
			$date_dow = date('l',strtotime($date));
			$date_day_abbr = strtolower(date('D',strtotime($date)));
			$date_month_abbr = strtolower(date('M',strtotime($date)));
			
			if($name != "youtube" && $name != "queue" && $name != "featured" && $name != "bubble") {
				array_push(
					$json[$this->getModuleAlias($name)],
					array(
						"date"=>array(
							"year"=>$date_year,
							"month"=>$date_month,
							"date"=>$date_day,
							"day"=>$date_dow,
							"day_abbr"=>$date_day_abbr,
							"month_abbr"=>$date_month_abbr
						),
						"posts"=>$posts
					)
				);
			}
			else {
				if(!isset($json[$this->getModuleAlias($name)]["posts"])) {
					$json[$this->getModuleAlias($name)]["posts"] = array();
				}
				foreach($posts AS $post) {
					array_push($json[$this->getModuleAlias($name)]["posts"],$post);
				}
			}
		}
		
		return $json;
	}
	
	
	function admin_index() {
		$this->layout = "admin";
		$this->set('activeTab','modules');
		$this->Module->recursive = 0;
		$this->set('modules', $this->paginate());
	}
	
	function admin_view($id = null) {
		$this->layout = "admin";
		$this->set('activeTab','modules');
		if (!$id) {
			$this->Session->setFlash(__('Invalid Module.', true));
			$this->redirect(array('controller' => 'modules','action' => 'admin_index'));
		}
		$this->set('module', $this->Module->read(null, $id));
	}

	function admin_add() {
		$this->layout = "admin";
		$this->set('activeTab','modules');
		if (!empty($this->data)) {
			$this->Module->create();
			if ($this->Module->save($this->data)) {
				$this->Session->setFlash(__('The Module has been saved', true));
				$this->redirect(array('controller' => 'modules','action' => 'admin_index'));
			} else {
				$this->Session->setFlash(__('The Module could not be saved. Please, try again.', true));
			}
		}
	}

	function admin_edit($id = null) {
		$this->layout = "admin";
		$this->set('activeTab','modules');
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Module', true));
			$this->redirect(array('controller' => 'modules','action' => 'admin_index'));
		}
		if (!empty($this->data)) {
			if ($this->Module->save($this->data)) {
				$this->Session->setFlash(__('The Module has been saved', true));
				$this->redirect(array('controller' => 'modules','action' => 'admin_index'));
			} else {
				$this->Session->setFlash(__('The Module could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Module->read(null, $id);
		}
	}

	function admin_delete($id = null) {
		$this->layout = "admin";
		$this->set('activeTab','modules');
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Module', true));
			$this->redirect(array('controller' => 'modules','action' => 'admin_index'));
		}
		if ($this->Module->del($id)) {
			$this->Session->setFlash(__('Module deleted', true));
			$this->redirect(array('controller' => 'modules','action' => 'admin_index'));
		}
	}
	
}
?>