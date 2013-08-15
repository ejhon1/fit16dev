<div class="paperfiles view">
<h2><?php  echo __('Paperfile'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($paperfile['Paperfile']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Archive'); ?></dt>
		<dd>
			<?php echo $this->Html->link($paperfile['Archive']['id'], array('controller' => 'archives', 'action' => 'view', $paperfile['Archive']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo h($paperfile['Paperfile']['status']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($paperfile['Paperfile']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($paperfile['Paperfile']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Paperfile'), array('action' => 'edit', $paperfile['Paperfile']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Paperfile'), array('action' => 'delete', $paperfile['Paperfile']['id']), null, __('Are you sure you want to delete # %s?', $paperfile['Paperfile']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Paperfiles'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Paperfile'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Archives'), array('controller' => 'archives', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Archive'), array('controller' => 'archives', 'action' => 'add')); ?> </li>
	</ul>
</div>
