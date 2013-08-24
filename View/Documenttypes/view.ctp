<div class="documenttypes view">
<h2><?php echo __('Documenttype'); ?></h2>
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
		<dt><?php echo __('Type'); ?></dt>
		<dd>
			<?php echo h($documenttype['Documenttype']['type']); ?>
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
		<li><?php echo $this->Html->link(__('List Documents'), array('controller' => 'documents', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Document'), array('controller' => 'documents', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Documents'); ?></h3>
	<?php if (!empty($documenttype['Document'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Archive Id'); ?></th>
		<th><?php echo __('Applicant Id'); ?></th>
		<th><?php echo __('Ancestortype Id'); ?></th>
		<th><?php echo __('Documenttype Id'); ?></th>
		<th><?php echo __('Filename'); ?></th>
		<th><?php echo __('Filesize'); ?></th>
		<th><?php echo __('Filemime'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($documenttype['Document'] as $document): ?>
		<tr>
			<td><?php echo $document['id']; ?></td>
			<td><?php echo $document['archive_id']; ?></td>
			<td><?php echo $document['applicant_id']; ?></td>
			<td><?php echo $document['ancestortype_id']; ?></td>
			<td><?php echo $document['documenttype_id']; ?></td>
			<td><?php echo $document['filename']; ?></td>
			<td><?php echo $document['filesize']; ?></td>
			<td><?php echo $document['filemime']; ?></td>
			<td><?php echo $document['created']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'documents', 'action' => 'view', $document['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'documents', 'action' => 'edit', $document['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'documents', 'action' => 'delete', $document['id']), null, __('Are you sure you want to delete # %s?', $document['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Document'), array('controller' => 'documents', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
