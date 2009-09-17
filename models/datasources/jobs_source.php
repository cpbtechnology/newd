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

class JobsSource extends DataFeed{
  
  var $xml;
  var $config;
 
    var $description = "Jobs RSS Feed";
  
	function __construct($config=null) {
		if($config != null) {
			parent::__construct($config);
		}
	}
    
	function search($search, $maxresults=20, $offset=1, $sortby='relevance') {
		$urlSearch = urlencode($search);
		$feedUrl = 'http://www.jobvite.com/CompanyJobs/Xml.aspx?c='.$urlSearch;
		$sxml = simplexml_load_file($feedUrl, 'SimpleXMLElement', LIBXML_NOCDATA);
		$return = array();
		$item = array();
		if ($sxml && !empty($sxml->job)) {
			foreach ($sxml->job as $node) {
				$articleId = $node->id;
				$articleId .= !empty($node->requisitionId)?",".$node->requisitionId:"";
				$applyUrl = (string)$node->{'apply-url'};
				$detailUrl = (string)$node->{'detail-url'};
				$datePublished = strtotime($node->date);
				$content = (string)$node->description;
				$content .= $applyUrl!=""?"<div><a href='".$applyUrl."'>Apply</a></div>":"";
				$content .= $detailUrl!=""?"<div><a href='".$detailUrl."'>See details</a></div>":"";
				
				$item["id"] = $articleId;
				$item["published"] = date("Y-m-d H:i:s", $datePublished);
				$item["content"] = $content;
				$item["thumbnail"] = (string)$node->jobtype;
				$item["title"] = (string)$node->title;
				$item["author"] = (string)$node->category;
				$item["rating"] = 0;
				$return[] = $item;
			}
		}
		return $return;
	}

}
 
?> 