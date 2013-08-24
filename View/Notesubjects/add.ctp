<div class="notesubjects form">
<?php echo $this->Form->create('Notesubject'); ?>
	<fieldset>
		<legend><?php echo __('Add Notesubject'); ?></legend>
	<?php
		echo $this->Form->input('subject_text');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Notesubjects'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Casenotes'), array('controller' => 'casenotes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Casenote'), array('controller' => 'casenotes', 'action' => 'add')); ?> </li>
	</ul>
</div>
