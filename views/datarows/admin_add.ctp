<div class="datarows form">
<?php echo $form->create(null, array('url' => '/admin/datarows/add'));?>
	<table id="newspaper-b" summary="Datarows Add">
	<thead>
		<tr>
			<th scope="col" colspan="14"><?php __('Add Datarow');?></th>
		</tr>
	</thead>
	<tbody>
	<tr>
		<td><?php echo $form->input('datafeed_id');?></td>
	</tr>
	<tr>
		<td><?php echo $form->input('topicName');?></td>
	</tr>
	<tr>
		<td><?php echo $form->input('published');?></td>
	</tr>
	<tr>
		<td><?php echo $form->input('articleId');?></td>
	</tr>
	<tr>
		<td><?php echo $form->input('title');?></td>
	</tr>
	<tr>
		<td><?php echo $form->input('content');?></td>
	</tr>
	<tr>
		<td><?php echo $form->input('thumb');?></td>
	</tr>
	<tr>
		<td><?php echo $form->input('author');?></td>
	</tr>
	<tr>
		<td><?php echo $form->input('rating');?></td>
	</tr>
	<tr>
		<td><?php echo $form->input('tags');?></td>
	</tr>
	<tr>
		<td><?php echo $form->input('cpbTags');?></td>
	</tr>
	<tr>
		<td><?php echo $form->input('flagged', array('options' => array(
														'true'=>'true',
														'false'=>'false'
														)));?></td>
	</tr>
	<tr>
		<td><?php echo $form->input('blocked', array('options' => array(
														'true'=>'true',
														'false'=>'false'
														)));?></td>
	</tr>
	<tr>
		<td><?php echo $form->end('Submit');?></td>
	</tr>
	</tbody>
	<tfoot>
		<tr>
			<td colspan="14">
				<div class="actions">
					<ul>
						<li><?php echo $html->link(__('List Datarows', true), array('controller' => 'datarows','action' => 'admin_index'));?></li>
					</ul>
				</div>
			</td>
		</tr>
	</tfoot>
	</table>
</div>
