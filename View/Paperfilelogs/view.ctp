<div class="paperfilelogs view">
<h2><?php echo __('Paperfilelog'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($paperfilelog['Paperfilelog']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Archive'); ?></dt>
		<dd>
			<?php echo $this->Html->link($paperfilelog['Archive']['id'], array('controller' => 'archives', 'action' => 'view', $paperfilelog['Archive']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Employee'); ?></dt>
		<dd>
			<?php echo $this->Html->link($paperfilelog['Employee']['id'], array('controller' => 'employees', 'action' => 'view', $paperfilelog['Employee']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Date Borrowed'); ?></dt>
		<dd>
			<?php echo h($paperfilelog['Paperfilelog']['date_borrowed']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Date Returned'); ?></dt>
		<dd>
			<?php echo h($paperfilelog['Paperfilelog']['date_returned']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Paperfilelog'), array('action' => 'edit', $paperfilelog['Paperfilelog']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Paperfilelog'), array('action' => 'delete', $paperfilelog['Paperfilelog']['id']), null, __('Are you sure you want to delete # %s?', $paperfilelog['Paperfilelog']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Paperfilelogs'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Paperfilelog'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Archives'), array('controller' => 'archives', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Archive'), array('controller' => 'archives', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Employees'), array('controller' => 'employees', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Employee'), array('controller' => 'employees', 'action' => 'add')); ?> </li>
	</ul>
</div>
