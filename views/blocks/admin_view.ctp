<div class="blocks view">
	<table id="newspaper-b" summary="Blocks Table">
	<thead>
		<tr>
			<th scope="col" colspan="3"><?php  __('Block');?></th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>
				<div><strong><?php __('Id'); ?>:</strong></div>
				<div><?php echo $block['Block']['id']; ?></div>
			</td>
		</tr>
		<tr>
			<td>
				<div><strong><?php __('Datafeed Id'); ?>:</strong></div>
				<div><?php echo $block['Block']['datafeed_id']; ?></div>
			</td>
		</tr>
		<tr>
			<td>
				<div><strong><?php __('Unique Identifier'); ?>:</strong></div>
				<div><?php echo $block['Block']['uniqueIdentifier']; ?></div>
			</td>
		</tr>
	</tbody>
	<tfoot>
		<tr>
			<td colspan="3">
				<div class="actions">
					<ul>
						<li><?php echo $html->link(__('Edit Block', true), '/admin/blocks/edit/'.$block['Block']['id']); ?> </li>
						<li><?php echo $html->link(__('Delete Block', true), '/admin/blocks/delete/'.$block['Block']['id'], null, sprintf(__('Are you sure you want to delete # %s?', true), $block['Block']['id'])); ?> </li>
						<li><?php echo $html->link(__('List Blocks', true), array('controller' => 'blocks','action' => 'admin_index')); ?> </li>
						<li><?php echo $html->link(__('New Block', true), array('controller' => 'blocks','action' => 'admin_add')); ?> </li>
					</ul>
				</div>
			</td>
		</tr>
	</tfoot>
	</table>
</div>
