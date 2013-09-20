<div>
<?php echo $this->Form->create('Contact Note'); ?>
	<fieldset>
		<legend><?php echo __('Add Casenote'); ?></legend>
	<?php
		//echo $this->Form->input('clientcase_id');
		//echo $this->Form->input('user_id');
		//echo $this->Form->input('notesubject_id');
		echo $this->Form->input('subject');
		$options = array('Internal' => 'Internal', 'Public' => 'Public');
		echo $this->Form->radio('note_type', $options);
		echo $this->Form->input('note');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
