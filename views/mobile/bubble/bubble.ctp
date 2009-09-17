<div class="Section" id="Featured">
	<h2>Bubbled Up From Us To You</h2>
	<div class="MediaContainer">
		<ul>

<?php 
	$pick = rand(0, count($bubbles)-1);
	$content = $bubbles[$pick]['Datarow']['content'];
	$title = $bubbles[$pick]['Datarow']['title'];
	$image_url = $bubbles[$pick]['Datarow']['thumb'];
	$contentShort = substr($content, 0, 36)."...";
?>
	<li class="cpb">
		&nbsp;&nbsp;<a href='<?= $content ?>' title="<?= $title ?>" rel="NewWindow"><img src='<?= $image_url ?>' alt='<?= $title ?>' width="90" height="74" /><span class='overlay'></span></a>
		<span class="bubble_title">&nbsp;&nbsp;<?= $title ?></span>
		&nbsp;&nbsp;<a class="bubble_url" href='<?= $content ?>'><?= $contentShort ?></a>
	</li>
<?php
?>

		</ul>
		<div class="Overlay"></div>
	</div>
</div>