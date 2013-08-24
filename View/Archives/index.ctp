<div class="archives index">
	<h2><?php echo __('Archives'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('archive_name'); ?></th>
			<th><?php echo $this->Paginator->sort('family_name'); ?></th>
			<th><?php echo $this->Paginator->sort('file_status'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($archives as $archife): ?>
	<tr>
		<td><?php echo h($archife['Archife']['id']); ?>&nbsp;</td>
		<td><?php echo h($archife['Archife']['archive_name']); ?>&nbsp;</td>
		<td><?php echo h($archife['Archife']['family_name']); ?>&nbsp;</td>
		<td><?php echo h($archife['Archife']['file_status']); ?>&nbsp;</td>
		<td><?php echo h($archife['Archife']['created']); ?>&nbsp;</td>
		<td><?php echo h($archife['Archife']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $archife['Archife']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $archife['Archife']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $archife['Archife']['id']), null, __('Are you sure you want to delete # %s?', $archife['Archife']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Archife'), array('action' => 'add')); ?></li>
	</ul>
</div>
