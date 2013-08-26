<div class="clientcases index">
	<h2><?php echo __('Clientcases'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('archive_id'); ?></th>
			<th><?php echo $this->Paginator->sort('status_id'); ?></th>
			<th><?php echo $this->Paginator->sort('applicant_id'); ?></th>
			<th><?php echo $this->Paginator->sort('open_or_closed'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th class="actions"><?php echo __('View'); ?></th>
	</tr>
	<?php foreach ($clientcases as $clientcase): ?>
	<tr>
		<td>
			<?php echo $this->Html->link($clientcase['Archive']['archive_name'], array('controller' => 'archives', 'action' => 'view', $clientcase['Archive']['id'])); ?>
		</td>
		<td>
			<?php echo h($clientcase['Status']['status_type']); ?>
		</td>
		<td>
			<?php echo $this->Html->link($clientcase['Applicant']['first_name'].' '.$clientcase['Applicant']['surname'], array('controller' => 'applicants', 'action' => 'view', $clientcase['Applicant']['id'])); ?>
		</td>
		<td><?php echo h($clientcase['Clientcase']['open_or_closed']); ?>&nbsp;</td>
		<td><?php echo h($clientcase['Clientcase']['enquiry_date']); ?>&nbsp;</td>
		<td><?php echo h($clientcase['Clientcase']['created']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $clientcase['Clientcase']['id'])); ?>
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

