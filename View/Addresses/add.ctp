<div class="addresses form">
<?php echo $this->Form->create('Address'); ?>
	<fieldset>
		<legend><?php echo __('Add Address'); ?></legend>
	<?php
		echo $this->Form->input('address_line', array('label' => 'Address'));
		echo $this->Form->input('suburb');
		echo $this->Form->input('postcode');
		echo $this->Form->input('state');
		echo $this->Form->input('country_id', array('options' => $countries, 'label' => 'Country', 'default' => 15));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
