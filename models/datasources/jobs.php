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

require_once('controllers/datasource_crawler.php');

class Jobs extends DatasourceCrawler
{
	var $uses = array('Datarow', 'Datafeed');
	
	function __construct() {
	}

	function crawlFeed($updatedSince = '', $tag = '', $datafeedId = 0) {
		$rowsmodel = new Datarow();
		$rowsmodel->deleteAll(array('Datarow.datafeed_id' => $datafeedId));
		$this->Jobs =& ConnectionManager::getDataSource("jobs");
		$results = $this->Jobs->search($tag);
		return $this->insertDatarows($updatedSince, $tag, "jobs", $datafeedId, $results);
	}
}

$crawler = new Jobs();

?>