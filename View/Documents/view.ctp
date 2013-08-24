<div class="documents view">
<h2><?php echo __('Document'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($document['Document']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Archive'); ?></dt>
		<dd>
			<?php echo $this->Html->link($document['Archive']['id'], array('controller' => 'archives', 'action' => 'view', $document['Archive']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Applicant'); ?></dt>
		<dd>
			<?php echo $this->Html->link($document['Applicant']['title'], array('controller' => 'applicants', 'action' => 'view', $document['Applicant']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Ancestortype'); ?></dt>
		<dd>
			<?php echo $this->Html->link($document['Ancestortype']['id'], array('controller' => 'ancestortypes', 'action' => 'view', $document['Ancestortype']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Documenttype'); ?></dt>
		<dd>
			<?php echo $this->Html->link($document['Documenttype']['id'], array('controller' => 'documenttypes', 'action' => 'view', $document['Documenttype']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Filename'); ?></dt>
		<dd>
			<?php echo h($document['Document']['filename']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Filesize'); ?></dt>
		<dd>
			<?php echo h($document['Document']['filesize']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Filemime'); ?></dt>
		<dd>
			<?php echo h($document['Document']['filemime']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($document['Document']['created']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Document'), array('action' => 'edit', $document['Document']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Document'), array('action' => 'delete', $document['Document']['id']), null, __('Are you sure you want to delete # %s?', $document['Document']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Documents'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Document'), array('action' => 'add')); ?> </li>
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
<div class="related">
	<h3><?php echo __('Related Docnotes'); ?></h3>
	<?php if (!empty($document['Docnote'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Document Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Note'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($document['Docnote'] as $docnote): ?>
		<tr>
			<td><?php echo $docnote['id']; ?></td>
			<td><?php echo $docnote['document_id']; ?></td>
			<td><?php echo $docnote['user_id']; ?></td>
			<td><?php echo $docnote['note']; ?></td>
			<td><?php echo $docnote['created']; ?></td>
			<td><?php echo $docnote['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'docnotes', 'action' => 'view', $docnote['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'docnotes', 'action' => 'edit', $docnote['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'docnotes', 'action' => 'delete', $docnote['id']), null, __('Are you sure you want to delete # %s?', $docnote['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Docnote'), array('controller' => 'docnotes', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
