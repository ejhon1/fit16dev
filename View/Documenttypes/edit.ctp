<div class="documenttypes form">
<?php echo $this->Form->create('Documenttype'); ?>
	<fieldset>
		<legend><?php echo __('Edit Documenttype'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('category');
		echo $this->Form->input('type');
		echo $this->Form->input('code');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
