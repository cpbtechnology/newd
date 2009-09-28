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

class BingnewsSource extends DataFeed{
  
  var $xml;
  var $config;
 
    var $description = "Bing RSS Feed";
  
	function __construct($config=null) {
		if($config != null) {
			parent::__construct($config);
		}
	}
    
	/*
	 * @action search
	 * 
	 * @param $search - Keywords to search for
	 * @param $maxresults - Requests per page
	 * @param $offset - Current page
	 * @param $sortby - Not Used - Reserved for future use
	 */
	
	function search($search, $maxresults=20, $offset=1, $sortby='relevance') {
		$urlSearch = urlencode($search);
		$feedUrl = 'http://www.bing.com/news/search?q='.$urlSearch.'&FORM=BNFD&format=rss';
		$return = array();
		$item = array();
		$doc = new DOMDocument();
		if ($doc->load($feedUrl)) {
			foreach ($doc->getElementsByTagName('item') as $node) {

				$datePublished = strtotime($node->getElementsByTagName('pubDate')->item(0)->nodeValue);
				$description = $node->getElementsByTagName('description')->item(0)->nodeValue;
				$thumb = "";
				$description = $node->getElementsByTagName('description')->item(0)->nodeValue;
				$regexp = "<img\s[^>]*src=(\"??)([^\" >]*?)\\1[^>]*>(.*)\/>";
				if(preg_match_all("/$regexp/siU", $description, $matches, PREG_SET_ORDER)) {
					$thumb = $matches[0][2];
				}
				$full_title = $node->getElementsByTagName('title')->item(0)->nodeValue;
				$divider_pos = strrpos($full_title,"-");
				$title = trim(substr($full_title,0,$divider_pos));
				$author = trim(substr($full_title,$divider_pos+1));
				$item["id"] = $node->getElementsByTagName('link')->item(0)->nodeValue;
				$item["published"] = date("Y-m-d H:i:s", $datePublished);
				$item["content"] = strip_tags($description);
				$item["thumbnail"] = $thumb;
				$item["title"] = $title;
				$item["author"] = $author;
				$item["rating"] = 0;
				$return[] = $item;
			}		
		} else {
			$this->log('Unable to parse Bing RSS.');
		}
		return $return;
	}
    
}
 
?> 