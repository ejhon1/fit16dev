<div class="applicants index">
	<h2><?php echo __('Applicants'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('client_id'); ?></th>
			<th><?php echo $this->Paginator->sort('archive_id'); ?></th>
			<th><?php echo $this->Paginator->sort('title'); ?></th>
			<th><?php echo $this->Paginator->sort('first_name'); ?></th>
			<th><?php echo $this->Paginator->sort('middle_name'); ?></th>
			<th><?php echo $this->Paginator->sort('surname'); ?></th>
			<th><?php echo $this->Paginator->sort('email'); ?></th>
			<th><?php echo $this->Paginator->sort('landline_number'); ?></th>
			<th><?php echo $this->Paginator->sort('mobile_number'); ?></th>
			<th><?php echo $this->Paginator->sort('applicant_type'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($applicants as $applicant): ?>
	<tr>
		<td><?php echo h($applicant['Applicant']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($applicant['Client']['id'], array('controller' => 'clients', 'action' => 'view', $applicant['Client']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($applicant['Archive']['id'], array('controller' => 'archives', 'action' => 'view', $applicant['Archive']['id'])); ?>
		</td>
		<td><?php echo h($applicant['Applicant']['title']); ?>&nbsp;</td>
		<td><?php echo h($applicant['Applicant']['first_name']); ?>&nbsp;</td>
		<td><?php echo h($applicant['Applicant']['middle_name']); ?>&nbsp;</td>
		<td><?php echo h($applicant['Applicant']['surname']); ?>&nbsp;</td>
		<td><?php echo h($applicant['Applicant']['email']); ?>&nbsp;</td>
		<td><?php echo h($applicant['Applicant']['landline_number']); ?>&nbsp;</td>
		<td><?php echo h($applicant['Applicant']['mobile_number']); ?>&nbsp;</td>
		<td><?php echo h($applicant['Applicant']['applicant_type']); ?>&nbsp;</td>
		<td><?php echo h($applicant['Applicant']['created']); ?>&nbsp;</td>
		<td><?php echo h($applicant['Applicant']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $applicant['Applicant']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $applicant['Applicant']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $applicant['Applicant']['id']), null, __('Are you sure you want to delete # %s?', $applicant['Applicant']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Applicant'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Clients'), array('controller' => 'clients', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Client'), array('controller' => 'clients', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Archives'), array('controller' => 'archives', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Archive'), array('controller' => 'archives', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Addresses'), array('controller' => 'addresses', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Address'), array('controller' => 'addresses', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Applicantdocuments'), array('controller' => 'applicantdocuments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Applicantdocument'), array('controller' => 'applicantdocuments', 'action' => 'add')); ?> </li>
	</ul>
</div>
