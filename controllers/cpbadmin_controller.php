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

class CpbadminController extends AppController {

	var $name = 'Cpbadmin';
	var $helpers = array('Html', 'Form');	
	var $uses = array('Datarow', 'Datafeed', 'Tag', 'Topic', 'User');
	var $components = array('Auth');

    function beforeFilter()
    {
		//$this->Auth->allow('resetpassword');
    }
	function index() {
		if($this->Session->read('Auth.User.changePassword')==1){
			$this->redirect(array('action'=>'resetpassword'));
		}else{
		$this->set('activeTab','overview');	
		$this->layout = "admin";
		$this->render();
		}
	}
	function resetpassword(){
		$this->set('userid',$this->Session->read('Auth.User.id'));
		$this->layout = "resetpassword";
		if (!empty($this->data)) {
			if ($this->User->save($this->data)) {
				$this->Session->del('Auth.User.changePassword');
				$this->Session->write('Auth.User.changePassword', '0');
				$this->Session->setFlash(__('The User has been saved', true));
				$this->redirect(array('controller' => 'cpbadmin','action' => 'index'));
			} else {
				$this->Session->setFlash(__('Passwords do not match. Please, try again.', true));
			}
		}
			
	}
	function topics($action="") {
		$this->set('activeTab','topics');	
		
		if($action=="") {
			App::import("Controller", "Topics");
			$Topics = new TopicsController();
			$Topics->constructClasses();
			$Topics->admin_index();
		}
		
		
		$this->layout = "admin";
		$this->render();
	}
	
	
	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Datarow.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('datarow', $this->Admin->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Admin->create();
			if ($this->Admin->save($this->data)) {
				$this->Session->setFlash(__('The Admin has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Admin could not be saved. Please, try again.', true));
			}
		}
		$datafeeds = $this->Admin->find('list');
		$this->set(compact('datafeeds'));
	}

	function edit ($id = null){
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Admin', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Admin->id = $id;
		if(empty($this->data)){
			$this->set('datarow', $this->Admin->read());
		}else{
			if($this->Admin->save($this->data)){
				$this->Session->setFlash('The Admin has been saved', true);
				$this->redirect(array('action' => 'index'));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Admin->read(null, $id);
		}
	}
	
	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Admin', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Admin->del($id)) {
			$this->Session->setFlash(__('Admin deleted', true));
			$this->redirect(array('action'=>'index'));
		}
	}
	
	
	function edit_bubbles() {
		//1. retrieve object from Topic
		$myTopic = $this->data;
		//2. check that object contains info
		if($myTopic == null){
			//3. display error message
			$this->Session->setFlash(__('Invalid Topic', true));
			$this->redirect(array('action'=>'index'));
		}else{
			//4. try to save
			if($myTopic->save($this->data)){
				//6. render view
				$this->render($myTopic);
			}else{
				//5. display save error message
				$this->Session->setFlash(__('Save Failed', true));
				$this->redirect(array('action'=>'index'));
			}
		}
	}
	function edit_tags($dataresult = null) {
		//1. retrieve tags
		$dataresult = $this->data;
		//2. tags have been recieved
		if($dataresult == null){
			//3. display error
			$this->Session->setFlash(__('Invalid Tags', true));
			$this->redirect(array('action'=>'index'));
		}else{
			//4. display tags
			$this->render($dataresult);
		}
	}
}
	
?>