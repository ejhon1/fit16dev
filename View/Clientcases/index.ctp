<div class="clientcases index">
	<h2><?php echo __('Clientcases'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('user_id'); ?></th>
			<th><?php echo $this->Paginator->sort('archive_id'); ?></th>
			<th><?php echo $this->Paginator->sort('status_id'); ?></th>
			<th><?php echo $this->Paginator->sort('applicant_id'); ?></th>
			<th><?php echo $this->Paginator->sort('open_or_closed'); ?></th>
			<th><?php echo $this->Paginator->sort('enquiry_date'); ?></th>
			<th><?php echo $this->Paginator->sort('appointment_date'); ?></th>
			<th><?php echo $this->Paginator->sort('born_in_poland'); ?></th>
			<th><?php echo $this->Paginator->sort('nationality_of_parents'); ?></th>
			<th><?php echo $this->Paginator->sort('mother_name'); ?></th>
			<th><?php echo $this->Paginator->sort('father_name'); ?></th>
			<th><?php echo $this->Paginator->sort('nationality_of_grandparents'); ?></th>
			<th><?php echo $this->Paginator->sort('mat_grandmother_name'); ?></th>
			<th><?php echo $this->Paginator->sort('mat_grandfather_name'); ?></th>
			<th><?php echo $this->Paginator->sort('pat_grandmother_name'); ?></th>
			<th><?php echo $this->Paginator->sort('pat_grandfather_name'); ?></th>
			<th><?php echo $this->Paginator->sort('nationality_of_others'); ?></th>
			<th><?php echo $this->Paginator->sort('serve_in_army'); ?></th>
			<th><?php echo $this->Paginator->sort('serve_in_army_info'); ?></th>
			<th><?php echo $this->Paginator->sort('when_left_poland'); ?></th>
			<th><?php echo $this->Paginator->sort('where_left_poland'); ?></th>
			<th><?php echo $this->Paginator->sort('where_left_poland_other'); ?></th>
			<th><?php echo $this->Paginator->sort('have_passport'); ?></th>
			<th><?php echo $this->Paginator->sort('possess_documents'); ?></th>
			<th><?php echo $this->Paginator->sort('possess_documents_types'); ?></th>
			<th><?php echo $this->Paginator->sort('possess_documents_other'); ?></th>
			<th><?php echo $this->Paginator->sort('other_factors'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($clientcases as $clientcase): ?>
	<tr>
		<td><?php echo h($clientcase['Clientcase']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($clientcase['User']['id'], array('controller' => 'users', 'action' => 'view', $clientcase['User']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($clientcase['Archive']['id'], array('controller' => 'archives', 'action' => 'view', $clientcase['Archive']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($clientcase['Status']['id'], array('controller' => 'statuses', 'action' => 'view', $clientcase['Status']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($clientcase['Applicant']['title'], array('controller' => 'applicants', 'action' => 'view', $clientcase['Applicant']['id'])); ?>
		</td>
		<td><?php echo h($clientcase['Clientcase']['open_or_closed']); ?>&nbsp;</td>
		<td><?php echo h($clientcase['Clientcase']['enquiry_date']); ?>&nbsp;</td>
		<td><?php echo h($clientcase['Clientcase']['appointment_date']); ?>&nbsp;</td>
		<td><?php echo h($clientcase['Clientcase']['born_in_poland']); ?>&nbsp;</td>
		<td><?php echo h($clientcase['Clientcase']['nationality_of_parents']); ?>&nbsp;</td>
		<td><?php echo h($clientcase['Clientcase']['mother_name']); ?>&nbsp;</td>
		<td><?php echo h($clientcase['Clientcase']['father_name']); ?>&nbsp;</td>
		<td><?php echo h($clientcase['Clientcase']['nationality_of_grandparents']); ?>&nbsp;</td>
		<td><?php echo h($clientcase['Clientcase']['mat_grandmother_name']); ?>&nbsp;</td>
		<td><?php echo h($clientcase['Clientcase']['mat_grandfather_name']); ?>&nbsp;</td>
		<td><?php echo h($clientcase['Clientcase']['pat_grandmother_name']); ?>&nbsp;</td>
		<td><?php echo h($clientcase['Clientcase']['pat_grandfather_name']); ?>&nbsp;</td>
		<td><?php echo h($clientcase['Clientcase']['nationality_of_others']); ?>&nbsp;</td>
		<td><?php echo h($clientcase['Clientcase']['serve_in_army']); ?>&nbsp;</td>
		<td><?php echo h($clientcase['Clientcase']['serve_in_army_info']); ?>&nbsp;</td>
		<td><?php echo h($clientcase['Clientcase']['when_left_poland']); ?>&nbsp;</td>
		<td><?php echo h($clientcase['Clientcase']['where_left_poland']); ?>&nbsp;</td>
		<td><?php echo h($clientcase['Clientcase']['where_left_poland_other']); ?>&nbsp;</td>
		<td><?php echo h($clientcase['Clientcase']['have_passport']); ?>&nbsp;</td>
		<td><?php echo h($clientcase['Clientcase']['possess_documents']); ?>&nbsp;</td>
		<td><?php echo h($clientcase['Clientcase']['possess_documents_types']); ?>&nbsp;</td>
		<td><?php echo h($clientcase['Clientcase']['possess_documents_other']); ?>&nbsp;</td>
		<td><?php echo h($clientcase['Clientcase']['other_factors']); ?>&nbsp;</td>
		<td><?php echo h($clientcase['Clientcase']['created']); ?>&nbsp;</td>
		<td><?php echo h($clientcase['Clientcase']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $clientcase['Clientcase']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $clientcase['Clientcase']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $clientcase['Clientcase']['id']), null, __('Are you sure you want to delete # %s?', $clientcase['Clientcase']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Clientcase'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Archives'), array('controller' => 'archives', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Archive'), array('controller' => 'archives', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Statuses'), array('controller' => 'statuses', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Status'), array('controller' => 'statuses', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Applicants'), array('controller' => 'applicants', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Applicant'), array('controller' => 'applicants', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Casenotes'), array('controller' => 'casenotes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Casenote'), array('controller' => 'casenotes', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Casestatuses'), array('controller' => 'casestatuses', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Casestatus'), array('controller' => 'casestatuses', 'action' => 'add')); ?> </li>
	</ul>
</div>
