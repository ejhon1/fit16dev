<div class="paperfiles form">
<?php echo $this->Form->create('Paperfile'); ?>
	<fieldset>
		<legend><?php echo __('Edit Paperfile'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('archive_id');
		echo $this->Form->input('status');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Paperfile.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Paperfile.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Paperfiles'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Archives'), array('controller' => 'archives', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Archive'), array('controller' => 'archives', 'action' => 'add')); ?> </li>
	</ul>
</div>
