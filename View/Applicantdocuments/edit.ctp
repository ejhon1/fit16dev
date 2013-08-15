<div class="applicantdocuments form">
<?php echo $this->Form->create('Applicantdocument'); ?>
	<fieldset>
		<legend><?php echo __('Edit Applicantdocument'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('archive_id');
		echo $this->Form->input('applicant_id');
		echo $this->Form->input('document_type');
		echo $this->Form->input('note');
		echo $this->Form->input('filename');
		echo $this->Form->input('filesize');
		echo $this->Form->input('filemime');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Applicantdocument.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Applicantdocument.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Applicantdocuments'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Archives'), array('controller' => 'archives', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Archive'), array('controller' => 'archives', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Applicants'), array('controller' => 'applicants', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Applicant'), array('controller' => 'applicants', 'action' => 'add')); ?> </li>
	</ul>
</div>
