<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Newd | Admin</title>
	<style type="text/css">
	<!--
	@import url("../css/adminstyle.css");
	@import url("../../../../css/adminstyle.css");
	-->
	</style>
</head>

<body>
	<!-- BEGIN: PageWrapper -->
	<div id="PageWrapper">

		<!-- BEGIN: layout -->
		<div id="LayoutWrapper">
			<!-- BEGIN: header -->
			<div id="logout"><?php echo $html->link('Logout', array('controller' => 'users', 'action' => 'logout')); ?></div>
			<div id="Header">
				<ul id="admin-tabs">
					<li><a <?php if($activeTab=="overview"){echo "class='Active'";} ?>href="/admin/">Overview</a></li>
					<li><a <?php if($activeTab=="topics"){echo "class='Active'";} ?> href="/admin/topics">Topics</a></li>
					<li><a <?php if($activeTab=="tags"){echo "class='Active'";} ?> href="/admin/tags">Tags</a></li>
					<li><a <?php if($activeTab=="datafeeds"){echo "class='Active'";} ?> href="/admin/datafeeds">Datafeeds</a></li>
					<li><a <?php if($activeTab=="modules"){echo "class='Active'";} ?> href="/admin/modules">Modules</a></li>
					<li><a <?php if($activeTab=="datarows"){echo "class='Active'";} ?> href="/admin/datarows">Datarows</a></li>
					<li><a <?php if($activeTab=="blocks"){echo "class='Active'";} ?> href="/admin/blocks">Blocks</a></li>
					<li><a <?php if($activeTab=="users"){echo "class='Active'";} ?> href="/admin/users">Users</a></li>
				</ul>
			</div>
			<!-- END: header -->

			<!-- BEGIN: content -->
			<div id="Content">
				<?php
					//$session->flash();
					//$session->flash('auth');
					echo $content_for_layout; 
				?>
			</div>
			<!-- END: content -->

			<!-- BEGIN: footer -->
			<div id="Footer">
			</div>
			<!-- END: footer -->

		</div>
		<!-- END: layout -->

	</div>
	<!-- END: PageWrapper -->
</body>
</html>
	