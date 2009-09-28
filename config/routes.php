<?php
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

Router::parseExtensions();
Router::connect('/pages/:action',array('controller' => 'front','action' => ':action'));
Router::connect('/topics/:topic',array('controller' => 'front','action' => 'index'));
Router::connect('/topics/:topic/update/:module',array('controller' => 'front','action' => 'update','module' => ':module'));
Router::connect('/topics/:topic/more/:module/:limit/:offset',array('controller' => 'front','action' => 'more','module' => ':module'));

//mobile
Router::connect('/mobile/*',array('controller' => 'front','action' => 'mobile'));
//Admin
Router::connect('/admin/',array('controller' => 'cpbadmin','action' => 'index'));
Router::connect('/admin/login/',array('controller' => 'users','action' => 'login'));
Router::connect('/admin/resetpassword/',array('controller' => 'cpbadmin','action' => 'resetpassword'));
Router::connect('/admin/logout/',array('controller' => 'users','action' => 'logout'));
Router::connect('/admin/topics/view/*',array('controller' => 'topics','action' => 'admin_view'));
Router::connect('/admin/topics/edit/*',array('controller' => 'topics','action' => 'admin_edit'));
Router::connect('/admin/topics/add/*',array('controller' => 'topics','action' => 'admin_add'));
Router::connect('/admin/topics/delete/*',array('controller' => 'topics','action' => 'admin_delete'));
Router::connect('/admin/topics/*',array('controller' => 'topics','action' => 'admin_index'));
Router::connect('/admin/tags/view/*',array('controller' => 'tags','action' => 'admin_view'));
Router::connect('/admin/tags/edit/*',array('controller' => 'tags','action' => 'admin_edit'));
Router::connect('/admin/tags/add/*',array('controller' => 'tags','action' => 'admin_add'));
Router::connect('/admin/tags/delete/*',array('controller' => 'tags','action' => 'admin_delete'));
Router::connect('/admin/tags/*',array('controller' => 'tags','action' => 'admin_index'));
Router::connect('/admin/datafeeds/view/*',array('controller' => 'datafeeds','action' => 'admin_view'));
Router::connect('/admin/datafeeds/edit/*',array('controller' => 'datafeeds','action' => 'admin_edit'));
Router::connect('/admin/datafeeds/add/*',array('controller' => 'datafeeds','action' => 'admin_add'));
Router::connect('/admin/datafeeds/delete/*',array('controller' => 'datafeeds','action' => 'admin_delete'));
Router::connect('/admin/datafeeds/*',array('controller' => 'datafeeds','action' => 'admin_index'));
Router::connect('/admin/modules/view/*',array('controller' => 'modules','action' => 'admin_view'));
Router::connect('/admin/modules/edit/*',array('controller' => 'modules','action' => 'admin_edit'));
Router::connect('/admin/modules/add/*',array('controller' => 'modules','action' => 'admin_add'));
Router::connect('/admin/modules/delete/*',array('controller' => 'modules','action' => 'admin_delete'));
Router::connect('/admin/modules/*',array('controller' => 'modules','action' => 'admin_index'));
Router::connect('/admin/datarows/view/*',array('controller' => 'datarows','action' => 'admin_view'));
Router::connect('/admin/datarows/edit/*',array('controller' => 'datarows','action' => 'admin_edit'));
Router::connect('/admin/datarows/add/*',array('controller' => 'datarows','action' => 'admin_add'));
Router::connect('/admin/datarows/delete/*',array('controller' => 'datarows','action' => 'admin_delete'));
Router::connect('/admin/datarows/*',array('controller' => 'datarows','action' => 'admin_index'));
Router::connect('/admin/blocks/view/*',array('controller' => 'blocks','action' => 'admin_view'));
Router::connect('/admin/blocks/edit/*',array('controller' => 'blocks','action' => 'admin_edit'));
Router::connect('/admin/blocks/add/*',array('controller' => 'blocks','action' => 'admin_add'));
Router::connect('/admin/blocks/delete/*',array('controller' => 'blocks','action' => 'admin_delete'));
Router::connect('/admin/blocks/*',array('controller' => 'blocks','action' => 'admin_index'));
Router::connect('/admin/users/view/*',array('controller' => 'users','action' => 'admin_view'));
Router::connect('/admin/users/edit/*',array('controller' => 'users','action' => 'admin_edit'));
Router::connect('/admin/users/add/*',array('controller' => 'users','action' => 'admin_add'));
Router::connect('/admin/users/delete/*',array('controller' => 'users','action' => 'admin_delete'));
Router::connect('/admin/users/*',array('controller' => 'users','action' => 'admin_index'));


Router::connect('/',array('controller' => 'front','action' => 'index'));

?>