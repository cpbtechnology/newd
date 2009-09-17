<div class="datafeeds form">
<?php echo $form->create(null, array('url' => '/admin/datafeeds/edit'));?>
	<table id="newspaper-b" summary="Datafeeds Edit">
	<thead>
		<tr>
			<th scope="col" colspan="11"><?php __('Edit Datafeed');?></th>
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
		<td><?php echo $form->input('contentType');?></td>
	</tr>
	<tr>
		<td><?php echo $form->input('updateFreqInMinutes');?></td>
	</tr>
	<tr>
		<td><?php echo $form->input('defaultTags');?></td>
	</tr>
	<tr>
		<td><?php 
					$authtype = array('none'=>'none', 'htauth'=>'htauth', 'apikey'=>'apikey');
					echo $form->input('authType', array('options' => $authtype));
			?></td>
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
			<td colspan="11">
				<div class="actions">
					<ul>
						<li><?php echo $html->link(__('Delete', true), '/admin/datafeeds/delete/'.$form->value('Datafeed.id'), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('Datafeed.id'))); ?></li>
						<li><?php echo $html->link(__('List Datafeeds', true), array('controller' => 'datafeeds','action' => 'admin_index'));?></li>
					</ul>
				</div>
			</td>
		</tr>
	</tfoot>
	</table>
</div>
