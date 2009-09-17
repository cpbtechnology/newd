<div class="datarows view">
	<table id="newspaper-b" summary="Datarows Detail">
	<thead>
		<tr>
			<th scope="col"><?php  __('Datarow');?></th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>
				<div><strong><?php __('Id'); ?>:</strong></div>
				<div><?php echo $datarow['Datarow']['id']; ?></div>
			</td>
		</tr>
		<tr>
			<td>
				<div><strong><?php __('Datafeed Id'); ?>:</strong></div>
				<div><?php echo $datarow['Datarow']['datafeed_id']; ?></div>
			</td>
		</tr>
		<tr>
			<td>
				<div><strong><?php __('Topic Name'); ?>:</strong></div>
				<div><?php echo $datarow['Datarow']['topicName']; ?></div>
			</td>
		</tr>
		<tr>
			<td>
				<div><strong><?php __('Published'); ?>:</strong></div>
				<div><?php echo $datarow['Datarow']['published']; ?></div>
			</td>
		</tr>
		<tr>
			<td>
				<div><strong><?php __('Article Id'); ?>:</strong></div>
				<div><?php echo $datarow['Datarow']['articleId']; ?></div>
			</td>
		</tr>
		<tr>
			<td>
				<div><strong><?php __('Title'); ?>:</strong></div>
				<div><?php echo $datarow['Datarow']['title']; ?></div>
			</td>
		</tr>
		<tr>
			<td>
				<div><strong><?php __('Content'); ?>:</strong></div>
				<div><?php echo $datarow['Datarow']['content']; ?></div>
			</td>
		</tr>
		<tr>
			<td>
				<div><strong><?php __('Thumb'); ?>:</strong></div>
				<div><?php echo $datarow['Datarow']['thumb']; ?></div>
			</td>
		</tr>
		<tr>
			<td>
				<div><strong><?php __('Author'); ?>:</strong></div>
				<div><?php echo $datarow['Datarow']['author']; ?></div>
			</td>
		</tr>
		<tr>
			<td>
				<div><strong><?php __('Rating'); ?>:</strong></div>
				<div><?php echo $datarow['Datarow']['rating']; ?></div>
			</td>
		</tr>
		<tr>
			<td>
				<div><strong><?php __('Created'); ?>:</strong></div>
				<div><?php echo $datarow['Datarow']['created']; ?></div>
			</td>
		</tr>
		<tr>
			<td>
				<div><strong><?php __('Modified'); ?>:</strong></div>
				<div><?php echo $datarow['Datarow']['modified']; ?></div>
			</td>
		</tr>
		<tr>
			<td>
				<div><strong><?php __('Tags'); ?>:</strong></div>
				<div><?php echo $datarow['Datarow']['tags']; ?></div>
			</td>
		</tr>
		<tr>
			<td>
				<div><strong><?php __('CpbTags'); ?>:</strong></div>
				<div><?php echo $datarow['Datarow']['cpbTags']; ?></div>
			</td>
		</tr>
		<tr>
			<td>
				<div><strong><?php __('Flagged'); ?>:</strong></div>
				<div><?php echo $datarow['Datarow']['flagged']; ?></div>
			</td>
		</tr>
		<tr>
			<td>
				<div><strong><?php __('Blocked'); ?>:</strong></div>
				<div><?php echo $datarow['Datarow']['blocked']; ?></div>
			</td>
		</tr>
	</tbody>
	<tfoot>
		<tr>
			<td >
				<div class="actions">
					<ul>
						<li><?php echo $html->link(__('Edit Datarow', true), '/admin/datarows/edit/'.$datarow['Datarow']['id']); ?> </li>
						<li><?php echo $html->link(__('Delete Datarow', true), '/admin/datarows/delete/'.$datarow['Datarow']['id'], null, sprintf(__('Are you sure you want to delete # %s?', true), $datarow['Datarow']['id'])); ?> </li>
						<li><?php echo $html->link(__('List Datarows', true), array('controller' => 'datarows','action' => 'admin_index')); ?> </li>
						<li><?php echo $html->link(__('New Datarow', true), array('controller' => 'datarows','action' => 'admin_add')); ?> </li>
					</ul>
				</div>
			</td>
		</tr>
	</tfoot>
	</table>
</div>
