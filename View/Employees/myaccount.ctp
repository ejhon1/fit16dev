<div class="employees view">
<h2><?php echo __('Employee'); ?></h2>
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
			<?php echo h($employee['Employee']['status']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Email'); ?></dt>
		<dd>
			<?php echo h($employee['Employee']['email']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Role'); ?></dt>
		<dd>
			<?php echo h($employee['Role']['role_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Account Created'); ?></dt>
		<dd>
			<?php echo h($employee['Employee']['created']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Details'), array('action' => 'editaccount')); ?> </li>
        <li><?php echo $this->Html->link(__('Change Password'), array('controller' => '/','action' => 'changePassword')); ?> </li>
    </ul>
</div>
<div class="related">
	<h3><?php echo __('Borrowed Files'); ?></h3>
	<?php if (!empty($employee['Paperfilelog'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Archive Id'); ?></th>
		<th><?php echo __('Employee Id'); ?></th>
		<th><?php echo __('Date Borrowed'); ?></th>
		<th><?php echo __('Date Returned'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($employee['Paperfilelog'] as $paperfilelog): ?>
		<tr>
			<td><?php echo $paperfilelog['id']; ?></td>
			<td><?php echo $paperfilelog['archive_id']; ?></td>
			<td><?php echo $paperfilelog['employee_id']; ?></td>
			<td><?php echo $paperfilelog['date_borrowed']; ?></td>
			<td><?php echo $paperfilelog['date_returned']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'paperfilelogs', 'action' => 'view', $paperfilelog['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'paperfilelogs', 'action' => 'edit', $paperfilelog['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'paperfilelogs', 'action' => 'delete', $paperfilelog['id']), null, __('Are you sure you want to delete # %s?', $paperfilelog['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Paperfilelog'), array('controller' => 'paperfilelogs', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
