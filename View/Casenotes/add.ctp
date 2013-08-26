<div class="casenotes form">
<?php echo $this->Form->create('Casenote'); ?>
	<fieldset>
		<legend><?php echo __('Add Casenote'); ?></legend>
	<?php
		echo $this->Form->input('clientcase_id');
		echo $this->Form->input('user_id');
		echo $this->Form->input('notesubject_id');
		$options = array('Internal' => 'Internal', 'Public' => 'Public');
		echo $this->Form->radio('note_type', $options);
		echo $this->Form->input('note');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Casenotes'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Clientcases'), array('controller' => 'clientcases', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Clientcase'), array('controller' => 'clientcases', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Notesubjects'), array('controller' => 'notesubjects', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Notesubject'), array('controller' => 'notesubjects', 'action' => 'add')); ?> </li>
	</ul>
</div>
