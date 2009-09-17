<div class="datarows index">
<!-- h2><?php __('Datarows');?></h2 -->
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
<table id="newspaper-b" summary="Datarows Table">
<thead>
<tr>
	<th scope="col"><?php echo $paginator->sort('id');?></th>
	<th scope="col"><?php echo $paginator->sort('datafeed_id');?></th>
	<th scope="col"><?php echo $paginator->sort('topicName');?></th>
	<th scope="col"><?php echo $paginator->sort('published');?></th>
	<th scope="col"><?php echo $paginator->sort('articleId');?></th>
	<th scope="col"><?php echo $paginator->sort('title');?></th>
	<th scope="col"><?php echo $paginator->sort('content');?></th>
	<th scope="col"><?php echo $paginator->sort('thumb');?></th>
	<th scope="col"><?php echo $paginator->sort('author');?></th>
	<th scope="col"><?php echo $paginator->sort('rating');?></th>
	<th scope="col"><?php echo $paginator->sort('created');?></th>
	<th scope="col"><?php echo $paginator->sort('modified');?></th>
	<th scope="col"><?php echo $paginator->sort('tags');?></th>
	<th scope="col"><?php echo $paginator->sort('cpbTags');?></th>
	<th scope="col"><?php echo $paginator->sort('flagged');?></th>
	<th scope="col"><?php echo $paginator->sort('blocked');?></th>
	<th class="actions" scope="col"><?php __('Actions');?></th>
</tr>
</thead>
<tfoot>
	<tr>
		<td colspan="17">
			<em>
				<div class="paging">
					<?php echo $paginator->prev('<< '.__('previous', true), array(), null, array('class'=>'disabled'));?>
				 | 	<?php echo $paginator->numbers();?>
					<?php echo $paginator->next(__('next', true).' >>', array(), null, array('class'=>'disabled'));?>
				</div>
			</em>
			<div class="actions">
				<ul>
					<li><?php echo $html->link(__('New Datarow', true), array('controller' => 'datarows','action' => 'admin_add')); ?></li>
				</ul>
			</div>
		</td>
	</tr>
</tfoot>
<tbody>
<?php
$i = 0;
foreach ($datarows as $datarow):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $datarow['Datarow']['id']; ?>
		</td>
		<td>
			<?php echo $datarow['Datarow']['datafeed_id']; ?>
		</td>
		<td>
			<?php echo $datarow['Datarow']['topicName']; ?>
		</td>
		<td>
			<?php echo $datarow['Datarow']['published']; ?>
		</td>
		<td>
			<?php echo $datarow['Datarow']['articleId']; ?>
		</td>
		<td>
			<?php echo $datarow['Datarow']['title']; ?>
		</td>
		<td>
			<?php echo $datarow['Datarow']['content']; ?>
		</td>
		<td>
			<?php echo $datarow['Datarow']['thumb']; ?>
		</td>
		<td>
			<?php echo $datarow['Datarow']['author']; ?>
		</td>
		<td>
			<?php echo $datarow['Datarow']['rating']; ?>
		</td>
		<td>
			<?php echo $datarow['Datarow']['created']; ?>
		</td>
		<td>
			<?php echo $datarow['Datarow']['modified']; ?>
		</td>
		<td>
			<?php echo $datarow['Datarow']['tags']; ?>
		</td>
		<td>
			<?php echo $datarow['Datarow']['cpbTags']; ?>
		</td>
		<td>
			<?php echo $datarow['Datarow']['flagged']; ?>
		</td>
		<td>
			<?php echo $datarow['Datarow']['blocked']; ?>
		</td>
		<td class="actions">
			<?php echo $html->link(__('View', true), '/admin/datarows/view/'.$datarow['Datarow']['id']); ?>
			<?php echo $html->link(__('Edit', true), '/admin/datarows/edit/'.$datarow['Datarow']['id']); ?>
			<?php echo $html->link(__('Delete', true), '/admin/datarows/delete/'.$datarow['Datarow']['id'], null, sprintf(__('Are you sure you want to delete # %s?', true), $datarow['Datarow']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
</tbody>
</table>
</div>
