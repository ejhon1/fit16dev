<div class="ancestordocuments index">
	<h2><?php echo __('Ancestordocuments'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('archive_id'); ?></th>
			<th><?php echo $this->Paginator->sort('ancestor_type'); ?></th>
			<th><?php echo $this->Paginator->sort('document_type'); ?></th>
			<th><?php echo $this->Paginator->sort('note'); ?></th>
			<th><?php echo $this->Paginator->sort('filename'); ?></th>
			<th><?php echo $this->Paginator->sort('filesize'); ?></th>
			<th><?php echo $this->Paginator->sort('filemime'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($ancestordocuments as $ancestordocument): ?>
	<tr>
		<td><?php echo h($ancestordocument['Ancestordocument']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($ancestordocument['Archive']['id'], array('controller' => 'archives', 'action' => 'view', $ancestordocument['Archive']['id'])); ?>
		</td>
		<td><?php echo h($ancestordocument['Ancestordocument']['ancestor_type']); ?>&nbsp;</td>
		<td><?php echo h($ancestordocument['Ancestordocument']['document_type']); ?>&nbsp;</td>
		<td><?php echo h($ancestordocument['Ancestordocument']['note']); ?>&nbsp;</td>
		<td><?php echo h($ancestordocument['Ancestordocument']['filename']); ?>&nbsp;</td>
		<td><?php echo h($ancestordocument['Ancestordocument']['filesize']); ?>&nbsp;</td>
		<td><?php echo h($ancestordocument['Ancestordocument']['filemime']); ?>&nbsp;</td>
		<td><?php echo h($ancestordocument['Ancestordocument']['created']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $ancestordocument['Ancestordocument']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $ancestordocument['Ancestordocument']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $ancestordocument['Ancestordocument']['id']), null, __('Are you sure you want to delete # %s?', $ancestordocument['Ancestordocument']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Ancestordocument'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Archives'), array('controller' => 'archives', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Archive'), array('controller' => 'archives', 'action' => 'add')); ?> </li>
	</ul>
</div>
