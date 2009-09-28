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

class Datarow extends AppModel {

	var $name = 'Datarow';
	var $validate = array(
		'datafeed_id' => array('numeric'),
		'rating' => array('numeric')
	);
	var $uses = array('Datafeed');
	 
	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
		'Datafeed' => array(
			'className' => 'Datafeed',
			'foreignKey' => 'datafeed_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	
	//deletes 1 week old rows
	function deleteOld($datafeed_id) {
		$sql = "SELECT count(*) AS toDelete FROM datarows WHERE datafeed_id=$datafeed_id AND modified < DATE_SUB(now(), INTERVAL 1 WEEK)";
		$result = mysql_fetch_assoc(mysql_query($sql));
		if ($result["toDelete"]>0) {
			$this->log('NOTICE',"Deleteing ".$result["toDelete"]);
			$sql = "DELETE FROM datarows WHERE datafeed_id=$datafeed_id AND modified < DATE_SUB(now(), INTERVAL 1 WEEK)";
			$this->query($sql);
		}
	}
	
	function resetRatings($datafeed_id) {
		$this->updateAll(array('rating'=>0),array('datafeed_id'=>$datafeed_id));
	}

	function log($type,$msg) {
		echo date("Y-m-d H:i:s")." - [$type] $msg"."\n";
	}
	
	function getFeaturedRow($module,$topic) {
		$conditions = array(  
		   'AND' => array( 
				'Datafeed.name' => $module,
				'Datarow.topicName' => $topic,
				'Datarow.flagged' => 'true'
		   )  
		);
		return $this->find('first', array('limit' => 1, 'conditions' => $conditions));
	}
	
	function getFeaturedRowExcept($module,$topic,$id) {
		$conditions = array(  
		   'AND' => array( 
				'Datafeed.name' => $module, 
				'Datarow.topicName' => $topic,
				'Datarow.flagged' => 'true',
				'Datarow.articleId <>' => $id,
		   )  
		);
		return $this->find('first', array('limit' => 1, 'conditions' => $conditions));
	}
	
	function getRows($module,$tag='',$topic='',$options) {
		
		if($module == "jobs")//just for Jobs as only belongs to CPB
			$topic = "crispin porter";
		
		$criteria = $module == "youtube"?"rating":"published";
		$featured = $module == "youtube"?$this->getFeaturedRow($module,$topic):false;
		
		if($topic!="") {
			$regular = $this->getRowsByTopic($module,$topic,$options,$criteria);
		}
		else {
			$regular = $this->getRowsByTag($module,$tag,$options,$criteria);
		}
		
		if($featured) {array_unshift($regular,$featured);}
		//echo "<pre>";print_r($regular);echo "</pre>";
		return $regular;
	}
	
	function getRowsExcept($module,$topic,$id,$sort_column,$limit) {
		$conditions = array(  
		   'AND' => array(  
			  'Datafeed.name' => $module,
			  'Datarow.topicName' => $topic,
			  'Datarow.articleId <>' => $id,
		   ) 
		);
		return $this->find('all', array('limit' => $limit, 'conditions' => $conditions,'group' => 'Datarow.ArticleId','order' => "Datarow.$sort_column desc"));
	}
	
	function getFilter($module) {
		//get sources
		$feeds = $this->Datafeed->getFeed($module);
		
		if($feeds["Datafeed"]["sources"]!="") {
			//var_dump($feeds["Datafeed"]["sources"]);exit();
			$sources = explode(",",$feeds["Datafeed"]["sources"]);
			$filter = array(array('Datarow.datafeed_id'=>$feeds["Datafeed"]["id"]));
			foreach($sources AS $source) {
				array_push($filter,array('Datarow.datafeed_id'=>$source));
			}
			return array('OR'=>$filter);
		}
		else {
			return array('Datafeed.name' => $module);
		}
	}
	
	function getRowsByTag($module,$tag,$options,$criteria) {
		
		//get options
		$limit = isset($options["limit"])?$options["limit"]:12;
		$offset = isset($options["offset"])?$options["offset"]:0;
		$since = isset($options["since"])?array('Datarow.published >=' => date("Y-m-d H:i:s",round($options["since"]/1000))):false; //array('Datarow.published >=' => date("Y-m-d H:i:s"));
		
		//special cases
		if($module == "queue") {$limit=36;}
		
		$filter = $this->getFilter($module);
		
		$and_arr = array(  
			$filter,
			'Datarow.tags LIKE' => '%' . $tag . '%',
			'Datarow.rating >=' => 0
		);
		   
		if($since){array_push($and_arr,$since);}
		
		$conditions = array(  
		   'AND' => $and_arr  
		);
		
		//$start = $offset;
		//$end = $start+$limit;
		
		if($module == "featured"){return $this->getRowsForBubble($module,$topic);}
		return $this->find('all', array('limit' => "$offset,$limit", 'conditions' => $conditions,'group' => 'Datarow.ArticleId','order' => "Datarow.$criteria desc"));
	}
	
	function getRowsByTopic($module,$topic,$options,$criteria) {
		
		//get options
		$limit = isset($options["limit"])?$options["limit"]:12;
		$offset = isset($options["offset"])?$options["offset"]:0;
		$since = isset($options["since"])?array('Datarow.published >=' => date("Y-m-d H:i:s",round($options["since"]/1000))):false; //array('Datarow.published >=' => date("Y-m-d H:i:s"));

		//special cases
		if($module == "queue") {$limit=36;}
		
		$filter = $this->getFilter($module);
		
		$and_arr = array(  
			$filter,
			'Datarow.topicName' => $topic,
	 		'Datarow.rating >=' => 0
		);
		
		if($since){array_push($and_arr,$since);}
		
		$conditions = array(  
		   'AND' => $and_arr 
		);
		
		if($module == "featured"){return $this->getRowsForBubble($module,$topic);}
		return $this->find('all', array('limit' => "$offset,$limit", 'conditions' => $conditions, 'group' => 'Datarow.articleId', 'order' => "Datarow.$criteria desc"));
	}
	
	function getRowsForBubble($module,$topic) {
		
		$filter = $this->getFilter($module);
		
		$conditions = array( 
			'AND' => array(
				$filter,
				'Datarow.topicName' => $topic,
			)
		);
		return $this->find('all',array('conditions' => $conditions));
	}
	
	function getRowsForMobile($topic,$scope,$sort_column,$limit) {
		return $this->find(
			'all',
			array(
				'limit'=>$limit,
				'conditions'=>array(
					'AND'=>array(
						$scope,
						'Datarow.topicName' => $topic,
					)
				),
				'group' => 'Datarow.ArticleId',
				'order' => "Datarow.$sort_column DESC" 
			)
		);
	}
	
	function getRowsToPush($moduleArray,$tag) {
		$conditions = array(  
		   'AND' => array(  
			  array('Datarow.datafeed_id' => $moduleArray['Module']['datafeed_id']),
			  array('Datarow.content LIKE' => '%' . $tag . '%')
		   )  
		);
		return $this->find('all', array('conditions' => $conditions));
	
	}
}
?>