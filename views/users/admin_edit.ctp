<div class="users form">
<?php echo $form->create(null, array('url' => '/admin/users/edit'));?>
	<table id="newspaper-b" summary="Users Table">
	<thead>
		<tr>
			<th scope="col" colspan="5"><?php __('Edit User');?></th>
		</tr>
	</thead>
	<tbody>
	<tr>
		<td><?php echo $form->input('id');?></td>
	</tr>
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
			<td colspan="5">
				<div class="actions">
					<ul>
						<li><?php echo $html->link(__('Delete', true), '/admin/users/delete/'.$form->value('User.id'), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('User.id'))); ?></li>
						<li><?php echo $html->link(__('List Users', true), array('controller' => 'users','action' => 'admin_index'));?></li>
					</ul>
				</div>
			</td>
		</tr>
	</tfoot>
	</table>
</div>
