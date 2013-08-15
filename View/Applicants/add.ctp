<div class="applicants form">
<?php echo $this->Form->create('Applicant'); ?>
	<fieldset>
		<legend><?php echo __('Add Applicant'); ?></legend>
	<?php
		echo $this->Form->hidden('client_id');
		echo $this->Form->hidden('archive_id');
		echo $this->Form->input('title');
		echo $this->Form->input('first_name');
		echo $this->Form->input('middle_name');
		echo $this->Form->input('surname');
		echo $this->Form->input('email');
		echo $this->Form->input('landline_number');
		echo $this->Form->input('mobile_number');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>

