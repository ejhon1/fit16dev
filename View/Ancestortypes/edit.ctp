<div class="ancestortypes form">
<?php echo $this->Form->create('Ancestortype'); ?>
	<fieldset>
		<legend><?php echo __('Edit Ancestortype'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('ancestor_type');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Ancestortype.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Ancestortype.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Ancestortypes'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Documents'), array('controller' => 'documents', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Document'), array('controller' => 'documents', 'action' => 'add')); ?> </li>
	</ul>
</div>
