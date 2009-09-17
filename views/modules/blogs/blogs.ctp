<h2 class='title'>Blogs</h2>
<ul class="blogs">

<?php 
	$count = 0; 
	
	foreach ($blogss as $row): 
		
		$totallen = 60;
		$contentlen = strlen($row['Datarow']['title']);	
		
		$content = strip_tags(substr($row['Datarow']['title'], 0 , $totallen));
			
		if($contentlen > $totallen) {
				$content .= '...';
		}
		
		$articledate = strtotime($row['Datarow']['published']);
		$articledate = date('M d, Y', $articledate);
		
		$content .= '</a> &nbsp; <p class="subtext"> ' . $articledate . ' by ' .$row['Datarow']['author'].'</p>';

		if ($count == 0):
			$count++;
?>
	<li class="firstlist" id="firstblog"><a href="<?=$row['Datarow']['articleId']?>" target="_blank"><?= $content ?></li>
<?php
		else:
			$count++;
?>
    <li class="list"><a href="<?=$row['Datarow']['articleId']?>" target="_blank"><?= $content ?></li>
<?php 
		endif;
	endforeach;
	if($count<11){
		for($i=0; $i < 11-$count; ++$i){
			echo "<li class=\"list\"></li>";
		}
	}	 
?>
</ul>