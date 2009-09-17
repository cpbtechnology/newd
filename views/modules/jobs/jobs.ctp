<h2>Jobs</h2>
<div class="MediaContainer">
	<ul id="job_listing">

<?php 
	$count = 0; 
	$jobs = array_slice($jobss, 0, 3);
	foreach ($jobs as $row):
		$jobTitle = $row['Datarow']['title'];
		$jobDescription = $row['Datarow']['content'];
?>
		<li><a href="CPB_TEST"><?=$jobTitle?></a><?=$$row['Datarow']?></li>
<?php 
	endforeach; 
?>
	</ul>
	<div class="overlay"></div>
</div>
<p class="see_more_link">
	<a href="http://www.jobvite.com/CompanyJobs/Careers.aspx?c=qlX9Vfw6&page=Jobs" rel="NewWindow">See All</a>
</p>      
<ul class="Pagination">
	<li class="Next">
		<a href="#">Next</a>
	</li>
	<li class="Previous">
		<a href="#" class="disabled">Previous</a>
	</li>
</ul>
