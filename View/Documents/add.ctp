<div class="documents form">
<?php echo $this->Form->create('Document'); ?>
	<fieldset>
		<legend><?php echo __('Add Document'); ?></legend>
	<?php
		echo $this->Form->input('archive_id');
		echo $this->Form->input('applicant_id');
		echo $this->Form->input('ancestortype_id');
		echo $this->Form->input('documenttype_id');
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

		<li><?php echo $this->Html->link(__('List Documents'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Archives'), array('controller' => 'archives', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Archive'), array('controller' => 'archives', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Applicants'), array('controller' => 'applicants', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Applicant'), array('controller' => 'applicants', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Ancestortypes'), array('controller' => 'ancestortypes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Ancestortype'), array('controller' => 'ancestortypes', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Documenttypes'), array('controller' => 'documenttypes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Documenttype'), array('controller' => 'documenttypes', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Docnotes'), array('controller' => 'docnotes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Docnote'), array('controller' => 'docnotes', 'action' => 'add')); ?> </li>
	</ul>
</div>
