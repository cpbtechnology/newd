<div class="Section" id="Featured">
	<h2>Bubbled Up From Us To You</h2>
	<div class="MediaContainer">
		<ul>

<?php 
	foreach ($bubbles as $row) {
		$content = $row['Datarow']['content'];
		$title = htmlentities($row['Datarow']['title']);
		$image_url = $row['Datarow']['thumb'];
?>
	<li class="cpb">
		<a href='<?= $content ?>' title="<?= $title ?>" rel="NewWindow">
			<img src='<?= $image_url ?>' alt='<?= $title ?>' width="90" height="74" />
			<span class='overlay'></span>
		</a>
	</li>
<?php
	}
?>

		</ul>
		<div class="Overlay"><!-- TEXTURE OVERLAY --></div>
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