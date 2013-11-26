<div class="ancestortypes form">
<?php echo $this->Form->create('Ancestortype'); ?>
	<fieldset>
		<legend><?php echo __('Edit Ancestortype'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('ancestor_type');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
