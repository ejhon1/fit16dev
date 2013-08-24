<div class="users view">
<h2><?php echo __('User'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($user['User']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Username'); ?></dt>
		<dd>
			<?php echo h($user['User']['username']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Password'); ?></dt>
		<dd>
			<?php echo h($user['User']['password']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Type'); ?></dt>
		<dd>
			<?php echo h($user['User']['type']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($user['User']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($user['User']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit User'), array('action' => 'edit', $user['User']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete User'), array('action' => 'delete', $user['User']['id']), null, __('Are you sure you want to delete # %s?', $user['User']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Casenotes'), array('controller' => 'casenotes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Casenote'), array('controller' => 'casenotes', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Clientcases'), array('controller' => 'clientcases', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Clientcase'), array('controller' => 'clientcases', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Docnotes'), array('controller' => 'docnotes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Docnote'), array('controller' => 'docnotes', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Employees'), array('controller' => 'employees', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Employee'), array('controller' => 'employees', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Casenotes'); ?></h3>
	<?php if (!empty($user['Casenote'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Clientcase Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Notesubject Id'); ?></th>
		<th><?php echo __('Note Type'); ?></th>
		<th><?php echo __('Note'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($user['Casenote'] as $casenote): ?>
		<tr>
			<td><?php echo $casenote['id']; ?></td>
			<td><?php echo $casenote['clientcase_id']; ?></td>
			<td><?php echo $casenote['user_id']; ?></td>
			<td><?php echo $casenote['notesubject_id']; ?></td>
			<td><?php echo $casenote['note_type']; ?></td>
			<td><?php echo $casenote['note']; ?></td>
			<td><?php echo $casenote['created']; ?></td>
			<td><?php echo $casenote['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'casenotes', 'action' => 'view', $casenote['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'casenotes', 'action' => 'edit', $casenote['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'casenotes', 'action' => 'delete', $casenote['id']), null, __('Are you sure you want to delete # %s?', $casenote['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Casenote'), array('controller' => 'casenotes', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Clientcases'); ?></h3>
	<?php if (!empty($user['Clientcase'])): ?>
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
		foreach ($user['Clientcase'] as $clientcase): ?>
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
<div class="related">
	<h3><?php echo __('Related Docnotes'); ?></h3>
	<?php if (!empty($user['Docnote'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Document Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Note'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($user['Docnote'] as $docnote): ?>
		<tr>
			<td><?php echo $docnote['id']; ?></td>
			<td><?php echo $docnote['document_id']; ?></td>
			<td><?php echo $docnote['user_id']; ?></td>
			<td><?php echo $docnote['note']; ?></td>
			<td><?php echo $docnote['created']; ?></td>
			<td><?php echo $docnote['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'docnotes', 'action' => 'view', $docnote['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'docnotes', 'action' => 'edit', $docnote['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'docnotes', 'action' => 'delete', $docnote['id']), null, __('Are you sure you want to delete # %s?', $docnote['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Docnote'), array('controller' => 'docnotes', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Employees'); ?></h3>
	<?php if (!empty($user['Employee'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('First Name'); ?></th>
		<th><?php echo __('Surname'); ?></th>
		<th><?php echo __('Status'); ?></th>
		<th><?php echo __('Email'); ?></th>
		<th><?php echo __('Role Id'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($user['Employee'] as $employee): ?>
		<tr>
			<td><?php echo $employee['id']; ?></td>
			<td><?php echo $employee['user_id']; ?></td>
			<td><?php echo $employee['first_name']; ?></td>
			<td><?php echo $employee['surname']; ?></td>
			<td><?php echo $employee['status']; ?></td>
			<td><?php echo $employee['email']; ?></td>
			<td><?php echo $employee['role_id']; ?></td>
			<td><?php echo $employee['created']; ?></td>
			<td><?php echo $employee['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'employees', 'action' => 'view', $employee['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'employees', 'action' => 'edit', $employee['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'employees', 'action' => 'delete', $employee['id']), null, __('Are you sure you want to delete # %s?', $employee['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Employee'), array('controller' => 'employees', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
