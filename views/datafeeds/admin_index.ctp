<div class="datafeeds index">
<!-- h2><?php __('Datafeeds');?></h2 -->
<table id="box-table-a">
	<thead>
		<tr>
			<th scope="col">
			<?php
				echo $paginator->counter(array(
				'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
				));
				?>
			</th>
		</tr>
	</thead>
</table>
<table id="newspaper-b" summary="Datafeeds Table">
<thead>
<tr>
	<th scope="col"><?php echo $paginator->sort('id');?></th>
	<th scope="col"><?php echo $paginator->sort('name');?></th>
	<th scope="col"><?php echo $paginator->sort('contentType');?></th>
	<th scope="col"><?php echo $paginator->sort('updateFreqInMinutes');?></th>
	<th scope="col"><?php echo $paginator->sort('defaultTags');?></th>
	<th scope="col"><?php echo $paginator->sort('authType');?></th>
	<th scope="col"><?php echo $paginator->sort('authUserName');?></th>
	<th scope="col"><?php echo $paginator->sort('authPassword');?></th>
	<th scope="col"><?php echo $paginator->sort('created');?></th>
	<th scope="col"><?php echo $paginator->sort('modified');?></th>
	<th scope="col"><?php echo $paginator->sort('crawlerStatus');?></th>
	<th scope="col"><?php echo $paginator->sort('sources');?></th>
	<th class="actions" scope="col"><?php __('Actions');?></th>
</tr>
</thead>
<tfoot>
	<tr>
		<td colspan="13">
			<em>
				<div class="paging">
					<?php echo $paginator->prev('<< '.__('previous', true), array(), null, array('class'=>'disabled'));?>
				 | 	<?php echo $paginator->numbers();?>
					<?php echo $paginator->next(__('next', true).' >>', array(), null, array('class'=>'disabled'));?>
				</div>
			</em>
			<div class="actions">
				<ul>
					<li><?php echo $html->link(__('New Datafeed', true), array('controller' => 'datafeeds','action' => 'admin_add')); ?></li>
				</ul>
			</div>
		</td>
	</tr>
</tfoot>
<tbody>
<?php
$i = 0;
foreach ($datafeeds as $datafeed):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $datafeed['Datafeed']['id']; ?>
		</td>
		<td>
			<?php echo $datafeed['Datafeed']['name']; ?>
		</td>
		<td>
			<?php echo $datafeed['Datafeed']['contentType']; ?>
		</td>
		<td>
			<?php echo $datafeed['Datafeed']['updateFreqInMinutes']; ?>
		</td>
		<td>
			<?php echo $datafeed['Datafeed']['defaultTags']; ?>
		</td>
		<td>
			<?php echo $datafeed['Datafeed']['authType']; ?>
		</td>
		<td>
			<?php echo $datafeed['Datafeed']['authUserName']; ?>
		</td>
		<td>
			<?php echo $datafeed['Datafeed']['authPassword']; ?>
		</td>
		<td>
			<?php echo $datafeed['Datafeed']['created']; ?>
		</td>
		<td>
			<?php echo $datafeed['Datafeed']['modified']; ?>
		</td>
		<td>
			<?php echo $datafeed['Datafeed']['crawlerStatus']; ?>
		</td>
		<td>
			<?php echo $datafeed['Datafeed']['sources']; ?>
		</td>
		<td class="actions">
			<?php echo $html->link(__('View', true), '/admin/datafeeds/view/'.$datafeed['Datafeed']['id']); ?>
			<?php echo $html->link(__('Edit', true), '/admin/datafeeds/edit/'.$datafeed['Datafeed']['id']); ?>
			<?php echo $html->link(__('Delete', true), '/admin/datafeeds/delete/'.$datafeed['Datafeed']['id'], null, sprintf(__('Are you sure you want to delete # %s?', true), $datafeed['Datafeed']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
</tbody>
</table>
</div>
