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

class BlogsSource extends DataFeed{
  
	var $xml;
	var $config;
 
    var $description = "Google Blogs RSS Feed";
  
	function __construct($config=null) {
		if($config != null) {
			parent::__construct($config);
		}
	}
    
	function search($search, $maxresults=5, $offset=1, $sortby='relevance') {
		$urlSearch = urlencode($search);
		$feedUrl = 'http://blogsearch.google.com/blogsearch_feeds?hl=en&oi=rss&q='.$urlSearch.'&ie=utf-8&num='.$maxresults.'&output=rss';
		$sxml = simplexml_load_file($feedUrl);
		$return = array();
		$item = array();
		if ($sxml && !empty($sxml->channel->item)) {
			foreach ($sxml->channel->item as $node) {
				$dc = $node->children('http://purl.org/dc/elements/1.1/');
				$datePublished = strtotime($dc->date);
				$item["id"] = $node->link;
				$item["published"] = date("Y-m-d H:i:s", $datePublished);
				$item["content"] = strip_tags($node->description);
				$item["thumbnail"] = "none";
				$item["title"] = $node->title;
				$item["author"] = $dc->creator;
				$item["rating"] = 0;
				$return[] = $item;
			}
		}
		return $return;
	}
    
}
 
?> 