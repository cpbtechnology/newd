<div class="Section" id="News">
	<h2>Articles</h2>
	<div class="MediaContainer">
		<div>
			<ul id="news_feed">
<?php 
	$count = 0;
	$dates = array(); 
	foreach ($articless as $row) {
		$articleTitle = $row['Datarow']['title'];
		$articleUrl = substr($row["Datarow"]["articleId"], strrpos($row["Datarow"]["articleId"], "http://") , 300);
		$articleDescription = $row['Datarow']['content'];
		$articledate = date('M d, Y', strtotime($row['Datarow']['published']));
		$author = $row['Datarow']['author'];
		$id = $row['Datarow']['id'];
		if(!isset($dates[$articledate])) {$dates[$articledate] = array();}
		array_push($dates[$articledate],array('articleUrl'=>$articleUrl,'articleTitle'=>$articleTitle,'author'=>$author, 'id'=>$id)); 
	}
	
	//sort
	//krsort($dates);
	
	$first = TRUE;
	
	//display
	foreach($dates AS $date=>$posts) {
		$date_year = date('Y',strtotime($date));
		$date_day = date('j',strtotime($date));
		$date_month = date('F',strtotime($date));
		$date_dow = date('l',strtotime($date));
		$date_day_abbr = strtolower(date('D',strtotime($date)));
		$date_month_abbr = strtolower(date('M',strtotime($date)));
		if(!$first) {
		?>
		<li class="date">
			<p class="<?=$topic?>">
				<span class="date date_<?=$date_day?>"><?=$date_day?></span>
				<span class="month month_<?=$date_month_abbr?>"><?=$date_month?></span>
				<span class="year year_<?=$date_year?>"><?=$date_year?></span>
				<span class="day_of_week day_<?=$date_day_abbr?>"><?=$date_dow?></span>
			</p>
		</li>
		<?php
		}
		else {$first = FALSE;}
		
		foreach($posts AS $post) { ?>
			<li class="<?=$topic?>" id="news_<?=$post['id']?>">
				<p>
					<a href="<?=$post['articleUrl']?>" rel="NewWindow"><?=$post['articleTitle']?></a>
					<abbr><?=$date?> - by <?=$post['author']?></abbr>
				</p>
			</li>
			<?php
		}
	}
?>
			</ul>
		</div>
		<div class="Overlay"></div>
	</div>
	<p class="Pagination">
		<span class="loader">Loading</span>
		<a href="#">Read More</a>
	</p>
</div>