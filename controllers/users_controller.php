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

class UsersController extends AppController
{
    var $name = "Users";
    var $helpers = array('Html', 'Form');
	var $components = array('Auth');
    
	
    function index()
    {
        
    }
    
    function beforeFilter()
    {
		if($this->Session->read('Auth.User.changePassword')==1){
			$this->redirect(array('controller' => 'cpbadmin','action' => 'resetpassword'));
			exit();
		}	
        //$this->__validateLoginStatus();
    }
    
    function login()
    {
		$this->layout = "login";
		$this->render();

        if(empty($this->data) == false)
        {
            if(($user = $this->User->validateLogin($this->data['User'])) == true)
            {
				
				$this->Session->write('User', $user);
				$this->Session->setFlash('You\'ve successfully logged in.');
				$this->redirect(array('controller' => 'cpbadmin','action' => 'index'));
				exit();
            }
            else
            {
                $this->Session->setFlash('Sorry, the information you\'ve entered is incorrect.');
				$this->redirect(array('controller' => 'users','action' => 'login'));
                exit();
            }
        }
    }
    function logout()
    {
        $this->Session->destroy('user');
        $this->Session->setFlash('You\'ve successfully logged out.');
        $this->redirect(array('controller' => 'users','action' => 'login'));
    }
        
    function __validateLoginStatus()
    {
        if($this->action != 'login' && $this->action != 'logout')
        {

            if($this->Session->check('User') == false)
            {

                $this->redirect(array('controller' => 'users','action' => 'login'));
                $this->Session->setFlash('The URL you\'ve followed requires you login.');
            }
        }
    }
	function admin_index() {
		$this->layout = "admin";
		$this->set('activeTab','users');
		$this->User->recursive = 0;
		$this->set('users', $this->paginate());
	}
	
	function admin_view($id = null) {
		$this->layout = "admin";
		$this->set('activeTab','users');
		if (!$id) {
			$this->Session->setFlash(__('Invalid User.', true));
			$this->redirect(array('controller' => 'users','action' => 'admin_index'));
		}
		$this->set('user', $this->User->read(null, $id));
	}

	function admin_add() {
		$this->layout = "admin";
		$this->set('activeTab','users');
		if (!empty($this->data)) {
			$this->User->create();
			if ($this->User->save($this->data)) {
				$this->Session->setFlash(__('The User has been saved', true));
				$this->redirect(array('controller' => 'users','action' => 'admin_index'));
			} else {
				$this->Session->setFlash(__('The User could not be saved. Please, try again.', true));
			}
		}
	}

	function admin_edit($id = null) {
		$this->layout = "admin";
		$this->set('activeTab','users');
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid User', true));
			$this->redirect(array('controller' => 'users','action' => 'admin_index'));
		}
		if (!empty($this->data)) {
			if ($this->User->save($this->data)) {
				$this->Session->setFlash(__('The User has been saved', true));
				$this->redirect(array('controller' => 'users','action' => 'admin_index'));
			} else {
				$this->Session->setFlash(__('The User could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->User->read(null, $id);
		}
	}

	function admin_delete($id = null) {
		$this->layout = "admin";
		$this->set('activeTab','users');
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for User', true));
			$this->redirect(array('controller' => 'users','action' => 'admin_index'));
		}
		if ($this->User->del($id)) {
			$this->Session->setFlash(__('User deleted', true));
			$this->redirect(array('controller' => 'users','action' => 'admin_index'));
		}
	}
	
    
}

?>