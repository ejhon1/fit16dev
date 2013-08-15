<div class="paperfilelogs form">
<?php echo $this->Form->create('Paperfilelog'); ?>
	<fieldset>
		<legend><?php echo __('Add Paperfilelog'); ?></legend>
	<?php
		echo $this->Form->input('paperfile_id');
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

		<li><?php echo $this->Html->link(__('List Paperfilelogs'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Paperfiles'), array('controller' => 'paperfiles', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Paperfile'), array('controller' => 'paperfiles', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Employees'), array('controller' => 'employees', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Employee'), array('controller' => 'employees', 'action' => 'add')); ?> </li>
	</ul>
</div>
