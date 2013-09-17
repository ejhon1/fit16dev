<div class="archiveloans form">
<?php echo $this->Form->create('Archiveloan'); ?>
	<fieldset>
		<legend><?php echo __('Add Archiveloan'); ?></legend>
	<?php
		echo $this->Form->input('archive_id');
		echo $this->Form->input('employee_id');
		echo $this->Form->input('date_borrowed');
		echo $this->Form->input('date_returned');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Archiveloans'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Archives'), array('controller' => 'archives', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Archive'), array('controller' => 'archives', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Employees'), array('controller' => 'employees', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Employee'), array('controller' => 'employees', 'action' => 'add')); ?> </li>
	</ul>
</div>
