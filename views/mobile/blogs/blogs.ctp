<ul class="blogs">

<?php 
	$count = 0; 
	
	foreach ($items as $item){
		
		$totallen = 60;
		$contentlen = strlen($item['Datarow']['title']);	
		
		$content = strip_tags(substr($item['Datarow']['title'], 0 , $totallen));
			
		if($contentlen > $totallen) {
				$content .= '...';
		}
		
		$articledate = strtotime($item['Datarow']['published']);
		$articledate = date('M d, Y', $articledate);
		
		$content .= '</a> &nbsp; <p class="subtext"> ' . $articledate . ' by ' .$item['Datarow']['author'].'</p>';

		if ($count == 0){
			$count++;
			?>
				<li source="blogs" url="<?=$item['Datarow']['articleId']?>" class="firstlist" id="firstblog"><a href="<?=$item['Datarow']['articleId']?>" target="_blank"><?= $content ?></li>
			<?php
		}else{
			$count++;
			?>
    			<li source="blogs" url="<?=$item['Datarow']['articleId']?>" class="list"><a href="<?=$item['Datarow']['articleId']?>" target="_blank"><?= $content ?></li>
			<?php 
		}
	}
	/*
	if($count<11){
		for($i=0; $i < 11-$count; ++$i){
			echo "<li class=\"list\"></li>";
		}
	}
	*/	 
?>
</ul>