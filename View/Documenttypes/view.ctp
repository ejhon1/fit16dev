<div class="documenttypes view">
<h2><?php  echo __('Documenttype'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($documenttype['Documenttype']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Category'); ?></dt>
		<dd>
			<?php echo h($documenttype['Documenttype']['category']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Doc Type'); ?></dt>
		<dd>
			<?php echo h($documenttype['Documenttype']['doc_type']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Code'); ?></dt>
		<dd>
			<?php echo h($documenttype['Documenttype']['code']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Documenttype'), array('action' => 'edit', $documenttype['Documenttype']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Documenttype'), array('action' => 'delete', $documenttype['Documenttype']['id']), null, __('Are you sure you want to delete # %s?', $documenttype['Documenttype']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Documenttypes'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Documenttype'), array('action' => 'add')); ?> </li>
	</ul>
</div>
