<div class="archives view">
<h2><?php echo __('Archive'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($archive['Archive']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Archive Name'); ?></dt>
		<dd>
			<?php echo h($archive['Archive']['archive_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Family Name'); ?></dt>
		<dd>
			<?php echo h($archive['Archive']['family_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('File Status'); ?></dt>
		<dd>
			<?php echo h($archive['Archive']['file_status']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($archive['Archive']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($archive['Archive']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Archive'), array('action' => 'edit', $archive['Archive']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Archive'), array('action' => 'delete', $archive['Archive']['id']), null, __('Are you sure you want to delete # %s?', $archive['Archive']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Archives'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Archive'), array('action' => 'add')); ?> </li>
	</ul>
</div>
