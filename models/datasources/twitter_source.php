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

class TwitterSource extends DataFeed{

	var $xml;
	var $config;

	var $description = "Twitter RSS Feed";
 
    function __construct($config) { 
		if($config != null) {
			parent::__construct($config);
		}
    } 
	
	/*
	 * @action search
	 * 
	 * @param $search - Keywords to search for
	 * @param $language - Language abbreviation
	 * @param $rpp - Requests per page
	 */

    function search($search, $language = 'en', $rpp = '10'){ 

		$return = array();
		$item = array();

        $feedUrl = "http://search.twitter.com/search.atom?q=" . urlencode($search) . "&lang=$language&rpp=$rpp"; 
		libxml_use_internal_errors(true);

		$sxml = simplexml_load_file($feedUrl);			

		if ($sxml && !empty($sxml->entry)) {

			foreach ($sxml->entry as $node) {
				$attrs_0 = $node->link[0]->attributes();
				$attrs_1 = $node->link[1]->attributes();
				$datePublished = strtotime($node->published);
				$author = explode(' ', $node->author[0]->name);
				$content = htmlentities($node->content);
				
				$item["id"] = $attrs_0['href'];
				$item["published"] = date("Y-m-d H:i:s", $datePublished);
				$item["content"] = $node->title;
				$item["thumbnail"] = $attrs_1['href'];
				$item["title"] = $node->title;
				$item["author"] = $node->author[0]->name;
				$item["rating"] = calculateDatarowRating(formatTag($search),$node->title,$author[0]);
				$return[] = $item;
			}			
		} else {
			$this->log('Unable to parse twitter XML.');
		}
		return $return;
    } 

} 
?> 