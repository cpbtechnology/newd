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

class TagsController extends AppController {

	var $name = 'Tags';
	var $helpers = array('Html', 'Form');
	var $components = array('Auth');
	/*
	 * gets the list of all tags
	 */

    function beforeFilter()
    {
		if($this->Session->read('Auth.User.changePassword')==1){
			$this->redirect(array('controller' => 'cpbadmin','action' => 'resetpassword'));
			exit();
		}
    }
	
	function getTags() {
		return $this->Tag->find('all');
	}

	function admin_index() {
		$this->layout = "admin";
		$this->set('activeTab','tags');
		$this->Tag->recursive = 0;
		$this->set('tags', $this->paginate());
	}
	
	function admin_view($id = null) {
		$this->layout = "admin";
		$this->set('activeTab','tags');
		if (!$id) {
			$this->Session->setFlash(__('Invalid Tag.', true));
			$this->redirect(array('controller' => 'tags','action' => 'admin_index'));
		}
		$this->set('tag', $this->Tag->read(null, $id));
	}

	function admin_add() {
		$this->layout = "admin";
		$this->set('activeTab','tags');
		if (!empty($this->data)) {
			$this->Tag->create();
			if ($this->Tag->save($this->data)) {
				$this->Session->setFlash(__('The Tag has been saved', true));
				$this->redirect(array('controller' => 'tags','action' => 'admin_index'));
			} else {
				$this->Session->setFlash(__('The Tag could not be saved. Please, try again.', true));
			}
		}
	}

	function admin_edit($id = null) {
		$this->layout = "admin";
		$this->set('activeTab','tags');
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Tag', true));
			$this->redirect(array('controller' => 'tags','action' => 'admin_index'));
		}
		if (!empty($this->data)) {
			if ($this->Tag->save($this->data)) {
				$this->Session->setFlash(__('The Tag has been saved', true));
				$this->redirect(array('controller' => 'tags','action' => 'admin_index'));
			} else {
				$this->Session->setFlash(__('The Tag could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Tag->read(null, $id);
		}
		//$tags = $this->Tag->Tag->find('list');
		//$this->set(compact('tags'));
	}

	function admin_delete($id = null) {
		$this->layout = "admin";
		$this->set('activeTab','tags');
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Tag', true));
			$this->redirect(array('controller' => 'tags','action' => 'admin_index'));
		}
		if ($this->Tag->del($id)) {
			$this->Session->setFlash(__('Tag deleted', true));
			$this->redirect(array('controller' => 'tags','action' => 'admin_index'));
		}
	}
}
?>