<div class="tags form">
<?php echo $form->create(null, array('url' => '/admin/tags/add'));?>
	<table id="newspaper-b" summary="Tags Table">
	<thead>
		<tr>
			<th scope="col" colspan="7"><?php __('Add Tag');?></th>
		</tr>
	</thead>
	<tbody>
	<tr>
		<td><?php echo $form->input('name');?></td>
	</tr>
	<tr>
		<td><?php echo $form->input('topic_id');?></td>
	</tr>
	<tr>
		<td><?php echo $form->input('type', array('options' => array(
														'client'=>'client',
														'search'=>'search'
														)));?></td>
	</tr>
	<tr>
		<td><?php echo $form->input('Rating');?></td>
	</tr>
	<tr>
		<td><?php echo $form->input('datafeed_ids');?></td>
	</tr>
	<tr>
		<td><?php echo $form->input('status');?></td>
	</tr>
	<tr>
		<td><?php echo $form->end('Submit');?></td>
	</tr>
	</tbody>
	<tfoot>
		<tr>
			<td colspan="7">
				<div class="actions">
					<ul>
						<li><?php echo $html->link(__('List Tags', true), array('controller' => 'tags','action' => 'admin_index'));?></li>
					</ul>
				</div>
			</td>
		</tr>
	</tfoot>
	</table>
</div>
