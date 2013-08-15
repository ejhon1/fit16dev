<div class="ancestordocuments form">
<?php echo $this->Form->create('Ancestordocument'); ?>
	<fieldset>
		<legend><?php echo __('Edit Ancestordocument'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('archive_id');
		echo $this->Form->input('ancestor_type');
		echo $this->Form->input('document_type');
		echo $this->Form->input('note');
		echo $this->Form->input('filename');
		echo $this->Form->input('filesize');
		echo $this->Form->input('filemime');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Ancestordocument.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Ancestordocument.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Ancestordocuments'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Archives'), array('controller' => 'archives', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Archive'), array('controller' => 'archives', 'action' => 'add')); ?> </li>
	</ul>
</div>
