<div class="casestatuses index">
	<h2><?php echo __('Casestatuses'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('clientcase_id'); ?></th>
			<th><?php echo $this->Paginator->sort('status_id'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($casestatuses as $casestatus): ?>
	<tr>
		<td><?php echo h($casestatus['Casestatus']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($casestatus['Clientcase']['id'], array('controller' => 'clientcases', 'action' => 'view', $casestatus['Clientcase']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($casestatus['Status']['id'], array('controller' => 'statuses', 'action' => 'view', $casestatus['Status']['id'])); ?>
		</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $casestatus['Casestatus']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $casestatus['Casestatus']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $casestatus['Casestatus']['id']), null, __('Are you sure you want to delete # %s?', $casestatus['Casestatus']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Casestatus'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Clientcases'), array('controller' => 'clientcases', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Clientcase'), array('controller' => 'clientcases', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Statuses'), array('controller' => 'statuses', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Status'), array('controller' => 'statuses', 'action' => 'add')); ?> </li>
	</ul>
</div>
