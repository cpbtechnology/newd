<div class="topics form">
<?php echo $form->create(null, array('url' => '/admin/topics/add')); ?>
	<table id="newspaper-b" summary="Topics Table">
	<thead>
		<tr>
			<th scope="col" colspan="4"><?php __('Add Topic');?></th>
		</tr>
	</thead>
	<tbody>
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
			<td colspan="4">
				<div class="actions">
					<ul>
						<li><?php echo $html->link(__('List Topics', true), array('controller' => 'topics','action' => 'admin_index'));?></li>
					</ul>
				</div>
			</td>
		</tr>
	</tfoot>
	</table>
</div>
