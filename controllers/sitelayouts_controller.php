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

class SitelayoutsController extends AppController {

	var $name = 'Sitelayouts';
	var $helpers = array('Html', 'Form');
	/*
	 * reads a layout html
	 */
	
	function getLayoutSource($layout) {
		$url = "../views/front/".$layout.".ctp";
		$input = @file_get_contents($url) or die('Could not access file: $url');
		return $input;
	}

	/*
	 * examines layout source and returns any matched elemnts
	 */
	
	function getMatchElements($layoutSource) {
		if(preg_match_all("/%%(.*?)%%/", $layoutSource, $matches)) {
			return $matches;					
		}else{
			return null;
		}
	}
	
	/*
	 * associates matched with tokens
	 */
	
	function getLayoutModuleTokens($matches){
		
		$tokens = array(
			'specific' => array(),
			'size' => array()
		);
		
		for($i = 0; $i < sizeof($matches[0]); ++$i){
			$moduleToken = str_replace("%%", "", $matches[0][$i]);
			$val = explode('_', trim($moduleToken));

			if (isset($val[1]) && $val[1] != "") {
				array_push($tokens['specific'], array('moduleName' => $val[1], 'size' => $val[0]));
			} else if(isset($val[0]) && $val[0] != ""){
				array_push($tokens['size'], $val[0]);
			}
			
		}
		return $tokens;
	}

	function getTables($table="all"){
		$allTablesResult = array();
		if($table=="all"){
			$this->loadModel('Datafeed');
			$datafeedsResult = $this->Datafeed->find('all');
			array_push($allTablesResult, $datafeedsResult);
			return $allTablesResult;
		}else{
			return NULL;
		}
	}
	function getRenderedLayout($layout, $tag, $topic){
		//Get layout Markup and its tokens
		$layoutMarkup = $this->getLayoutSource($layout);// Get layout HTML content (default:layout_default.ctp)
		$matches = $this->getMatchElements($layoutMarkup); // Get matching elements
		$layoutTokens = $this->getLayoutModuleTokens($matches); // return arrays of token values
		App::import("Controller", "Modules");
		$Modules = new ModulesController();
		$Modules->constructClasses();
		$dataModuleResult = $Modules->getModules($layoutTokens);
		//Get Modules content
		App::import("Controller", "Datarows");
		$Datarows = new DatarowsController();
		$Datarows->constructClasses();
		$Content = $Datarows->getDatarows($layoutTokens, $tag, $topic);
		//Get final layout Markup
		$layoutMarkup = $this->getlayoutMarkup($layoutMarkup, $layoutTokens, $dataModuleResult, $Content, $matches, $topic);
		return $layoutMarkup;
	}
	
	function getlayoutMarkup($layoutMarkup, $layoutTokens, $dataModuleResult, $Content, $matches, $topic){
		$ModuleView = new View($this->Controller);
		$ModuleView->layout = $this->layout;
		if(sizeof($layoutTokens['specific'])>0){
			$jsUpdateModuleVal = "";
			for($i = 0; $i < sizeof($layoutTokens['specific']); ++$i){
				$moduleName = $layoutTokens['specific'][$i]['moduleName'];//Accessing Modules name
				$moduleSize = $layoutTokens['specific'][$i]['size'];//Accessing Modules size
				$moduleContent = $Content["specific"][$i]; //Accessing Modules content
				$moduleUpdateInSeconds = $dataModuleResult["specific"][$i]['Module']['updateInSeconds'];//Accessing Modules Update in Seconds.
				//If Module is youtube, We need to get the first video ID to display it on the player and get related videos.
					//js string with every Modules name and their corresponding Update in seconds value to be used on js timer (refresher).
				if($moduleName!='youtube'){
					$jsUpdateModuleVal .= "CPB.modules.setUpdateInSeconds('{$moduleName}', '{$moduleUpdateInSeconds}');";
				}
				//Getting the Token name of every module
				$moduleTokenName = $matches[0][$i];
				//Accessing every module view and Delivering named as Module name vars in plural with their corresponing values (array).
				//echo "<pre>"; print_r($moduleContent); echo "</pre>";
				if(sizeof($moduleContent)>0){
					$ModuleView->set("{$moduleName}s", $moduleContent);
					//pass topic
					App::import("Model", "Topic");
					$Topic = new Topic();
					$ModuleView->set('topic',$Topic->getTopicAbbr($topic));
					//Saving every rendered Module
					$moduleSize = $moduleSize == "mobile"?"mobile":"modules";
					$showModule = $ModuleView->renderElement("../".$moduleSize."/".$moduleName."/".$moduleName);
					//Replacing every Module Token name with their corresponding Module Content
					//Only condition for jobs module is needed....
					//$showModule = $moduleName == "jobs"?"<div class='Section' id='Jobs'>{$showModule}</div>":"<div id='{$moduleName}_module'>{$showModule}</div>";
					$layoutMarkup = str_replace($moduleTokenName, $showModule, $layoutMarkup);
				}else{
					$layoutMarkup = str_replace($moduleTokenName, "", $layoutMarkup);
				}
			}
			$layoutMarkup = str_replace("*#*jsUpdateModuleString*#*", $jsUpdateModuleVal, $layoutMarkup);
		}
		return $layoutMarkup;
	}

}
?>