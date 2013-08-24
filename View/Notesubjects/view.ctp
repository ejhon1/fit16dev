<div class="notesubjects view">
<h2><?php echo __('Notesubject'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($notesubject['Notesubject']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Subject Text'); ?></dt>
		<dd>
			<?php echo h($notesubject['Notesubject']['subject_text']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Notesubject'), array('action' => 'edit', $notesubject['Notesubject']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Notesubject'), array('action' => 'delete', $notesubject['Notesubject']['id']), null, __('Are you sure you want to delete # %s?', $notesubject['Notesubject']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Notesubjects'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Notesubject'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Casenotes'), array('controller' => 'casenotes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Casenote'), array('controller' => 'casenotes', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Casenotes'); ?></h3>
	<?php if (!empty($notesubject['Casenote'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Clientcase Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Notesubject Id'); ?></th>
		<th><?php echo __('Note Type'); ?></th>
		<th><?php echo __('Note'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($notesubject['Casenote'] as $casenote): ?>
		<tr>
			<td><?php echo $casenote['id']; ?></td>
			<td><?php echo $casenote['clientcase_id']; ?></td>
			<td><?php echo $casenote['user_id']; ?></td>
			<td><?php echo $casenote['notesubject_id']; ?></td>
			<td><?php echo $casenote['note_type']; ?></td>
			<td><?php echo $casenote['note']; ?></td>
			<td><?php echo $casenote['created']; ?></td>
			<td><?php echo $casenote['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'casenotes', 'action' => 'view', $casenote['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'casenotes', 'action' => 'edit', $casenote['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'casenotes', 'action' => 'delete', $casenote['id']), null, __('Are you sure you want to delete # %s?', $casenote['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Casenote'), array('controller' => 'casenotes', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
