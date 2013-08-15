<div class="ancestortypes view">
<h2><?php  echo __('Ancestortype'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($ancestortype['Ancestortype']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Ancestor'); ?></dt>
		<dd>
			<?php echo h($ancestortype['Ancestortype']['Ancestor']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Ancestortype'), array('action' => 'edit', $ancestortype['Ancestortype']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Ancestortype'), array('action' => 'delete', $ancestortype['Ancestortype']['id']), null, __('Are you sure you want to delete # %s?', $ancestortype['Ancestortype']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Ancestortypes'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Ancestortype'), array('action' => 'add')); ?> </li>
	</ul>
</div>
