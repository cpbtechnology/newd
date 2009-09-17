<div class="users index">
<table id="box-table-a">
	<thead>
		<tr>
			<th scope="col">
				<?php
				echo $paginator->counter(array(
				'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
				));
				?>			
			</th>
		</tr>
	</thead>
</table>
<table id="newspaper-b" summary="Users Table">
<thead>
<tr>
	<th scope="col"><?php echo $paginator->sort('id');?></th>
	<th scope="col"><?php echo $paginator->sort('username');?></th>
	<th scope="col"><?php echo $paginator->sort('password');?></th>
	<th scope="col"><?php echo $paginator->sort('changePassword');?></th>
	<th class="actions" scope="col"><?php __('Actions');?></th>
</tr>
</thead>
<tfoot>
	<tr>
		<td colspan="4">
			<em>
				<div class="paging">
					<?php echo $paginator->prev('<< '.__('previous', true), null, null, array('class'=>'disabled'));?>
				 | 	<?php echo $paginator->numbers();?>
					<?php echo $paginator->next(__('next', true).' >>', null, null, array('class'=>'disabled'));?>
				</div>
			</em>
				<div class="actions">
					<ul>
						<li><?php echo $html->link(__('New User', true), array('controller' => 'users','action' => 'admin_add')); ?></li>
					</ul>
				</div>
		</td>
	</tr>
</tfoot>
<tbody>
<?php
$i = 0;
foreach ($users as $user):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $user['User']['id']; ?>
		</td>
		<td>
			<?php echo $user['User']['username']; ?>
		</td>
		<td>
			<?php echo $user['User']['password']; ?>
		</td>
		<td>
			<?php echo $user['User']['changePassword']; ?>
		</td>
		<td class="actions">
			<?php echo $html->link(__('View', true), '/admin/users/view/'.$user['User']['id']); ?>
			<?php echo $html->link(__('Edit', true), '/admin/users/edit/'.$user['User']['id']); ?>
			<?php echo $html->link(__('Delete', true), '/admin/users/delete/'.$user['User']['id'], null, sprintf(__('Are you sure you want to delete # %s?', true), $user['User']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
</tbody>
</table>
</div>
