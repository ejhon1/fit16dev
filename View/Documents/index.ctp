<div class="documents index">
	<h2><?php echo __('Documents'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('archive_id'); ?></th>
			<th><?php echo $this->Paginator->sort('applicant_id'); ?></th>
			<th><?php echo $this->Paginator->sort('ancestortype_id'); ?></th>
			<th><?php echo $this->Paginator->sort('documenttype_id'); ?></th>
			<th><?php echo $this->Paginator->sort('filename'); ?></th>
			<th><?php echo $this->Paginator->sort('filesize'); ?></th>
			<th><?php echo $this->Paginator->sort('filemime'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($documents as $document): ?>
	<tr>
		<td><?php echo h($document['Document']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($document['Archive']['id'], array('controller' => 'archives', 'action' => 'view', $document['Archive']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($document['Applicant']['title'], array('controller' => 'applicants', 'action' => 'view', $document['Applicant']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($document['Ancestortype']['id'], array('controller' => 'ancestortypes', 'action' => 'view', $document['Ancestortype']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($document['Documenttype']['id'], array('controller' => 'documenttypes', 'action' => 'view', $document['Documenttype']['id'])); ?>
		</td>
		<td><?php echo h($document['Document']['filename']); ?>&nbsp;</td>
		<td><?php echo h($document['Document']['filesize']); ?>&nbsp;</td>
		<td><?php echo h($document['Document']['filemime']); ?>&nbsp;</td>
		<td><?php echo h($document['Document']['created']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $document['Document']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $document['Document']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $document['Document']['id']), null, __('Are you sure you want to delete # %s?', $document['Document']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Document'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Archives'), array('controller' => 'archives', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Archive'), array('controller' => 'archives', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Applicants'), array('controller' => 'applicants', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Applicant'), array('controller' => 'applicants', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Ancestortypes'), array('controller' => 'ancestortypes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Ancestortype'), array('controller' => 'ancestortypes', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Documenttypes'), array('controller' => 'documenttypes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Documenttype'), array('controller' => 'documenttypes', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Docnotes'), array('controller' => 'docnotes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Docnote'), array('controller' => 'docnotes', 'action' => 'add')); ?> </li>
	</ul>
</div>
