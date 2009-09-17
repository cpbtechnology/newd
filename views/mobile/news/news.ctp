<ul class="news">
<?php

foreach ($items as $index => $item) {

	// Title and source come in as a single data point, splitting on " - "
	//$split_title = explode( " - ", $item['Datarow']['title']);
	
	$full_title = $item['Datarow']['title'];
	$divider_pos = strrpos($full_title,"-");
	$title = trim(substr($full_title,0,$divider_pos));
	$source = trim(substr($full_title,$divider_pos+1));
	
	//$title = trim($split_title[0]);
	//$source = trim($split_title[1]);

	// 2 line titles reduce the space available for descriptions.
	$available_space = (strlen($title) > 35) ? 80 : 120;

	// Format date
	$articledate = strtotime($item['Datarow']['published']);
	$articledate = date('M d, Y', $articledate);

	// Set up markup and truncation
	$subtext = '<p class="subtext">'. substr($source, 0, 40) .' - ' . $articledate . '</p>';

	// Most of the descriptions start with the title and/or source, stripping it out.
	$text_content = strip_tags($item['Datarow']['content']);
	$text_content = str_replace($title, "", $text_content);
	$text_content = str_replace($source, "", $text_content);
	$text_content = trim(preg_replace('/^\W/', '', $text_content));	
	$description = '<p class="articletext">' . substr($text_content, 0, $available_space) . '...</p>';

	// Extract URL
	$link = substr($item['Datarow']['articleId'], strpos($item['Datarow']['articleId'],'http://'), strlen($item['Datarow']['articleId'])); 

?>
	<li source="news" url="<?= $link ?>" <?= ($index == 0) ? 'id="firstnews" class="firstlist"' : 'class="list"'; ?>>
		<a href="<?= $link ?>" target="_blank"><?= $title ?></a><?= $subtext . " " . $description ?>
	</li>
<?php
}

$news_count = count($newss);
if($news_count < 10){
	for($i=0; $i < 10-$news_count; ++$i){
		echo "<li class=\"list\"></li>";
	}
}
?>
</ul>

