<?php
// Copyright 2009, Crispin Porter + Bogusky

class BlocksController extends AppController {

	var $name = 'Blocks';
	var $helpers = array('Html', 'Form');
	var $components = array('Auth');
	
    function beforeFilter()
    {
		if($this->Session->read('Auth.User.changePassword')==1){
			$this->redirect(array('controller' => 'cpbadmin','action' => 'resetpassword'));
			exit();
		}
    }

	function admin_index() {
		$this->layout = "admin";
		$this->set('activeTab','blocks');
		$this->Block->recursive = 0;
		$this->set('blocks', $this->paginate());
	}
	
	function admin_view($id = null) {
		$this->layout = "admin";
		$this->set('activeTab','blocks');
		if (!$id) {
			$this->Session->setFlash(__('Invalid Block.', true));
			$this->redirect(array('controller' => 'blocks','action' => 'admin_index'));
		}
		$this->set('block', $this->Block->read(null, $id));
	}

	function admin_add() {
		$this->layout = "admin";
		$this->set('activeTab','blocks');
		if (!empty($this->data)) {
			$this->Block->create();
			if ($this->Block->save($this->data)) {
				$this->Session->setFlash(__('The Block has been saved', true));
				$this->redirect(array('controller' => 'blocks','action' => 'admin_index'));
			} else {
				$this->Session->setFlash(__('The Block could not be saved. Please, try again.', true));
			}
		}
	}

	function admin_edit($id = null) {
		$this->layout = "admin";
		$this->set('activeTab','blocks');
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Block', true));
			$this->redirect(array('controller' => 'blocks','action' => 'admin_index'));
		}
		if (!empty($this->data)) {
			if ($this->Block->save($this->data)) {
				$this->Session->setFlash(__('The Block has been saved', true));
				$this->redirect(array('controller' => 'blocks','action' => 'admin_index'));
			} else {
				$this->Session->setFlash(__('The Block could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Block->read(null, $id);
		}
	}

	function admin_delete($id = null) {
		$this->layout = "admin";
		$this->set('activeTab','blocks');
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Block', true));
			$this->redirect(array('controller' => 'blocks','action' => 'admin_index'));
		}
		if ($this->Block->del($id)) {
			$this->Session->setFlash(__('Block deleted', true));
			$this->redirect(array('controller' => 'blocks','action' => 'admin_index'));
		}
	}
}
?>