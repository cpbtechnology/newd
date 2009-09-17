<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Newd | Reset Password</title>
	<style type="text/css">
	<!--
	@import url("../css/adminstyle.css");
	-->
	</style>
</head>
<body>

<?php
echo $form->create('User', array('url' => '/admin/resetpassword'));
echo $form->hidden('changePassword', array('value' => '0'));
?>
	<div class="login">
		<table id="rounded-corner">
			<thead>
				<tr>
					<th scope="col"><?php __('Reset Password');?></th>
				</tr>
			</thead>   
			<tbody>	
				<tr>
					<td><?php echo $form->input('id', array('value' => $userid));?></td>
				</tr>
				<tr>
					<td><?php echo $form->input('User.NewPassword',  array('type' => 'password'));?></td>
				</tr>
				<tr>
					<td><?php echo $form->input('User.ConfirmNewPassword', array('type' => 'password'));?></td>
				</tr>
			</tbody>
			<tfoot>
				<tr>
					<td><?php 	//$session->flash();
								//$session->flash('auth');
								echo $form->end('Submit');
						?>
					</td>
				</tr>
			</tfoot>
		</table>
	</div>
</body>
</html>
