<div class="ancestortypes form">
<?php echo $this->Form->create('Ancestortype'); ?>
	<fieldset>
		<legend><?php echo __('Add Ancestortype'); ?></legend>
	<?php
		echo $this->Form->input('Ancestor');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Ancestortypes'), array('action' => 'index')); ?></li>
	</ul>
</div>
