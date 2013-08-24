<div class="archives form">
<?php echo $this->Form->create('Archife'); ?>
	<fieldset>
		<legend><?php echo __('Add Archife'); ?></legend>
	<?php
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

		<li><?php echo $this->Html->link(__('List Archives'), array('action' => 'index')); ?></li>
	</ul>
</div>
