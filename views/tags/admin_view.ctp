<div class="tags view">
	<table id="newspaper-b" summary="Tags Table">
	<thead>
		<tr>
			<th scope="col"><?php  __('Tag');?></th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>
				<div><strong><?php __('Id'); ?>:</strong></div>
				<div><?php echo $tag['Tag']['id']; ?></div>
			</td>
		</tr>
		<tr>
			<td>
				<div><strong><?php __('Name'); ?>:</strong></div>
				<div><?php echo $tag['Tag']['name']; ?></div>
			</td>
		</tr>
		<tr>
			<td>
				<div><strong><?php __('Topic Id'); ?>:</strong></div>
				<div><?php echo $tag['Tag']['topic_id']; ?></div>
			</td>
		</tr>
		<tr>
			<td>
				<div><strong><?php __('Type'); ?>:</strong></div>
				<div><?php echo $tag['Tag']['type']; ?></div>
			</td>
		</tr>
		<tr>
			<td>
				<div><strong><?php __('Rating'); ?>:</strong></div>
				<div><?php echo $tag['Tag']['Rating']; ?></div>
			</td>
		</tr>
		<tr>
			<td>
				<div><strong><?php __('Datafeed Ids'); ?>:</strong></div>
				<div><?php echo $tag['Tag']['datafeed_ids']; ?></div>
			</td>
		</tr>
		<tr>
			<td>
				<div><strong><?php __('Status'); ?>:</strong></div>
				<div><?php echo $tag['Tag']['status']; ?></div>
			</td>
		</tr>
		<tr>
			<td>
				<div><strong><?php __('Created'); ?>:</strong></div>
				<div><?php echo $tag['Tag']['created']; ?></div>
			</td>
		</tr>
		<tr>
			<td>
				<div><strong><?php __('Modified'); ?>:</strong></div>
				<div><?php echo $tag['Tag']['modified']; ?></div>
			</td>
		</tr>
	</tbody>
	<tfoot>
		<tr>
			<td >
				<div class="actions">
					<ul>
						<li><?php echo $html->link(__('Edit Tag', true), '/admin/tags/edit/'.$tag['Tag']['id']); ?> </li>
						<li><?php echo $html->link(__('Delete Tag', true), '/admin/tags/delete/'.$tag['Tag']['id'], null, sprintf(__('Are you sure you want to delete # %s?', true), $tag['Tag']['id'])); ?> </li>
						<li><?php echo $html->link(__('List Tags', true), array('controller' => 'tags','action' => 'admin_index')); ?> </li>
						<li><?php echo $html->link(__('New Tag', true), array('controller' => 'tags','action' => 'admin_add')); ?> </li>
					</ul>
				</div>
			</td>
		</tr>
	</tfoot>
	</table>
</div>
