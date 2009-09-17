<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Newd | Admin Login</title>
	<style type="text/css">
	<!--
	@import url("../css/adminstyle.css");
	-->
	</style>
</head>
<body>

<?php
echo $form->create(null, array('url' => '/admin/login'));
?>
	<div class="login">
		<table id="rounded-corner">
			<thead>
				<tr>
					<th scope="col">Admin Login</th>
				</tr>
			</thead>   
			<tbody>	
				<tr>
					<td><?php echo $form->input('username');?></td>
				</tr>
				<tr>
					<td><?php echo $form->input('password');?></td>
				</tr>
			</tbody>
			<tfoot>
				<tr>
					<td><?php 	$session->flash();
								$session->flash('auth');
								echo $form->submit('Login');
						?>
					</td>
				</tr>
			</tfoot>
		</table>
		<?php echo $form->end();?>
	</div>
</body>
</html>
