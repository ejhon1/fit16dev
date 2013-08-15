<div class="applicants form">
<?php echo $this->Form->create('Applicant'); ?>
	<fieldset>
		<legend><?php echo __('Edit Applicant'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('client_id');
		echo $this->Form->input('archive_id');
		echo $this->Form->input('title');
		echo $this->Form->input('first_name');
		echo $this->Form->input('middle_name');
		echo $this->Form->input('surname');
		echo $this->Form->input('email');
		echo $this->Form->input('landline_number');
		echo $this->Form->input('mobile_number');
		echo $this->Form->input('applicant_type');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Applicant.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Applicant.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Applicants'), array('action' => 'index')); ?></li>
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
