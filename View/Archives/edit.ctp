<div class="archives form">
<?php echo $this->Form->create('Archive'); ?>
	<fieldset>
		<legend><?php echo __('Edit Archive'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('archive_name');
		echo $this->Form->input('family_name');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Archive.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Archive.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Archives'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Ancestordocuments'), array('controller' => 'ancestordocuments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Ancestordocument'), array('controller' => 'ancestordocuments', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Applicantdocuments'), array('controller' => 'applicantdocuments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Applicantdocument'), array('controller' => 'applicantdocuments', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Applicants'), array('controller' => 'applicants', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Applicant'), array('controller' => 'applicants', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Clients'), array('controller' => 'clients', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Client'), array('controller' => 'clients', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Paperfiles'), array('controller' => 'paperfiles', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Paperfile'), array('controller' => 'paperfiles', 'action' => 'add')); ?> </li>
	</ul>
</div>
