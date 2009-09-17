<div class="Section" id="Twitter">
	<h2>Twitter</h2>
	<div class="MediaContainer">
		<div>
			<ul id="twitter_feed">

<?php 
	$count = 0; 
	$dates = array();
	foreach ($twitters as $row) { 
		
		//parse author
		$parts = explode(" (",$row["Datarow"]["author"]);
		if(count($parts) == 2) {
			$screen_name = trim($parts[0]);
			$real_name = trim(str_replace(")","",$parts[1]));
		}
		else {
			$screen_name = $row["Datarow"]["author"];
			$real_name = $row["Datarow"]["author"];
		}
		
		$author = $real_name;
		$content = $row['Datarow']['content'];
		$pattern = "/((ftp|http|https|file):\/\/[\S]+(\b|$))/";
		$replacement = "<a href='$1' class='my_link' target='_blank'>$1</a>";
		$content = preg_replace($pattern,$replacement,$content);
		$image_url = $row['Datarow']['thumb'];
		$date = getTwitterDateFormat($row['Datarow']['published']);
		$index = date('Y-m-d',strtotime($row['Datarow']['published']));
		$id = $row['Datarow']['id'];
		
		if(!isset($dates[$index])) {$dates[$index] = array();}
		array_push($dates[$index],array('image_url'=>$image_url,'screen_name'=>$screen_name,'real_name'=>$real_name,'date'=>$date,'content'=>$content, 'id'=>$id)); 
	}
	
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
			<li class="cpb" id="twitter_<?=$post['id']?>">
				<p>
					<span class="twi_icon_overlay"></span>
					<img src="<?=$post['image_url']?>" alt="<?=$post['screen_name']?>" />
					<a class='twi_username' href='http://twitter.com/<?=$post['screen_name']?>' rel="NewWindow"><?=$post['real_name']?></a>
					<abbr><?=$post['date']?></abbr>
					<span class='twi_message'><?=$post['content']?></span>
				</p>
			</li>
		<?php }
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