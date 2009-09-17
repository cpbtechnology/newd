<div class="datafeeds view">
	<table id="newspaper-b" summary="Datafeed Detail">
	<thead>
		<tr>
			<th scope="col"><?php  __('Datafeed');?></th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>
				<div><strong><?php __('Id'); ?>:</strong></div>
				<div><?php echo $datafeed['Datafeed']['id']; ?></div>
			</td>
		</tr>
		<tr>
			<td>
				<div><strong><?php __('Name'); ?>:</strong></div>
				<div><?php echo $datafeed['Datafeed']['name']; ?></div>
			</td>
		</tr>
		<tr>
			<td>
				<div><strong><?php __('ContentType'); ?>:</strong></div>
				<div><?php echo $datafeed['Datafeed']['contentType']; ?></div>
			</td>
		</tr>
		<tr>
			<td>
				<div><strong><?php __('UpdateFreqInMinutes'); ?>:</strong></div>
				<div><?php echo $datafeed['Datafeed']['updateFreqInMinutes']; ?></div>
			</td>
		</tr>
		<tr>
			<td>
				<div><strong><?php __('DefaultTags'); ?>:</strong></div>
				<div><?php echo $datafeed['Datafeed']['defaultTags']; ?></div>
			</td>
		</tr>
		<tr>
			<td>
				<div><strong><?php __('AuthType'); ?>:</strong></div>
				<div><?php echo $datafeed['Datafeed']['authType']; ?></div>
			</td>
		</tr>
		<tr>
			<td>
				<div><strong><?php __('AuthUserName'); ?>:</strong></div>
				<div><?php echo $datafeed['Datafeed']['authUserName']; ?></div>
			</td>
		</tr>
		<tr>
			<td>
				<div><strong><?php __('AuthPassword'); ?>:</strong></div>
				<div><?php echo $datafeed['Datafeed']['authPassword']; ?></div>
			</td>
		</tr>
		<tr>
			<td>
				<div><strong><?php __('Created'); ?>:</strong></div>
				<div><?php echo $datafeed['Datafeed']['created']; ?></div>
			</td>
		</tr>
		<tr>
			<td>
				<div><strong><?php __('Modified'); ?>:</strong></div>
				<div><?php echo $datafeed['Datafeed']['modified']; ?></div>
			</td>
		</tr>
		<tr>
			<td>
				<div><strong><?php __('CrawlerStatus'); ?>:</strong></div>
				<div><?php echo $datafeed['Datafeed']['crawlerStatus']; ?></div>
			</td>
		</tr>
		<tr>
			<td>
				<div><strong><?php __('Sources'); ?>:</strong></div>
				<div><?php echo $datafeed['Datafeed']['sources']; ?></div>
			</td>
		</tr>
	</tbody>
	<tfoot>
		<tr>
			<td >
				<div class="actions">
					<ul>
						<li><?php echo $html->link(__('Edit Datafeed', true), '/admin/datafeeds/edit/'.$datafeed['Datafeed']['id']); ?> </li>
						<li><?php echo $html->link(__('Delete Datafeed', true), '/admin/datafeeds/delete/'.$datafeed['Datafeed']['id'], null, sprintf(__('Are you sure you want to delete # %s?', true), $datafeed['Datafeed']['id'])); ?> </li>
						<li><?php echo $html->link(__('List Datafeeds', true), array('controller' => 'datafeeds','action' => 'admin_index')); ?> </li>
						<li><?php echo $html->link(__('New Datafeed', true), array('controller' => 'datafeeds','action' => 'admin_add')); ?> </li>
					</ul>
				</div>
			</td>
		</tr>
	</tfoot>
	</table>
</div>
