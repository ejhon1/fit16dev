<div class="employees view">
<h2><?php echo __('Employee'); ?></h2>
    <br>
    <?php echo $this->Html->link(__('Edit Details'), array('action' => 'editaccount'), array('class' => 'btn')); ?>
    <?php echo $this->Html->link(__('Change Password'), array('controller' => '/','action' => 'changePassword'), array('class' => 'btn')); ?>
    <br><br>
    <br>


    <dl>
		<dt><?php echo __('First Name'); ?></dt>
		<dd>
			<?php echo h($employee['Employee']['first_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Surname'); ?></dt>
		<dd>
			<?php echo h($employee['Employee']['surname']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>	
		<dd>
		<?php if($employee['User']['active'] == 0)
		{
		?>
			<?php echo h('Inactive'); ?> &nbsp;
		<?php
		}else{
		?>
		<?php echo h('Active'); ?> &nbsp;
		<?php
		}
		?>
		</dd>
		<dt><?php echo __('Email'); ?></dt>
		<dd>
			<?php echo h($employee['Employee']['email']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Account Created'); ?></dt>
		<dd>
			<?php echo h($employee['Employee']['created']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
