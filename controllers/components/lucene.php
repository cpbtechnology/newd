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

set_include_path(get_include_path().PATH_SEPARATOR.ROOT . DS . APP_DIR . DS . 'vendors');
App::import('vendor', 'Lucene', array('file'=>'Zend/Search/Lucene.php'));
class LuceneComponent extends Object
{
		var $index;
	
    function startup(&$controller)
    {
        $this->controller = $controller;
    }
    
    // Get the index object 
    function &getIndex() { 
        if(!$this->index) { 
            $this->index = new Zend_Search_Lucene(TMP . 'cache' . DS . 'index'); 
        } 
        
        return $this->index; 
    } 
     
    // Executes a query to the index and returns the results 
    function query($query) { 
        $index =& $this->getIndex(); 
     
        $results = $index->find($query); 
        return $results; 
    } 
}
?>