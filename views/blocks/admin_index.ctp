<div class="blocks index">
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
<table id="newspaper-b" summary="Blocks Table">
<thead>
<tr>
	<th scope="col"><?php echo $paginator->sort('id');?></th>
	<th scope="col"><?php echo $paginator->sort('datafeed_id');?></th>
	<th scope="col"><?php echo $paginator->sort('uniqueIdentifier');?></th>
	<th class="actions" scope="col"><?php __('Actions');?></th>
</tr>
</thead>
<tfoot>
	<tr>
		<td colspan="4">
			<em>
				<div class="paging">
					<?php echo $paginator->prev('<< '.__('previous', true), null, null, array('class'=>'disabled'));?>
				 | 	<?php echo $paginator->numbers();?>
					<?php echo $paginator->next(__('next', true).' >>', null, null, array('class'=>'disabled'));?>
				</div>
			</em>
				<div class="actions">
					<ul>
						<li><?php echo $html->link(__('New Block', true), array('controller' => 'blocks','action' => 'admin_add')); ?></li>
					</ul>
				</div>
		</td>
	</tr>
</tfoot>
<tbody>
<?php
$i = 0;
foreach ($blocks as $block):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $block['Block']['id']; ?>
		</td>
		<td>
			<?php echo $block['Block']['datafeed_id']; ?>
		</td>
		<td>
			<?php echo $block['Block']['uniqueIdentifier']; ?>
		</td>
		<td class="actions">
			<?php echo $html->link(__('View', true), '/admin/blocks/view/'.$block['Block']['id']); ?>
			<?php echo $html->link(__('Edit', true), '/admin/blocks/edit/'.$block['Block']['id']); ?>
			<?php echo $html->link(__('Delete', true), '/admin/blocks/delete/'.$block['Block']['id'], null, sprintf(__('Are you sure you want to delete # %s?', true), $block['Block']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
</tbody>
</table>
</div>
