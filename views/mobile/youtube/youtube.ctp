<div class="Section" id="Player">
	<h2>[HEADER]</h2>
	<div>
		<div id="VideoPlayer"><!-- Video Stage --></div>
	</div>
</div>

<div class="Section" id="Queue">
	<h2>Queue</h2>
	<div class="MediaContainer">
		<ul>
			<?php 
			
			for($i=0;$i<sizeof($youtubes); $i++){
				$date = date('M d, Y', strtotime($youtubes[$i]['Datarow']['published'])); 
			
			?>
				<li>
					<a href="http://www.youtube.com/watch?v=<?= $youtubes[$i]["Datarow"]["articleId"] ?>" title="<?= $youtubes[$i]['Datarow']['title'] ?>">
						<?= $youtubes[$i]['Datarow']['title'] ?>
						<span class='overlay'></span>
					</a>
					<abbr>youtube.com - <?=$date?></abbr>
				</li>
			<?php } ?>
		</ul>
		<div class="Overlay"></div>
	</div>
	<ul class="Pagination">
		<li class="Next">
			<a href="#">Next</a>
		</li>
		<li class="Previous">
			<a href="#">Previous</a>
		</li>
	</ul>
</div>
