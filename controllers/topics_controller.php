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

class TopicsController extends AppController {

	var $name = 'Topics';
	var $helpers = array('Html', 'Form');
	var $components = array('Auth');
	
    function beforeFilter()
    {
		if($this->Session->read('Auth.User.changePassword')==1){
			$this->redirect(array('controller' => 'cpbadmin','action' => 'resetpassword'));
			exit();
		}
    }
	
	function getTopicAbbreviation() {
		return $this->Topic->find('all');
	}
	
	function admin_index() {
		$this->layout = "admin";
		$this->set('activeTab','topics');
		$this->Topic->recursive = 0;
		$this->set('topics', $this->paginate());
	}
	
	function admin_view($id = null) {
		$this->layout = "admin";
		$this->set('activeTab','topics');
		if (!$id) {
			$this->Session->setFlash(__('Invalid Topic.', true));
			$this->redirect(array('controller' => 'topics','action' => 'admin_index'));
		}
		$this->set('topic', $this->Topic->read(null, $id));
	}

	function admin_add() {
		$this->layout = "admin";
		$this->set('activeTab','topics');
		if (!empty($this->data)) {
			$this->Topic->create();
			if ($this->Topic->save($this->data)) {
				$this->Session->setFlash(__('The Topic has been saved', true));
				$this->redirect(array('controller' => 'topics','action' => 'admin_index'));
			} else {
				$this->Session->setFlash(__('The Topic could not be saved. Please, try again.', true));
			}
		}
		//$tags = $this->Topic->Tag->find('list');
		//$this->set(compact('tags'));
	}

	function admin_edit($id = null) {
		$this->layout = "admin";
		$this->set('activeTab','topics');
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Topic', true));
			$this->redirect(array('controller' => 'topics','action' => 'admin_index'));
		}
		if (!empty($this->data)) {
			if ($this->Topic->save($this->data)) {
				$this->Session->setFlash(__('The Topic has been saved', true));
				$this->redirect(array('controller' => 'topics','action' => 'admin_index'));
			} else {
				$this->Session->setFlash(__('The Topic could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Topic->read(null, $id);
		}
		//$tags = $this->Topic->Tag->find('list');
		//$this->set(compact('tags'));
	}

	function admin_delete($id = null) {
		$this->layout = "admin";
		$this->set('activeTab','topics');
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Topic', true));
			$this->redirect(array('controller' => 'topics','action' => 'admin_index'));
		}
		if ($this->Topic->del($id)) {
			$this->Session->setFlash(__('Topic deleted', true));
			$this->redirect(array('controller' => 'topics','action' => 'admin_index'));
		}
	}
}
?>