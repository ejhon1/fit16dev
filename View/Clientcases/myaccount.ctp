<div class="clientcases view">
<h2><?php echo __('Case information'); ?></h2>
	<dl>
		<dt><?php echo __('First Name'); ?></dt>
		<dd>
			<?php echo h($clientcase['Applicant']['first_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Surname'); ?></dt>
		<dd>
			<?php echo h($clientcase['Applicant']['surname']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo h($clientcase['Status']['status_type']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Email'); ?></dt>
		<dd>
			<?php echo h($clientcase['Applicant']['email']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
        <li><?php echo $this->Html->link(__('Change Password'), array('controller' => '/','action' => 'changePassword')); ?> </li>
    </ul>
</div>
