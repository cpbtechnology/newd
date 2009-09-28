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

class YoutubeSource extends DataFeed {
  
  var $xml;
  var $config;
 
    var $description = "Youtube data API";
  
    function __construct($config=null) {
		if($config != null) {
		   parent::__construct($config);
		}
    }
    
	function search($search, $maxresults=20, $offset=1, $sortby='relevance') {
		$urlSearch = urlencode($search);
		$feedUrl = 'http://gdata.youtube.com/feeds/api/videos?vq='.$urlSearch.'&orderby='.$sortby.'&start-index='.$offset.'&max-results='.$maxresults;
		$sxml = simplexml_load_file($feedUrl);
		$return = array();
		$item = array();
		foreach ($sxml->entry as $entry) {
			// get nodes in media: namespace for media information
			$media = $entry->children('http://search.yahoo.com/mrss/');
			$id = substr($entry->id, strpos($entry->id,'videos/')+7, strlen($entry->id));
			$currentDate = date("Y-m-d H:i:s");
			$start_ts = strtotime($entry->published);
			$end_ts = strtotime($currentDate);
			$diff = $end_ts - $start_ts;
			$dateDiff = round($diff / 86400);
			$gt = $entry->children('http://gdata.youtube.com/schemas/2007');
			$viewCount = 0;
			if($gt->statistics){
				$stAttrs = $gt->statistics->attributes();
				$viewCount = intval($stAttrs['viewCount']);
			}
			$rateVideo = 0;
			if($viewCount>$dateDiff && $dateDiff!=0){
				$rateVideo = round($viewCount/pow($dateDiff,2),2);
			}
			$content = "Embedding disabled by request";
			if($media->group->content){
				$attrs = $media->group->content->attributes();
				if(strstr($attrs['url'], "f=videos")){
					$content = $attrs['url'];					
				}
			}
			$attrs = $media->group->thumbnail[0]->attributes();
			$item["id"] = $id;
			$item["published"] = date("Y-m-d H:i:s", strtotime($entry->published));
			$item["updated"] = date("Y-m-d H:i:s", strtotime($entry->updated));
			$item["content"] = $content;
			$item["thumbnail"] = $attrs['url'];
			$item["title"] = $media->group->title;
			$item["description"] = $media->group->description;
			$item["author"] = $entry->author->name;
			$item["rating"] = $rateVideo;
			$return[] = $item;
		}
		return $return;
	}
    
}
 
?> 