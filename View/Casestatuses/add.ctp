<div class="casestatuses form">
<?php echo $this->Form->create('Casestatus'); ?>
	<fieldset>
		<legend><?php echo __('Update Case Status'); ?></legend>
	<?php
		echo $this->Form->input('status_id');
        echo $this->Form->hidden('date_updated', array('default' => date('Y-m-d h:i:s')));
        ?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>

