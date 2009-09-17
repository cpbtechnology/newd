<div class="Section" id="Player">
	<h2>[HEADER]</h2>
	<div>
		<div id="VideoPlayer">
			<p class="FPO">
				<img src="/img/FPO/fpo.video-player.jpg" alt="FPO" />
			</p>
		</div>
	</div>
</div>

<div class="Section" id="Queue">
	<h2>Queue</h2>
	<div class="MediaContainer">
		<ul>
			<?php for($i=0;$i<sizeof($queues); $i++){ ?>
				<li class="cpb">
					<img src="<?= $queues[$i]['Datarow']['thumb'] ?>" alt="<?= $queues[$i]['Datarow']['title'] ?>" width="84" height="63" />
					<span class='overlay'></span>
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
