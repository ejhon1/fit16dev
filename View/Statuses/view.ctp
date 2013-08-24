<div class="statuses view">
<h2><?php echo __('Status'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($status['Status']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status Type'); ?></dt>
		<dd>
			<?php echo h($status['Status']['status_type']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Status'), array('action' => 'edit', $status['Status']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Status'), array('action' => 'delete', $status['Status']['id']), null, __('Are you sure you want to delete # %s?', $status['Status']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Statuses'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Status'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Casestatuses'), array('controller' => 'casestatuses', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Casestatus'), array('controller' => 'casestatuses', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Clientcases'), array('controller' => 'clientcases', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Clientcase'), array('controller' => 'clientcases', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Casestatuses'); ?></h3>
	<?php if (!empty($status['Casestatus'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Clientcase Id'); ?></th>
		<th><?php echo __('Status Id'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($status['Casestatus'] as $casestatus): ?>
		<tr>
			<td><?php echo $casestatus['id']; ?></td>
			<td><?php echo $casestatus['clientcase_id']; ?></td>
			<td><?php echo $casestatus['status_id']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'casestatuses', 'action' => 'view', $casestatus['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'casestatuses', 'action' => 'edit', $casestatus['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'casestatuses', 'action' => 'delete', $casestatus['id']), null, __('Are you sure you want to delete # %s?', $casestatus['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Casestatus'), array('controller' => 'casestatuses', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Clientcases'); ?></h3>
	<?php if (!empty($status['Clientcase'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Archive Id'); ?></th>
		<th><?php echo __('Status Id'); ?></th>
		<th><?php echo __('Applicant Id'); ?></th>
		<th><?php echo __('Open Or Closed'); ?></th>
		<th><?php echo __('Enquiry Date'); ?></th>
		<th><?php echo __('Appointment Date'); ?></th>
		<th><?php echo __('Born In Poland'); ?></th>
		<th><?php echo __('Nationality Of Parents'); ?></th>
		<th><?php echo __('Mother Name'); ?></th>
		<th><?php echo __('Father Name'); ?></th>
		<th><?php echo __('Nationality Of Grandparents'); ?></th>
		<th><?php echo __('Mat Grandmother Name'); ?></th>
		<th><?php echo __('Mat Grandfather Name'); ?></th>
		<th><?php echo __('Pat Grandmother Name'); ?></th>
		<th><?php echo __('Pat Grandfather Name'); ?></th>
		<th><?php echo __('Nationality Of Others'); ?></th>
		<th><?php echo __('Serve In Army'); ?></th>
		<th><?php echo __('Serve In Army Info'); ?></th>
		<th><?php echo __('When Left Poland'); ?></th>
		<th><?php echo __('Where Left Poland'); ?></th>
		<th><?php echo __('Where Left Poland Other'); ?></th>
		<th><?php echo __('Have Passport'); ?></th>
		<th><?php echo __('Possess Documents'); ?></th>
		<th><?php echo __('Possess Documents Types'); ?></th>
		<th><?php echo __('Possess Documents Other'); ?></th>
		<th><?php echo __('Other Factors'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($status['Clientcase'] as $clientcase): ?>
		<tr>
			<td><?php echo $clientcase['id']; ?></td>
			<td><?php echo $clientcase['user_id']; ?></td>
			<td><?php echo $clientcase['archive_id']; ?></td>
			<td><?php echo $clientcase['status_id']; ?></td>
			<td><?php echo $clientcase['applicant_id']; ?></td>
			<td><?php echo $clientcase['open_or_closed']; ?></td>
			<td><?php echo $clientcase['enquiry_date']; ?></td>
			<td><?php echo $clientcase['appointment_date']; ?></td>
			<td><?php echo $clientcase['born_in_poland']; ?></td>
			<td><?php echo $clientcase['nationality_of_parents']; ?></td>
			<td><?php echo $clientcase['mother_name']; ?></td>
			<td><?php echo $clientcase['father_name']; ?></td>
			<td><?php echo $clientcase['nationality_of_grandparents']; ?></td>
			<td><?php echo $clientcase['mat_grandmother_name']; ?></td>
			<td><?php echo $clientcase['mat_grandfather_name']; ?></td>
			<td><?php echo $clientcase['pat_grandmother_name']; ?></td>
			<td><?php echo $clientcase['pat_grandfather_name']; ?></td>
			<td><?php echo $clientcase['nationality_of_others']; ?></td>
			<td><?php echo $clientcase['serve_in_army']; ?></td>
			<td><?php echo $clientcase['serve_in_army_info']; ?></td>
			<td><?php echo $clientcase['when_left_poland']; ?></td>
			<td><?php echo $clientcase['where_left_poland']; ?></td>
			<td><?php echo $clientcase['where_left_poland_other']; ?></td>
			<td><?php echo $clientcase['have_passport']; ?></td>
			<td><?php echo $clientcase['possess_documents']; ?></td>
			<td><?php echo $clientcase['possess_documents_types']; ?></td>
			<td><?php echo $clientcase['possess_documents_other']; ?></td>
			<td><?php echo $clientcase['other_factors']; ?></td>
			<td><?php echo $clientcase['created']; ?></td>
			<td><?php echo $clientcase['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'clientcases', 'action' => 'view', $clientcase['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'clientcases', 'action' => 'edit', $clientcase['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'clientcases', 'action' => 'delete', $clientcase['id']), null, __('Are you sure you want to delete # %s?', $clientcase['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Clientcase'), array('controller' => 'clientcases', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
