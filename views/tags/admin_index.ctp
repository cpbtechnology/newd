<div class="tags index">
<!-- h2><?php __('Tags');?></h2 -->
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
<table id="newspaper-b" summary="Tags Table">
<thead>
<tr>
	<th scope="col"><?php echo $paginator->sort('id');?></th>
	<th scope="col"><?php echo $paginator->sort('name');?></th>
	<th scope="col"><?php echo $paginator->sort('topic_id');?></th>
	<th scope="col"><?php echo $paginator->sort('type');?></th>
	<th scope="col"><?php echo $paginator->sort('Rating');?></th>
	<th scope="col"><?php echo $paginator->sort('datafeed_ids');?></th>
	<th scope="col"><?php echo $paginator->sort('status');?></th>
	<th scope="col"><?php echo $paginator->sort('created');?></th>
	<th scope="col"><?php echo $paginator->sort('modified');?></th>
	<th class="actions" scope="col"><?php __('Actions');?></th>
</tr>
</thead>
<tfoot>
	<tr>
		<td colspan="10">
			<em>
				<div class="paging">
					<?php echo $paginator->prev('<< '.__('previous', true), null, null, array('class'=>'disabled'));?>
				 | 	<?php echo $paginator->numbers();?>
					<?php echo $paginator->next(__('next', true).' >>', null, null, array('class'=>'disabled'));?>
				</div>
			</em>
				<div class="actions">
					<ul>
						<li><?php echo $html->link(__('New Tag', true), array('controller' => 'tags','action' => 'admin_add')); ?></li>
					</ul>
				</div>
		</td>
	</tr>
</tfoot>
<tbody>
<?php
$i = 0;
foreach ($tags as $tag):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $tag['Tag']['id']; ?>
		</td>
		<td>
			<?php echo $tag['Tag']['name']; ?>
		</td>
		<td>
			<?php echo $tag['Tag']['topic_id']; ?>
		</td>
		<td>
			<?php echo $tag['Tag']['type']; ?>
		</td>
		<td>
			<?php echo $tag['Tag']['Rating']; ?>
		</td>
		<td>
			<?php echo $tag['Tag']['datafeed_ids']; ?>
		</td>
		<td>
			<?php echo $tag['Tag']['status']; ?>
		</td>
		<td>
			<?php echo $tag['Tag']['created']; ?>
		</td>
		<td>
			<?php echo $tag['Tag']['modified']; ?>
		</td>
		<td class="actions">
			<?php echo $html->link(__('View', true), '/admin/tags/view/'.$tag['Tag']['id']); ?>
			<?php echo $html->link(__('Edit', true), '/admin/tags/edit/'.$tag['Tag']['id']); ?>
			<?php echo $html->link(__('Delete', true), '/admin/tags/delete/'.$tag['Tag']['id'], null, sprintf(__('Are you sure you want to delete # %s?', true), $tag['Tag']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
</tbody>
</table>
</div>
