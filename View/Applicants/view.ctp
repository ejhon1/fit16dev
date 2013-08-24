<div class="applicants view">
<h2><?php echo __('Applicant'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($applicant['Applicant']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Clientcase'); ?></dt>
		<dd>
			<?php echo $this->Html->link($applicant['Clientcase']['id'], array('controller' => 'clientcases', 'action' => 'view', $applicant['Clientcase']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Archive'); ?></dt>
		<dd>
			<?php echo $this->Html->link($applicant['Archive']['id'], array('controller' => 'archives', 'action' => 'view', $applicant['Archive']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Birthdate'); ?></dt>
		<dd>
			<?php echo h($applicant['Applicant']['birthdate']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Title'); ?></dt>
		<dd>
			<?php echo h($applicant['Applicant']['title']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('First Name'); ?></dt>
		<dd>
			<?php echo h($applicant['Applicant']['first_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Middle Name'); ?></dt>
		<dd>
			<?php echo h($applicant['Applicant']['middle_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Surname'); ?></dt>
		<dd>
			<?php echo h($applicant['Applicant']['surname']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Email'); ?></dt>
		<dd>
			<?php echo h($applicant['Applicant']['email']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Landline Number'); ?></dt>
		<dd>
			<?php echo h($applicant['Applicant']['landline_number']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Mobile Number'); ?></dt>
		<dd>
			<?php echo h($applicant['Applicant']['mobile_number']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Applicant Type'); ?></dt>
		<dd>
			<?php echo h($applicant['Applicant']['applicant_type']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($applicant['Applicant']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($applicant['Applicant']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Applicant'), array('action' => 'edit', $applicant['Applicant']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Applicant'), array('action' => 'delete', $applicant['Applicant']['id']), null, __('Are you sure you want to delete # %s?', $applicant['Applicant']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Applicants'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Applicant'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Clientcases'), array('controller' => 'clientcases', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Clientcase'), array('controller' => 'clientcases', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Archives'), array('controller' => 'archives', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Archive'), array('controller' => 'archives', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Addresses'), array('controller' => 'addresses', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Address'), array('controller' => 'addresses', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Documents'), array('controller' => 'documents', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Document'), array('controller' => 'documents', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Addresses'); ?></h3>
	<?php if (!empty($applicant['Address'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Applicant Id'); ?></th>
		<th><?php echo __('Address Line'); ?></th>
		<th><?php echo __('Suburb'); ?></th>
		<th><?php echo __('Postcode'); ?></th>
		<th><?php echo __('State'); ?></th>
		<th><?php echo __('Country Id'); ?></th>
		<th><?php echo __('Status'); ?></th>
		<th><?php echo __('Date Changed'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($applicant['Address'] as $address): ?>
		<tr>
			<td><?php echo $address['id']; ?></td>
			<td><?php echo $address['applicant_id']; ?></td>
			<td><?php echo $address['address_line']; ?></td>
			<td><?php echo $address['suburb']; ?></td>
			<td><?php echo $address['postcode']; ?></td>
			<td><?php echo $address['state']; ?></td>
			<td><?php echo $address['country_id']; ?></td>
			<td><?php echo $address['status']; ?></td>
			<td><?php echo $address['date_changed']; ?></td>
			<td><?php echo $address['created']; ?></td>
			<td><?php echo $address['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'addresses', 'action' => 'view', $address['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'addresses', 'action' => 'edit', $address['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'addresses', 'action' => 'delete', $address['id']), null, __('Are you sure you want to delete # %s?', $address['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Address'), array('controller' => 'addresses', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Clientcases'); ?></h3>
	<?php if (!empty($applicant['Clientcase'])): ?>
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
		foreach ($applicant['Clientcase'] as $clientcase): ?>
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
	<h3><?php echo __('Related Documents'); ?></h3>
	<?php if (!empty($applicant['Document'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Archive Id'); ?></th>
		<th><?php echo __('Applicant Id'); ?></th>
		<th><?php echo __('Ancestortype Id'); ?></th>
		<th><?php echo __('Documenttype Id'); ?></th>
		<th><?php echo __('Filename'); ?></th>
		<th><?php echo __('Filesize'); ?></th>
		<th><?php echo __('Filemime'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($applicant['Document'] as $document): ?>
		<tr>
			<td><?php echo $document['id']; ?></td>
			<td><?php echo $document['archive_id']; ?></td>
			<td><?php echo $document['applicant_id']; ?></td>
			<td><?php echo $document['ancestortype_id']; ?></td>
			<td><?php echo $document['documenttype_id']; ?></td>
			<td><?php echo $document['filename']; ?></td>
			<td><?php echo $document['filesize']; ?></td>
			<td><?php echo $document['filemime']; ?></td>
			<td><?php echo $document['created']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'documents', 'action' => 'view', $document['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'documents', 'action' => 'edit', $document['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'documents', 'action' => 'delete', $document['id']), null, __('Are you sure you want to delete # %s?', $document['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Document'), array('controller' => 'documents', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
