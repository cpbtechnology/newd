<div class="users view">
	<table id="newspaper-b" summary="Users Table">
	<thead>
		<tr>
			<th scope="col"><?php  __('User');?></th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>
				<div><strong><?php __('Id'); ?>:</strong></div>
				<div><?php echo $user['User']['id']; ?></div>
			</td>
		</tr>
		<tr>
			<td>
				<div><strong><?php __('User Name'); ?>:</strong></div>
				<div><?php echo $user['User']['username']; ?></div>
			</td>
		</tr>
		<tr>
			<td>
				<div><strong><?php __('Password'); ?>:</strong></div>
				<div><?php echo $user['User']['password']; ?></div>
			</td>
		</tr>
		<tr>
			<td>
				<div><strong><?php __('Change Password'); ?>:</strong></div>
				<div><?php echo $user['User']['changePassword']; ?></div>
			</td>
		</tr>
	</tbody>
	<tfoot>
		<tr>
			<td >
				<div class="actions">
					<ul>
						<li><?php echo $html->link(__('Edit User', true), '/admin/users/edit/'.$user['User']['id']); ?> </li>
						<li><?php echo $html->link(__('Delete User', true), '/admin/users/delete/'.$user['User']['id'], null, sprintf(__('Are you sure you want to delete # %s?', true), $user['User']['id'])); ?> </li>
						<li><?php echo $html->link(__('List Users', true), array('controller' => 'users','action' => 'admin_index')); ?> </li>
						<li><?php echo $html->link(__('New User', true), array('controller' => 'users','action' => 'admin_add')); ?> </li>
					</ul>
				</div>
			</td>
		</tr>
	</tfoot>
	</table>
</div>
