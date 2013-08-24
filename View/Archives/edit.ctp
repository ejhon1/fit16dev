<div class="archives form">
<?php echo $this->Form->create('Archife'); ?>
	<fieldset>
		<legend><?php echo __('Edit Archife'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('archive_name');
		echo $this->Form->input('family_name');
		echo $this->Form->input('file_status');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Archife.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Archife.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Archives'), array('action' => 'index')); ?></li>
	</ul>
</div>
