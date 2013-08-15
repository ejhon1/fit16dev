<div class="users form">
<?php echo $this->Form->create('User'); ?>
	<fieldset>
		<legend><?php echo __('Add Staff Member'); ?></legend>
	<?php
		echo $this->Form->input('Employee.first_name');
		echo $this->Form->input('Employee.surname');
		echo $this->Form->input('Employee.email');
		echo $this->Form->input('username');
		echo $this->Form->input('password');
		echo $this->Form->input('password_confirm', array('type' => 'password', 'label'=>'Confirm Password'));
		echo $this->Form->input('Employee.role', array('options'=>$roles, 'label'=>'Role'));
		echo $this->Form->hidden('type', array('default' => 'Employee'));
		echo $this->Form->input('Employee.status', array('options'=>array('Active' => 'Active', 'Inactive' => 'Inactive'), 'label'=>'Employee Status'));
		
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>

