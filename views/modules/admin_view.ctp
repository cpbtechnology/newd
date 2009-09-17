<div class="modules view">
	<table id="newspaper-b" summary="Modules Detail">
	<thead>
		<tr>
			<th scope="col"><?php  __('Module');?></th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>
				<div><strong><?php __('Id'); ?>:</strong></div>
				<div><?php echo $module['Module']['id']; ?></div>
			</td>
		</tr>
		<tr>
			<td>
				<div><strong><?php __('Name'); ?>:</strong></div>
				<div><?php echo $module['Module']['name']; ?></div>
			</td>
		</tr>
		<tr>
			<td>
				<div><strong><?php __('Status'); ?>:</strong></div>
				<div><?php echo $module['Module']['status']; ?></div>
			</td>
		</tr>
		<tr>
			<td>
				<div><strong><?php __('MinSize'); ?>:</strong></div>
				<div><?php echo $module['Module']['minSize']; ?></div>
			</td>
		</tr>
		<tr>
			<td>
				<div><strong><?php __('MaxSize'); ?>:</strong></div>
				<div><?php echo $module['Module']['maxSize']; ?></div>
			</td>
		</tr>
		<tr>
			<td>
				<div><strong><?php __('UpdateType'); ?>:</strong></div>
				<div><?php echo $module['Module']['updateType']; ?></div>
			</td>
		</tr>
		<tr>
			<td>
				<div><strong><?php __('Updateid'); ?>:</strong></div>
				<div><?php echo $module['Module']['updateid']; ?></div>
			</td>
		</tr>
		<tr>
			<td>
				<div><strong><?php __('UpdateInSeconds'); ?>:</strong></div>
				<div><?php echo $module['Module']['updateInSeconds']; ?></div>
			</td>
		</tr>
		<tr>
			<td>
				<div><strong><?php __('Datafeed Id'); ?>:</strong></div>
				<div><?php echo $module['Module']['datafeed_id']; ?></div>
			</td>
		</tr>
		<tr>
			<td>
				<div><strong><?php __('Datafeed Tags'); ?>:</strong></div>
				<div><?php echo $module['Module']['datafeed_tags']; ?></div>
			</td>
		</tr>
		<tr>
			<td>
				<div><strong><?php __('Datafeed Tag Restriction'); ?>:</strong></div>
				<div><?php echo $module['Module']['datafeed_tag_restriction']; ?></div>
			</td>
		</tr>
		<tr>
			<td>
				<div><strong><?php __('Layout Tag'); ?>:</strong></div>
				<div><?php echo $module['Module']['layout_tag']; ?></div>
			</td>
		</tr>
		<tr>
			<td>
				<div><strong><?php __('Created'); ?>:</strong></div>
				<div><?php echo $module['Module']['created']; ?></div>
			</td>
		</tr>
		<tr>
			<td>
				<div><strong><?php __('Modified'); ?>:</strong></div>
				<div><?php echo $module['Module']['modified']; ?></div>
			</td>
		</tr>
	</tbody>
	<tfoot>
		<tr>
			<td >
				<div class="actions">
					<ul>
						<li><?php echo $html->link(__('Edit Module', true), '/admin/modules/edit/'.$module['Module']['id']); ?> </li>
						<li><?php echo $html->link(__('Delete Module', true), '/admin/modules/delete/'.$module['Module']['id'], null, sprintf(__('Are you sure you want to delete # %s?', true), $module['Module']['id'])); ?> </li>
						<li><?php echo $html->link(__('List Modules', true), array('controller' => 'modules','action' => 'admin_index')); ?> </li>
						<li><?php echo $html->link(__('New Module', true), array('controller' => 'modules','action' => 'admin_add')); ?> </li>
					</ul>
				</div>
			</td>
		</tr>
	</tfoot>
	</table>
</div>
