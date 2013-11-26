<div class="archiveloans view">
<h2><?php echo __('Archiveloan'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($archiveloan['Archiveloan']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Archive'); ?></dt>
		<dd>
			<?php echo $this->Html->link($archiveloan['Archive']['id'], array('controller' => 'archives', 'action' => 'view', $archiveloan['Archive']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Employee'); ?></dt>
		<dd>
			<?php echo $this->Html->link($archiveloan['Employee']['id'], array('controller' => 'employees', 'action' => 'view', $archiveloan['Employee']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Date Borrowed'); ?></dt>
		<dd>
			<?php echo h($archiveloan['Archiveloan']['date_borrowed']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Date Returned'); ?></dt>
		<dd>
			<?php echo h($archiveloan['Archiveloan']['date_returned']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Archiveloan'), array('action' => 'edit', $archiveloan['Archiveloan']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Archiveloan'), array('action' => 'delete', $archiveloan['Archiveloan']['id']), null, __('Are you sure you want to delete # %s?', $archiveloan['Archiveloan']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Archiveloans'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Archiveloan'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Archives'), array('controller' => 'archives', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Archive'), array('controller' => 'archives', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Employees'), array('controller' => 'employees', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Employee'), array('controller' => 'employees', 'action' => 'add')); ?> </li>
	</ul>
</div>
