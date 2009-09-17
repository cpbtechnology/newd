<div class="Section" id="Player">
	<h2>[HEADER]</h2>
	<div>
		<div id="VideoPlayer">
			<p>You must have Flash and Javascript enabled to watch videos.</p>
		</div>
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

<div class="Section" id="Queue">
	<h2>Queue</h2>
	<div class="MediaContainer">
		<ul>
			<?php for($i=0;$i<sizeof($youtubes); $i++){ ?>
				<li class="cpb">
					<a href="http://www.youtube.com/watch?v=<?= $youtubes[$i]["Datarow"]["articleId"] ?>" title="">
					<img src="<?= $youtubes[$i]['Datarow']['thumb'] ?>" alt="" width="84" height="63" />
					<span class='overlay'></span>
					</a>
				</li>
			<?php } ?>
		</ul>
		<div class="Overlay"></div>
	</div>
	<ul class="Pagination">
		<li class="Next">
			<a href="#" class="disabled">Next</a>
		</li>
		<li class="Previous">
			<a href="#" class="disabled">Previous</a>
		</li>
	</ul>
</div>
