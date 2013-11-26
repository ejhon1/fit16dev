<div class="docnotes view">
<h2><?php echo __('Docnote'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($docnote['Docnote']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Document'); ?></dt>
		<dd>
			<?php echo $this->Html->link($docnote['Document']['id'], array('controller' => 'documents', 'action' => 'view', $docnote['Document']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($docnote['User']['id'], array('controller' => 'users', 'action' => 'view', $docnote['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Note'); ?></dt>
		<dd>
			<?php echo h($docnote['Docnote']['note']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($docnote['Docnote']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($docnote['Docnote']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Docnote'), array('action' => 'edit', $docnote['Docnote']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Docnote'), array('action' => 'delete', $docnote['Docnote']['id']), null, __('Are you sure you want to delete # %s?', $docnote['Docnote']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Docnotes'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Docnote'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Documents'), array('controller' => 'documents', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Document'), array('controller' => 'documents', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
