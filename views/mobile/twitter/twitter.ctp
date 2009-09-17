<ul class="twitter">
<?php 
	$count = 0; 
	
	foreach ($items as $item): 
		
		$author = "<span class='author'>".$item['Datarow']['author']."<span>: </span></span>";

		/*
		$content = $author . excerpt(strip_tags($item['Datarow']['content']),35,3,"...");
		*/
		
		$content = $author . strip_tags($item['Datarow']['content']);
		if (strlen($content) > 165)
			$content = substr($content, 0, 164) . "&#0133";
		
		$dateValue = strtotime($item['Datarow']['published']);
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

		$content .= '</a><span class="subtext"> '.$twitdate .'</span>';
		if ($count == 0):
			$count++;
?>

	<li source="twitter" url="<?=$item['Datarow']['articleId']?>" class="firstlist" id="firsttweet"><a href="<?=$item['Datarow']['articleId']?>" target="_blank"><?= $content ?></li>
<?php
		else:
			$count++;
?>
    <li source="twitter" url="<?=$item['Datarow']['articleId']?>" class="list"><a href="<?=$item['Datarow']['articleId']?>" target="_blank"><?= $content ?></li>
<?php 
		endif;
	endforeach; 
	if($count<10){
		for($i=0; $i < 10-$count; ++$i){
			echo "<li class=\"list\"></li>";
		}
	}	
?>
</ul>