<div class="paperfilelogs index">
	<h2><?php echo __('Paperfilelogs'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('archive_id'); ?></th>
			<th><?php echo $this->Paginator->sort('employee_id'); ?></th>
			<th><?php echo $this->Paginator->sort('date_borrowed'); ?></th>
			<th><?php echo $this->Paginator->sort('date_returned'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($paperfilelogs as $paperfilelog): ?>
	<tr>
		<td><?php echo h($paperfilelog['Paperfilelog']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($paperfilelog['Archive']['id'], array('controller' => 'archives', 'action' => 'view', $paperfilelog['Archive']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($paperfilelog['Employee']['id'], array('controller' => 'employees', 'action' => 'view', $paperfilelog['Employee']['id'])); ?>
		</td>
		<td><?php echo h($paperfilelog['Paperfilelog']['date_borrowed']); ?>&nbsp;</td>
		<td><?php echo h($paperfilelog['Paperfilelog']['date_returned']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $paperfilelog['Paperfilelog']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $paperfilelog['Paperfilelog']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $paperfilelog['Paperfilelog']['id']), null, __('Are you sure you want to delete # %s?', $paperfilelog['Paperfilelog']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Paperfilelog'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Archives'), array('controller' => 'archives', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Archive'), array('controller' => 'archives', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Employees'), array('controller' => 'employees', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Employee'), array('controller' => 'employees', 'action' => 'add')); ?> </li>
	</ul>
</div>
