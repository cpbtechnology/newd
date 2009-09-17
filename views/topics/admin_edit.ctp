<div class="topics form">

<?php echo $form->create(null, array('url' => '/admin/topics/edit')); ?>
	<table id="newspaper-b" summary="Topics Table">
	<thead>
		<tr>
			<th scope="col" colspan="5"><?php __('Edit Topic');?></th>
		</tr>
	</thead>
	<tbody>
	<tr>
		<td><?php echo $form->input('id');?></td>
	</tr>
	<tr>
		<td><?php echo $form->input('name');?></td>
	</tr>
	<tr>
		<td><?php echo $form->input('abbr');?></td>
	</tr>
	<tr>
		<td><?php echo $form->input('navIcon');?></td>
	</tr>
	<tr>
		<td><?php echo $form->end('Submit');?></td>
	</tr>
	</tbody>
	<tfoot>
		<tr>
			<td colspan="5">
				<div class="actions">
					<ul>
						<li><?php echo $html->link(__('Delete', true), '/admin/topics/delete/'.$form->value('Topic.id'), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('Topic.id'))); ?></li>
						<li><?php echo $html->link(__('List Topics', true), array('controller' => 'topics','action' => 'admin_index'));?></li>
					</ul>
				</div>
			</td>
		</tr>
	</tfoot>
	</table>


</div>
