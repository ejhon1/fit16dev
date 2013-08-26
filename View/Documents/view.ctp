<div class="documents view">
<h2><?php echo __('Document'); ?></h2>
	<dl>
		<dt><?php echo __('Archive'); ?></dt>
		<dd>
			<?php echo $this->Html->link($document['Archive']['archive_name'], array('controller' => 'archives', 'action' => 'view', $document['Archive']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Applicant'); ?></dt>
		<dd>
			<?php echo $this->Html->link($document['Applicant']['first_name'].' '.$document['Applicant']['surname'], array('controller' => 'applicants', 'action' => 'view', $document['Applicant']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Ancestor type'); ?></dt>
		<dd>
			<?php echo h($document['Ancestortype']['ancestor_type']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Document type'); ?></dt>
		<dd>
			<?php echo h($document['Documenttype']['type']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('File name'); ?></dt>
		<dd>
			<?php echo h($document['Document']['filename']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Uploaded'); ?></dt>
		<dd>
			<?php echo h($this->Time->format('d-m-Y h:i',$document['Document']['created'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="related">
	<h3><?php echo __('Notes'); ?></h3>
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
