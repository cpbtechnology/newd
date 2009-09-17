<div class="modules index">
<!-- h2><?php __('Modules');?></h2 -->
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
<table id="newspaper-b" summary="Modules Table">
<thead>
<tr>
	<th scope="col"><?php echo $paginator->sort('id');?></th>
	<th scope="col"><?php echo $paginator->sort('name');?></th>
	<th scope="col"><?php echo $paginator->sort('status');?></th>
	<th scope="col"><?php echo $paginator->sort('minSize');?></th>
	<th scope="col"><?php echo $paginator->sort('maxSize');?></th>
	<th scope="col"><?php echo $paginator->sort('updateType');?></th>
	<th scope="col"><?php echo $paginator->sort('updateid');?></th>
	<th scope="col"><?php echo $paginator->sort('updateInSeconds');?></th>
	<th scope="col"><?php echo $paginator->sort('datafeed_id');?></th>
	<th scope="col"><?php echo $paginator->sort('datafeed_tags');?></th>
	<th scope="col"><?php echo $paginator->sort('datafeed_tag_restriction');?></th>
	<th scope="col"><?php echo $paginator->sort('layout_tag');?></th>
	<th scope="col"><?php echo $paginator->sort('created');?></th>
	<th scope="col"><?php echo $paginator->sort('modified');?></th>
	<th class="actions" scope="col"><?php __('Actions');?></th>
</tr>
</thead>
<tfoot>
	<tr>
		<td colspan="15">
			<em>
				<div class="paging">
					<?php echo $paginator->prev('<< '.__('previous', true), array(), null, array('class'=>'disabled'));?>
				 | 	<?php echo $paginator->numbers();?>
					<?php echo $paginator->next(__('next', true).' >>', array(), null, array('class'=>'disabled'));?>
				</div>
			</em>
			<div class="actions">
				<ul>
					<li><?php echo $html->link(__('New Module', true), array('controller' => 'modules','action' => 'admin_add')); ?></li>
				</ul>
			</div>
		</td>
	</tr>
</tfoot>
<tbody>
<?php
$i = 0;
foreach ($modules as $module):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $module['Module']['id']; ?>
		</td>
		<td>
			<?php echo $module['Module']['name']; ?>
		</td>
		<td>
			<?php echo $module['Module']['status']; ?>
		</td>
		<td>
			<?php echo $module['Module']['minSize']; ?>
		</td>
		<td>
			<?php echo $module['Module']['maxSize']; ?>
		</td>
		<td>
			<?php echo $module['Module']['updateType']; ?>
		</td>
		<td>
			<?php echo $module['Module']['updateid']; ?>
		</td>
		<td>
			<?php echo $module['Module']['updateInSeconds']; ?>
		</td>
		<td>
			<?php echo $module['Module']['datafeed_id']; ?>
		</td>
		<td>
			<?php echo $module['Module']['datafeed_tags']; ?>
		</td>
		<td>
			<?php echo $module['Module']['datafeed_tag_restriction']; ?>
		</td>
		<td>
			<?php echo $module['Module']['layout_tag']; ?>
		</td>
		<td>
			<?php echo $module['Module']['created']; ?>
		</td>
		<td>
			<?php echo $module['Module']['modified']; ?>
		</td>
		<td class="actions">
			<?php echo $html->link(__('View', true), '/admin/modules/view/'.$module['Module']['id']); ?>
			<?php echo $html->link(__('Edit', true), '/admin/modules/edit/'.$module['Module']['id']); ?>
			<?php echo $html->link(__('Delete', true), '/admin/modules/delete/'.$module['Module']['id'], null, sprintf(__('Are you sure you want to delete # %s?', true), $module['Module']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
</tbody>
</table>
</div>
