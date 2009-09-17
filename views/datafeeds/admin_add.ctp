<div class="datafeeds form">
<?php echo $form->create(null, array('url' => '/admin/datafeeds/add'));?>
	<table id="newspaper-b" summary="Datafeeds Add">
	<thead>
		<tr>
			<th scope="col" colspan="10"><?php __('Add Datafeed');?></th>
		</tr>
	</thead>
	<tbody>
	<tr>
		<td><?php echo $form->input('name');?></td>
	</tr>
	<tr>
		<td><?php echo $form->input('contentType');?></td>
	</tr>
	<tr>
		<td><?php echo $form->input('updateFreqInMinutes');?></td>
	</tr>
	<tr>
		<td><?php echo $form->input('defaultTags');?></td>
	</tr>
	<tr>
		<td><?php echo $form->input('authType', array('options' => array(
														'none'=>'none',
														'htauth'=>'htauth',
														'apikey'=>'apikey'
														)));?></td>
	</tr>
	<tr>
		<td><?php echo $form->input('authUserName');?></td>
	</tr>
	<tr>
		<td><?php echo $form->input('authPassword');?></td>
	</tr>
	<tr>
		<td><?php echo $form->input('crawlerStatus', array('options' => array(
														'none'=>'none',
														'crawling'=>'crawling'
														)));?></td>
	</tr>
	<tr>
		<td><?php echo $form->input('sources');?></td>
	</tr>
	<tr>
		<td><?php echo $form->end('Submit');?></td>
	</tr>
	</tbody>
	<tfoot>
		<tr>
			<td colspan="10">
				<div class="actions">
					<ul>
						<li><?php echo $html->link(__('List Datafeeds', true), array('controller' => 'datafeeds','action' => 'admin_index'));?></li>
					</ul>
				</div>
			</td>
		</tr>
	</tfoot>
	</table>
</div>
