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

class FrontController extends AppController {
	var $name = 'Front';
	var $helpers = array('Html', 'Javascript', 'Form','Module','HtmlCache.HtmlCache');
	var $uses = array('Module','Datafeed','Datarow','Topic');
	var $components = array('RequestHandler');
	
	function beforeFilter(){
		parent::beforeFilter();
		if ('json' == $this->params['url']['ext']) {
			$this->RequestHandler->setContent('json', 'text/x-json');
		}
	}

	function index($module="all") {
		$topic = isset($this->params['topic']) ? $this->params['topic'] : 'cpb';

		if ('json' == $this->params['url']['ext']) {
			$this->_renderJSON($module,"", urldecode($topic));
		} 
		else {
			$this->set('topic', $topic);
			$this->set('currentTopic', $this->Topic->getTopicName($topic));
			$this->_renderLayout("layout_default", "", urldecode($this->Topic->getTopicName($topic)));
		}
	}
	
	function mobile($page = 'index') {
		$topic = 'cpb';
		$this->layout = "mobile";
		//validate
		$this->_renderLayout("mobile_$page",'',urldecode($this->Topic->getTopicName($topic)));
	}
	
	function more() {
		$module = $this->params['module'];
		$topic = $this->params['topic'];
		
		$options = array();
		$options["offset"] = isset($this->params['offset']) ? $this->params['offset'] : 0;
		$options["limit"] = isset($this->params['limit']) ? $this->params['limit'] : 12;
		
		if ('json' == $this->params['url']['ext']) {
			$this->_renderJSON($module,"", urldecode($topic), $options);
		} else {
			$this->redirect('/');
		}
	}

	function update() {
		$module = $this->params['module'];
		$topic = $this->params['topic'];
		
		$options = array();
		$options["since"] = isset($this->params['url']['since']) ? $this->params['url']['since'] : NULL;//$this->default_time;

		if ('json' == $this->params['url']['ext']) {
			$this->_renderJSON($module,"", urldecode($topic),$options);
		} else {
			$this->redirect('/');
		}
	}
	
	function contact() {
		$this->layout = false;
		$this->render();
	}
	
	function terms() {
		$this->layout = false;
		$this->render();
	}
	
	function developers() {
		$this->layout = false;
		$this->render();
	}
	
	function privacy() {
		$this->layout = false;
		$this->render();
	}

	function search($search="") {
		$this->_renderLayout("layout_default", html_entity_decode($search), "");
	}

	/*
	 * main rendering method
	 */
	
	function _renderLayout($layout = "layout_default", $tag, $topic = ""){
		require_once('../config/utility.php');

		//Get layout Markup and its tokens
		App::import("Controller", "Sitelayouts");
		$Sitelayouts = new SitelayoutsController();
		$layoutMarkup = $Sitelayouts->getRenderedLayout($layout, $tag, $topic);
		$this->set('layoutContent', $layoutMarkup);
		$this->render('../layouts/content');
	}

	/*
	 * renders json object for all modules
	 */
	
	function _renderJSON($module, $tag, $topic = "", $options = array()) {
		//create an output array
		$json = array();
		
		//include Modules
		App::import("Controller", "Modules");
		$Modules = new ModulesController();
		$Modules->constructClasses();

		//get modules
		$modules = $module == "all"?$this->Module->find('list'):array($module);

		//traverse
		foreach($modules AS $module) {
			$name = $Modules->getModuleAlias($module);
			$json[$name] = array();
			$json = $Modules->getModuleJSON($module,$tag,$this->Topic->getTopicName($topic),$json, $options);
		}
		
		$this->set("json", $json);
		$this->layout = "json";
		$this->render('index');
	}
}

?>
