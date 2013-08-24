<div class="archives view">
<h2><?php echo __('Archife'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($archife['Archife']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Archive Name'); ?></dt>
		<dd>
			<?php echo h($archife['Archife']['archive_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Family Name'); ?></dt>
		<dd>
			<?php echo h($archife['Archife']['family_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('File Status'); ?></dt>
		<dd>
			<?php echo h($archife['Archife']['file_status']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($archife['Archife']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($archife['Archife']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Archife'), array('action' => 'edit', $archife['Archife']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Archife'), array('action' => 'delete', $archife['Archife']['id']), null, __('Are you sure you want to delete # %s?', $archife['Archife']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Archives'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Archife'), array('action' => 'add')); ?> </li>
	</ul>
</div>
