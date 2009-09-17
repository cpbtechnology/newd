<div class="topics index">
<!-- h2><?php __('Topics');?></h2 -->
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
<table id="newspaper-b" summary="Topics Table">
<thead>
<tr>
	<th scope="col"><?php echo $paginator->sort('id');?></th>
	<th scope="col"><?php echo $paginator->sort('name');?></th>
	<th scope="col"><?php echo $paginator->sort('abbr');?></th>
	<th scope="col"><?php echo $paginator->sort('navIcon');?></th>
	<th scope="col"><?php echo $paginator->sort('created');?></th>
	<th scope="col"><?php echo $paginator->sort('modified');?></th>
	<th class="actions" scope="col"><?php __('Actions');?></th>
</tr>
</thead>
<tfoot>
	<tr>
		<td colspan="7">
			<em>
				<div class="paging">
					<?php echo $paginator->prev('<< '.__('previous', true), array(), null, array('class'=>'disabled'));?>
				 | 	<?php echo $paginator->numbers();?>
					<?php echo $paginator->next(__('next', true).' >>', array(), null, array('class'=>'disabled'));?>
				</div>
			</em>
			<div class="actions">
				<ul>
					<li><?php echo $html->link(__('New Topic', true), array('controller' => 'topics','action' => 'admin_add')); ?></li>
				</ul>
			</div>

		</td>
	</tr>
</tfoot>
<tbody>
<?php
$i = 0;
foreach ($topics as $topic):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $topic['Topic']['id']; ?>
		</td>
		<td>
			<?php echo $topic['Topic']['name']; ?>
		</td>
		<td>
			<?php echo $topic['Topic']['abbr']; ?>
		</td>
		<td>
			<?php echo $topic['Topic']['navIcon']; ?>
		</td>
		<td>
			<?php echo $topic['Topic']['created']; ?>
		</td>
		<td>
			<?php echo $topic['Topic']['modified']; ?>
		</td>
		<td class="actions">
			<?php echo $html->link(__('View', true), '/admin/topics/view/'.$topic['Topic']['id']/*array('action'=>'admin_view', $topic['Topic']['id'])*/); ?>
			<?php echo $html->link(__('Edit', true), '/admin/topics/edit/'.$topic['Topic']['id']); ?>
			<?php echo $html->link(__('Delete', true), '/admin/topics/delete/'.$topic['Topic']['id'], null, sprintf(__('Are you sure you want to delete # %s?', true), $topic['Topic']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
</tbody>
</table>
</div>
