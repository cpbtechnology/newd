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

/*
 * this class is designed to allow interaction with datarows
 */

class DatarowsController extends AppController {

	var $name = 'Datarows';
	var $helpers = array('Html', 'Form');
	var $components = array('Auth');
	/*
	 * function was implemented exclusively for serving mobile content
	 */
	
	function setMobileContent($module) {
		$datarowsResult = array();
		$limit = 10;
		$topic = "crispin porter";
		$scope = $module=="all"?array():array('Datafeed.name' => $module);
		return $this->Datarow->getRowsForMobile($topic,$scope,'created',$limit);
	}
	
	/*
	 * function sets content for specified module, tag, topic
	 */

	/*
	function setContent($module, $tag, $topic = ""){
		$datarowsResult = array();
		if($module == 'youtube'){
			$featureVideo = $this->Datarow->getFeaturedRow($module,$topic);
			$limit = 60;// was 7, 20
			$videosResult = $this->Datarow->getRows($module,$tag,$topic,$limit);
			if(sizeof($featureVideo['Datarow'])>0){array_push($datarowsResult, $featureVideo);}
			for($i=0; $i < sizeof($videosResult); ++$i){
				array_push($datarowsResult, $videosResult[$i]);
			}
		} else if($module == 'bubble'){
			$datarowsResult = $this->Datarow->getRowsForBubble($module,$topic);
		} else if ($module == 'blogs') {
			$limit = 11;
			$datarowsResult = $this->Datarow->getRows($module,$tag,$topic,$limit);
		} else {
			$limit = 10;
			$datarowsResult = $this->Datarow->getRows($module,$tag,$topic,$limit);
		}
		return $datarowsResult;
	}
	*/
	
	function setContent($module, $tag, $topic, $options = array()){
		return $this->Datarow->getRows($module,$tag,$topic,$options);
	}
	
	/*
	 * returns total number of related videos when provided video id
	 */
	
	function getYoutubeTotalResult($articleId){
		$feedURL = 'http://gdata.youtube.com/feeds/api/videos/'.$articleId.'/related';
		$sxml = simplexml_load_file($feedURL);
		$openSearch = $sxml->children('http://a9.com/-/spec/opensearchrss/1.0/');
		return $openSearch->totalResults;
	}
	
	/*
	 * returns youtube videos for provided topic excluding video with $id 
	 */
	
	function getNewVideos($id, $topic){
		$datarowsResult = array();
		$totalResults = $this->getYoutubeTotalResult($id);
		if($totalResults == 0){
			$this->Datarow->deleteAll(array('Datarow.articleId' => $id));
		}
		
		$limit = 60;
		
		$featureVideo = $this->Datarow->getFeaturedRowExcept('youtube',$topic,$id);
		$videosResult = $this->Datarow->getRowsExcept('youtube',$topic,$id,'rating',$limit);
		
		if(sizeof($featureVideo['Datarow'])>0){array_push($datarowsResult, $featureVideo);}
		for($i=0; $i < sizeof($videosResult); ++$i){
			array_push($datarowsResult, $videosResult[$i]);
		}
		return $datarowsResult;
	}
	
	/*
	 * retrieves the content
	 */
	
	function getDatarows($dataModuleResult, $tag = "", $topic = ""){// get datarows by id
		$content = array(
			'specific' => array(),
			'size' => array()
		);
		if(sizeof($dataModuleResult['specific'])>0){
			for($i = 0; $i < sizeof($dataModuleResult['specific']); ++$i){//loop specific modules
				$contentSpecific = $this->setContent($dataModuleResult['specific'][$i]['moduleName'], $tag, $topic);
				array_push($content['specific'], $contentSpecific);
			}
		}
		if(sizeof($dataModuleResult['size'])>0){
			for($i = 0; $i < sizeof($dataModuleResult['size']); ++$i){//loop modules by size
				$contentSize = $this->setContent($dataModuleResult['size'][$i], $tag, $topic);
				array_push($content['size'], $contentSize);
			}
		}
		return $content;
	}
	
	
	function admin_index() {
		$this->layout = "admin";
		$this->set('activeTab','datarows');
		$this->Datarow->recursive = 0;
		$this->set('datarows', $this->paginate());
	}
	
	function admin_view($id = null) {
		$this->layout = "admin";
		$this->set('activeTab','datarows');
		if (!$id) {
			$this->Session->setFlash(__('Invalid Datarow.', true));
			$this->redirect(array('controller' => 'datarows','action' => 'admin_index'));
		}
		$this->set('datarow', $this->Datarow->read(null, $id));
	}

	function admin_add() {
		$this->layout = "admin";
		$this->set('activeTab','datarows');
		if (!empty($this->data)) {
			$this->Datarow->create();
			if ($this->Datarow->save($this->data)) {
				$this->Session->setFlash(__('The Datarow has been saved', true));
				$this->redirect(array('controller' => 'datarows','action' => 'admin_index'));
			} else {
				$this->Session->setFlash(__('The Datarow could not be saved. Please, try again.', true));
			}
		}
	}

	function admin_edit($id = null) {
		$this->layout = "admin";
		$this->set('activeTab','datarows');
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Datarow', true));
			$this->redirect(array('controller' => 'datarows','action' => 'admin_index'));
		}
		if (!empty($this->data)) {
			if ($this->Datarow->save($this->data)) {
				$this->Session->setFlash(__('The Datarow has been saved', true));
				$this->redirect(array('controller' => 'datarows','action' => 'admin_index'));
			} else {
				$this->Session->setFlash(__('The Datarow could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Datarow->read(null, $id);
		}
	}

	function admin_delete($id = null) {
		$this->layout = "admin";
		$this->set('activeTab','datarows');
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Datarow', true));
			$this->redirect(array('controller' => 'datarows','action' => 'admin_index'));
		}
		if ($this->Datarow->del($id)) {
			$this->Session->setFlash(__('Datarow deleted', true));
			$this->redirect(array('controller' => 'datarows','action' => 'admin_index'));
		}
	}
	
}
?>
