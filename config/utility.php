<?php
	
	/*
	 * Function designed to trim the text and append any chosen lineending
	 * $src - the text
	 * $line_length - length of each line
	 * $num_lines - number of lines allowed
	 * $line_ending - appends a provided line ending
	 */

	function excerpt($src,$line_length,$num_lines,$line_ending,$start_count=0) {
		$char_count = $start_count;
		$line_count = 0;
		$lines = array();
		$parts = explode(" ",$src);
		
		
		foreach($parts AS $part) {
			$new = $char_count + strlen(trim($part)) + 1;
			
			//unbreakable lines
			$unbreakable = strlen(trim($part))>$line_length?true:false;
			
			$lines[$line_count] = isset($lines[$line_count])?"$lines[$line_count] $part":"$part";
			
			if($new < $line_length || $unbreakable) {
				$char_count += strlen(trim($part)) + 1;
			}
			else {
				$char_count = 0;
				$line_count++;
			}
		}
		
		//echo $src."<br>";
		//print_r($lines);
		
		$output = "";
		for($j=0;$j<$num_lines;$j++) {if($j<count($lines)) {$output = $output==""?"$lines[$j]":"$output $lines[$j]";}}
		if($line_count >= $num_lines) {
			if(strlen($lines[$j-1])+strlen($line_ending)<$line_length) {$output .= $line_ending;}
			else {$output = substr($output,0,strlen($output)-strlen($line_ending)).$line_ending;}
		}
		
		return $output;
	}
	
	function formatTag($tag) {
		return '"' . str_replace('"', "'", $tag) . '"';
	}
	function calculateDatarowRating($tag,$content,$author) {
		$tag = str_replace("from:","",$tag);
		$tag = str_replace("\"'","\"",$tag);
		$tag = str_replace("'\"","\"",$tag);
		
		$parts = explode("\"",$tag);
		
		$positives = array();
		$negatives = array();
		
		foreach($parts AS $part) {
			if($part != "") {
				//negatives
				if(substr($part,0,1)=="-") {
					$check = explode(" ",$part);
					if(count($check)>1) {
						foreach($check AS $single) {
							array_push($negatives,str_replace("-","",$part));
						}
					}
					else {
						array_push($negatives,str_replace("-","",$part));
					}
				}
				else {
					//array_push($positives,$part);
					
					if(strpos($part,"-") !== false) {
						$check = explode(" ",$part);
						if(count($check)>1) {
							foreach($check AS $single) {
								if(substr($single,0,1) == "-") {
									array_push($negatives,str_replace("-","",$single));
								}
								else {
									if($single!="") {
										array_push($positives,$single);
									}
								}
							}
						}
						else {
							array_push($positives,$part);
						}
					}
					else {
						array_push($positives,$part);
					}
				}
			}
		}
		
		$rating = 0;
		
		foreach($positives as $positive) {
			$parts = explode(" ",$positive);
			foreach($parts AS $part) {
				if(stripos($content,$part)!==false || stripos($author,$part)!==false) {$rating++;};
			}
		}
		
		foreach($negatives as $negative) {
			$parts = explode(" ",$negative);
			foreach($parts AS $part) {
				if(strpos($content,$part)!==false) {return -1;};
			}
		}
		
		return $rating==0?-1:$rating;
	}
	
	function getTwitterDateFormat($date) {
		$dateValue = strtotime($date);
		$difference = time() - $dateValue;
		if ($difference <= 0) {
			$twitdate = "0 seconds ago";
		} else if ($difference <= 60) {
			$twitdate = $difference . " seconds ago";
		} else if ($difference <= 3600) {
			$twitdate = round($difference / 60) . " minutes ago";
		} else if ($difference <= 86400) {
			$twitdate = round($difference / 3600);
			if($twitdate == 1) {
				$twitdate .=  " hour ago";
			} else {
				$twitdate .=  " hours ago";
			}
		} else { 
			$twitdate = round($difference / 86400) . " days ago";
		}

		return $twitdate;
	}
	
?>
