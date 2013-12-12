<div>
<?php echo $this->Form->create('Casenote'); ?>
	<fieldset>
		<h2><?php echo __('Add Contact Note'); ?></h2>
		<br>
		Public contact notes can be viewed by the client and will send an email to tell them that they have a new note.
	<?php
		echo $this->Form->input('subject');
		echo $this->Form->input('note_type', array(
					'type' => 'radio',
					'legend'=>'Note Type',
					'default' => 'Internal',
					'options' => array('Internal' => 'Internal', 'Public'=>'Public')));
		echo $this->Form->input('note');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
