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

abstract class DatasourceCrawler
{
	var $maxResults = 10;
	var $uses = array('Datarow', 'Datafeed', 'Tag', 'Block');
	abstract function __construct();

	// Return common datarow array 
	abstract function crawlFeed($updatedSince = '', $tag = '');
	
	function insertDatarows($updatedSince = '', $tag = '', $datafeed = '', $datafeedId, $results){
		error_reporting(0);
		$this->checkMemUsage($datafeed);
		$rowsmodel = new Datarow();
		$tags = new Tag();
		$dataRows = array();
		$count = 0;
		if (is_array($results) && count($results) > 0) {
			foreach ($results as $result) {
				$id = (string)$result["id"];
				$content = (string)$result["content"];
				$author = (string)$result["author"];
				$blocked = $datafeed=="youtube"?$this->isVideoBlocked($id, $datafeedId):$this->isBlocked($content, $datafeedId, $author);
				if(!$blocked && $content!="Embedding disabled by request") {
					$datarowId = $this->checkDatarowOnDB($rowsmodel, $id, $datafeedId);
					if(sizeof($datarowId['Datarow'])==0){
						$topicName = $this->getTopicName($tags, $tag);
						$row = array(
							'datafeed_id' => $datafeedId,
							'topicName' => $topicName,
							'published' => (string)$result["published"],
							'articleId' => $id,
							'title' => (string)$result["title"],
							'content' => $content,
							'thumb' => (string)$result["thumbnail"],
							'author' => $author,
							'cpbTags' => $this->formatTag($tag),
							'tags' => $this->formatTag($tag),
							'rating' => (int)$result["rating"]
						);
						array_push($dataRows, $row);
						$rowsmodel->create();
						if (!$rowsmodel->save($row)) {
							echo "ERROR: Unable to update last modified time for feed\n";
							$this->log("ERROR: Unable to update last modified time for feed\n");
						}
					}else{
						if($datafeed=="youtube"){
							$this->updateRating($rowsmodel, $datarowId, $result["title"], $result["rating"]);
							$count++;
						}
					
					}
				}
			}
		}
		if($count>0) {
			$this->clog("$count updated",'NOTICE');
		}
		unset($rowsmodel);
		unset($tags);
		unset($results);			
		return $dataRows;
	}
	
	function getFreshness($timestamp = '') {
		if ($timestamp == '') {
			// Default to past week
			return strtotime(date("Y-m-d",mktime(date("H"),date("i"),date("s"),date("n") - 7,date("j"), date("Y"))));
		}
		return strtotime($timestamp);
	}
	
	function parseTimestamp($timestamp) {
		return date("Y-m-d H:i:s", strtotime($timestamp));
	}
	
	function formatTag($tag) {
		return '"' . str_replace('"', "'", $tag) . '"';
	}

	function clog($msg, $level = 'INFO') {
		echo date("Y-m-d H:i:s")." - [$level] $msg"."\n";
	}
	function checkMemUsage($datafeed){
		$mem_usage = memory_get_usage();
		if($mem_usage > Configure::read('maximum_crawler_memory')) {
			$this->clog("Crawler has reached ($mem_usage) threshhold and will restart!");
			$this->restart($datafeed);
			exit();
		}
	}
	function isBlocked($content, $datafeedId, $author){
		$conditions = array(
			'Block.datafeed_id'=>$datafeedId
		);
		
		$blocksmodel =& ClassRegistry::init('Block');
		$query_result = $blocksmodel->find('all',array('conditions'=>$conditions));
		
		$blocked = false;
		for($i=0;$i<sizeof($query_result); $i++){
			if(strpos($content,$query_result[$i]["Blocke"]["uniqueIdentifier"])!== false || strpos($author,$query_result[$i]["Block"]["uniqueIdentifier"])!== false) {
				$blocked = true;
				//log
				$this->clog("Blocked[".$query_result[$i]["Block"]["uniqueIdentifier"]."][".$author."]","NOTICE");					
			}
		}
		return $blocked;
	}
	function isVideoBlocked($id, $datafeedId){
		$conditions = array(
			'AND'=>array(
				'Block.datafeed_id'=>$datafeedId,
				'Block.uniqueIdentifier LIKE'=>"'%".$id."%'"
			)
		);
		$blocksmodel =& ClassRegistry::init('Block');
		$query_result = $blocksmodel->find('all',array('limit'=>1,'conditions'=>$conditions));
		$blocked = sizeof($query_result)==1?true:false;
		if($blocked) {
			$this->clog("Blocked[".$id."]", 'NOTICE');
		}
		return $blocked;
	}
	function checkDatarowOnDB($rowsmodel, $id, $datafeedId){
		$conditions = array(  
			'AND' => array(  
				array('Datarow.datafeed_id' => $datafeedId),
				array('Datarow.articleId' => $id)
			)  
		);			
		return $rowsmodel->find('first', array('conditions' => $conditions));
	}
	function updateRating($rowsmodel, $datarowId, $title, $rating){
		$rowsmodel->create();
		$rowsmodel->id = $datarowId['Datarow']['id'];
		if($datarowId['Datarow']['rating']!=$rating) {
			$this->clog("Title[".$title."] Old rating: [".$datarowId['Datarow']['rating']."] New rating: [".$rating."]",'NOTICE');
			$row = array(
				'rating'=>$rating,
				'modified'=>date("Y-m-d H:i:s"),
				'blocked'=>$datarowId['Datarow']['blocked']
			);
			if (!$rowsmodel->save($row)) {
				$this->clog("Unable to update last modified time for feed","ERROR");
			}
			
		}
	}
	function getTopicName($tags, $tag){
		$tagName = $tags->find('first', array('conditions' => array('Tag.name' => $tag)));
		$topicName = "";
		if(sizeof($tagName['Topic'])>0){
			$topicName = $tagName['Topic']['name'];
		}
		return $topicName;
	}
	//restarts crawler
	function restart($name) {
		$log_path = ROOT.DS.APP_DIR.DS."tmp".DS."logs".DS."crawler_log_$name";
		system(ROOT.DS."cake".DS."console".DS."cake -app ".ROOT.DS.APP_DIR.DS." datafeed_daemon main $name > $log_path 2>&1 &",$return);
	}
	
}
?>
