<div class="blocks form">
<?php echo $form->create(null, array('url' => '/admin/blocks/edit'));?>
	<table id="newspaper-b" summary="Blocks Table">
	<thead>
		<tr>
			<th scope="col" colspan="4"><?php __('Edit Block');?></th>
		</tr>
	</thead>
	<tbody>
	<tr>
		<td><?php echo $form->input('id');?></td>
	</tr>
	<tr>
		<td><?php echo $form->input('datafeed_id');?></td>
	</tr>
	<tr>
		<td><?php echo $form->input('uniqueIdentifier');?></td>
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
						<li><?php echo $html->link(__('Delete', true), '/admin/blocks/delete/'.$form->value('Block.id'), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('Block.id'))); ?></li>
						<li><?php echo $html->link(__('List Blocks', true), array('controller' => 'blocks','action' => 'admin_index'));?></li>
					</ul>
				</div>
			</td>
		</tr>
	</tfoot>
	</table>
</div>
