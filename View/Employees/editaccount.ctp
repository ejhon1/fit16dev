<div class="employees form">
<?php echo $this->Form->create('Employee'); ?>
	<fieldset>
		<legend><?php echo __('Edit Employee'); ?></legend>
	<?php
        echo $this->Form->hidden('id');
		echo $this->Form->input('first_name');
		echo $this->Form->input('surname');
		echo $this->Form->input('email');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>

