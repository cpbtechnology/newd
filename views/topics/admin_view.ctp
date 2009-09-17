<div class="topics view">
	<table id="newspaper-b" summary="Topics Table">
	<thead>
		<tr>
			<th scope="col"><?php  __('Topic');?></th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>
				<div><strong><?php __('Id'); ?>:</strong></div>
				<div><?php echo $topic['Topic']['id']; ?></div>
			</td>
		</tr>
		<tr>
			<td>
				<div><strong><?php __('Name'); ?>:</strong></div>
				<div><?php echo $topic['Topic']['name']; ?></div>
			</td>
		</tr>
		<tr>
			<td>
				<div><strong><?php __('Abbr'); ?>:</strong></div>
				<div><?php echo $topic['Topic']['abbr']; ?></div>
			</td>
		</tr>
		<tr>
			<td>
				<div><strong><?php __('NavIcon'); ?>:</strong></div>
				<div><?php echo $topic['Topic']['navIcon']; ?></div>
			</td>
		</tr>
		<tr>
			<td>
				<div><strong><?php __('Created'); ?>:</strong></div>
				<div><?php echo $topic['Topic']['created']; ?></div>
			</td>
		</tr>
		<tr>
			<td>
				<div><strong><?php __('Modified'); ?>:</strong></div>
				<div><?php echo $topic['Topic']['modified']; ?></div>
			</td>
		</tr>
	</tbody>
	<tfoot>
		<tr>
			<td >
				<div class="actions">
					<ul>
						<li><?php echo $html->link(__('Edit Topic', true), '/admin/topics/edit/'.$topic['Topic']['id']); ?> </li>
						<li><?php echo $html->link(__('Delete Topic', true), array('action'=>'delete', $topic['Topic']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $topic['Topic']['id'])); ?> </li>
						<li><?php echo $html->link(__('List Topics', true), array('controller' => 'topics','action' => 'admin_index')); ?> </li>
						<li><?php echo $html->link(__('New Topic', true), array('controller' => 'topics','action' => 'admin_add')); ?> </li>
					</ul>
				</div>
			</td>
		</tr>
	</tfoot>
	</table>
</div>
