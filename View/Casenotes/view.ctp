<div class="casenotes view">
<h2><?php echo __('Contact Note'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($casenote['Casenote']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Clientcase'); ?></dt>
		<dd>
			<?php echo $this->Html->link($casenote['Clientcase']['id'], array('controller' => 'clientcases', 'action' => 'view', $casenote['Clientcase']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($casenote['User']['id'], array('controller' => 'users', 'action' => 'view', $casenote['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Notesubject'); ?></dt>
		<dd>
			<?php echo $this->Html->link($casenote['Notesubject']['id'], array('controller' => 'notesubjects', 'action' => 'view', $casenote['Notesubject']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Note Type'); ?></dt>
		<dd>
			<?php echo h($casenote['Casenote']['note_type']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Note'); ?></dt>
		<dd>
			<?php echo h($casenote['Casenote']['note']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($casenote['Casenote']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($casenote['Casenote']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Casenote'), array('action' => 'edit', $casenote['Casenote']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Casenote'), array('action' => 'delete', $casenote['Casenote']['id']), null, __('Are you sure you want to delete # %s?', $casenote['Casenote']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Casenotes'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Casenote'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Clientcases'), array('controller' => 'clientcases', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Clientcase'), array('controller' => 'clientcases', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Notesubjects'), array('controller' => 'notesubjects', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Notesubject'), array('controller' => 'notesubjects', 'action' => 'add')); ?> </li>
	</ul>
</div>
