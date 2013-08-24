<div class="notesubjects form">
<?php echo $this->Form->create('Notesubject'); ?>
	<fieldset>
		<legend><?php echo __('Edit Notesubject'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('subject_text');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Notesubject.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Notesubject.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Notesubjects'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Casenotes'), array('controller' => 'casenotes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Casenote'), array('controller' => 'casenotes', 'action' => 'add')); ?> </li>
	</ul>
</div>
