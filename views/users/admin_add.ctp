<div class="users form">
<?php echo $form->create(null, array('url' => '/admin/users/add'));?>
	<table id="newspaper-b" summary="Users Table">
	<thead>
		<tr>
			<th scope="col" colspan="4"><?php __('Add User');?></th>
		</tr>
	</thead>
	<tbody>
	<tr>
		<td><?php echo $form->input('username');?></td>
	</tr>
	<tr>
		<td><?php echo $form->input('User.NewPassword',  array('type' => 'password'));?></td>
	</tr>
	<tr>
		<td><?php echo $form->input('User.ConfirmNewPassword', array('type' => 'password'));?></td>
	</tr>
	<tr>
		<td><?php echo $form->input('changePassword', array('options' => array(
														'1'=>'Yes',
														'0'=>'No'
														)));?></td>
	</tr>
	<tr>
		<td><?php echo $form->end('Submit');?></td>
	</tr>
	</tbody>
	<tfoot>
		<tr>
			<td colspan="4">
				<div class="actions">
					<ul>
						<li><?php echo $html->link(__('List Users', true), array('controller' => 'users','action' => 'admin_index'));?></li>
					</ul>
				</div>
			</td>
		</tr>
	</tfoot>
	</table>
</div>
