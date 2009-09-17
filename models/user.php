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

class User extends AppModel
{
    var $name = 'User';
	var $validate = array(
		'username' => array('alphanumeric'),
		'password' => array('alphanumeric')
	);

     function __construct()  
     {  
         parent::__construct();  
   
         $this->validate = array  
         (  
             /* snip other fields */  
             'ConfirmNewPassword' => array  
             (  
                 /* snip other rules */  
                 'match' =>  
                 array  
                 (  
                     'rule'          => 'validatePasswdConfirm',  
                     'required'      => true,  
                     'allowEmpty'    => false,  
                     'message'       => __('Passwords do not match', true)  
                 )  
             )  
         );  
     }
	 
     function validatePasswdConfirm($data)  
     {  
         if ($this->data['User']['NewPassword'] !== $data['ConfirmNewPassword'])  
         {  
             return false;  
         }  
         return true;  
     }  


	function beforeSave()  
	{  
		if (isset($this->data['User']['NewPassword']))  
		{  
			$this->data['User']['password'] =  
			Security::hash($this->data['User']['NewPassword'], null, true);  
			unset($this->data['User']['NewPassword']);  
		}  
		  
		if (isset($this->data['User']['ConfirmNewPassword']))  
		{  
			unset($this->data['User']['ConfirmNewPassword']);  
		}  
		   
		return true;  
	} 
    function validateLogin($data)
    {
        $user = $this->find(array('username' => $data['username'], 'password' => md5($data['password'])), array('id', 'username', 'changePassword'));
        if(empty($user) == false)
            return $user['User'];
        return false;
    }
    
}
?>