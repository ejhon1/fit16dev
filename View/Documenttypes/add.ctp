<div class="documenttypes form">
<?php echo $this->Form->create('Documenttype'); ?>
	<fieldset>
		<legend><?php echo __('Add Documenttype'); ?></legend>
	<?php
		echo $this->Form->input('category');
		echo $this->Form->input('doc_type');
		echo $this->Form->input('code');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Documenttypes'), array('action' => 'index')); ?></li>
	</ul>
</div>
