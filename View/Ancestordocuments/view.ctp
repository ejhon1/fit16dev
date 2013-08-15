<div class="ancestordocuments view">
<h2><?php  echo __('Ancestordocument'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($ancestordocument['Ancestordocument']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Archive'); ?></dt>
		<dd>
			<?php echo $this->Html->link($ancestordocument['Archive']['id'], array('controller' => 'archives', 'action' => 'view', $ancestordocument['Archive']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Ancestor Type'); ?></dt>
		<dd>
			<?php echo h($ancestordocument['Ancestordocument']['ancestor_type']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Document Type'); ?></dt>
		<dd>
			<?php echo h($ancestordocument['Ancestordocument']['document_type']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Note'); ?></dt>
		<dd>
			<?php echo h($ancestordocument['Ancestordocument']['note']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Filename'); ?></dt>
		<dd>
			<?php echo h($ancestordocument['Ancestordocument']['filename']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Filesize'); ?></dt>
		<dd>
			<?php echo h($ancestordocument['Ancestordocument']['filesize']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Filemime'); ?></dt>
		<dd>
			<?php echo h($ancestordocument['Ancestordocument']['filemime']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($ancestordocument['Ancestordocument']['created']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Ancestordocument'), array('action' => 'edit', $ancestordocument['Ancestordocument']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Ancestordocument'), array('action' => 'delete', $ancestordocument['Ancestordocument']['id']), null, __('Are you sure you want to delete # %s?', $ancestordocument['Ancestordocument']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Ancestordocuments'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Ancestordocument'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Archives'), array('controller' => 'archives', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Archive'), array('controller' => 'archives', 'action' => 'add')); ?> </li>
	</ul>
</div>
