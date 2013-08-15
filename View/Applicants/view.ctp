<div class="applicants view">
<h2><?php  echo __('Applicant'); ?></h2>
	<dl>
		<dt><?php echo __('Client'); ?></dt>
		<dd>
			<?php echo $this->Html->link($applicant['Client']['id'], array('controller' => 'clients', 'action' => 'view', $applicant['Client']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Archive'); ?></dt>
		<dd>
			<?php echo $this->Html->link($applicant['Archive']['archive_name'], array('controller' => 'archives', 'action' => 'view', $applicant['Archive']['id'])); ?>
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
		<dt><?php echo __('Date Added'); ?></dt>
		<dd>
			<?php echo h($applicant['Applicant']['created']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="related">
	<h3><?php echo __('Related Addresses'); ?></h3>
	<?php if (!empty($applicant['Address'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Address'); ?></th>
		<th><?php echo __('Suburb'); ?></th>
		<th><?php echo __('Postcode'); ?></th>
		<th><?php echo __('State'); ?></th>
		<th><?php echo __('Country'); ?></th>
		<th><?php echo __('Status'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($applicant['Address'] as $address): ?>
		<tr>
    		<td><?php echo $address['address_line']; ?></td>
			<td><?php echo $address['suburb']; ?></td>
			<td><?php echo $address['postcode']; ?></td>
			<td><?php echo $address['state']; ?></td>
			<td><?php echo $address['country_id']; ?></td>
			<td><?php echo $address['status']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'addresses', 'action' => 'view', $address['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'addresses', 'action' => 'edit', $address['id'])); ?>
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
	<h3><?php echo __('Related Applicantdocuments'); ?></h3>
	<?php if (!empty($applicant['Applicantdocument'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Archive Id'); ?></th>
		<th><?php echo __('Applicant Id'); ?></th>
		<th><?php echo __('Document Type'); ?></th>
		<th><?php echo __('Note'); ?></th>
		<th><?php echo __('Filename'); ?></th>
		<th><?php echo __('Filesize'); ?></th>
		<th><?php echo __('Filemime'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($applicant['Applicantdocument'] as $applicantdocument): ?>
		<tr>
			<td><?php echo $applicantdocument['id']; ?></td>
			<td><?php echo $applicantdocument['archive_id']; ?></td>
			<td><?php echo $applicantdocument['applicant_id']; ?></td>
			<td><?php echo $applicantdocument['document_type']; ?></td>
			<td><?php echo $applicantdocument['note']; ?></td>
			<td><?php echo $applicantdocument['filename']; ?></td>
			<td><?php echo $applicantdocument['filesize']; ?></td>
			<td><?php echo $applicantdocument['filemime']; ?></td>
			<td><?php echo $applicantdocument['created']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'applicantdocuments', 'action' => 'view', $applicantdocument['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'applicantdocuments', 'action' => 'edit', $applicantdocument['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'applicantdocuments', 'action' => 'delete', $applicantdocument['id']), null, __('Are you sure you want to delete # %s?', $applicantdocument['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Applicantdocument'), array('controller' => 'applicantdocuments', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
