<div class="employees form">
<?php echo $this->Form->create('Employee'); ?>
	<fieldset>
		<legend><?php echo __('Edit Employee'); ?></legend>
	<?php
        echo $this->Form->hidden('id');
		echo $this->Form->input('first_name');
		echo $this->Form->input('surname');
		echo $this->Form->input('status', array(
            'options' => array(
                'Active' => 'Active',
                'Inactive' => 'Inactive')));
		echo $this->Form->input('email');
		echo $this->Form->input('role_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('View Details'), array('action' => 'myaccount')); ?></li>
		<li><?php echo $this->Html->link(__('Change Password'), array('controller' => '/','action' => 'changePassword')); ?> </li>
	</ul>
</div>
