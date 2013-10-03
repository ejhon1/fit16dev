<div>
  <?php echo $this->Form->create('Casenote'); ?>
  	<fieldset>
  		<legend><?php echo __('Add Contact Note'); ?></legend>
  	<?php
  		//echo $this->Form->input('user_id');
  		//echo $this->Form->input('notesubject_id');
  		echo $this->Form->input('subject');
  		echo $this->Form->hidden('note_type', array('default' => 'Public'));
  		echo $this->Form->input('note');
  	?>
  	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>

