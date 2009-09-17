<div class="blocks form">
<?php echo $form->create(null, array('url' => '/admin/blocks/add'));?>
	<table id="newspaper-b" summary="Blocks Table">
	<thead>
		<tr>
			<th scope="col" colspan="3"><?php __('Add Block');?></th>
		</tr>
	</thead>
	<tbody>
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
			<td colspan="3">
				<div class="actions">
					<ul>
						<li><?php echo $html->link(__('List Blocks', true), array('controller' => 'blocks','action' => 'admin_index'));?></li>
					</ul>
				</div>
			</td>
		</tr>
	</tfoot>
	</table>
</div>
