<div class="applicantdocuments index">
	<h2><?php echo __('Applicantdocuments'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('archive_id'); ?></th>
			<th><?php echo $this->Paginator->sort('applicant_id'); ?></th>
			<th><?php echo $this->Paginator->sort('document_type'); ?></th>
			<th><?php echo $this->Paginator->sort('note'); ?></th>
			<th><?php echo $this->Paginator->sort('filename'); ?></th>
			<th><?php echo $this->Paginator->sort('filesize'); ?></th>
			<th><?php echo $this->Paginator->sort('filemime'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($applicantdocuments as $applicantdocument): ?>
	<tr>
		<td><?php echo h($applicantdocument['Applicantdocument']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($applicantdocument['Archive']['id'], array('controller' => 'archives', 'action' => 'view', $applicantdocument['Archive']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($applicantdocument['Applicant']['title'], array('controller' => 'applicants', 'action' => 'view', $applicantdocument['Applicant']['id'])); ?>
		</td>
		<td><?php echo h($applicantdocument['Applicantdocument']['document_type']); ?>&nbsp;</td>
		<td><?php echo h($applicantdocument['Applicantdocument']['note']); ?>&nbsp;</td>
		<td><?php echo h($applicantdocument['Applicantdocument']['filename']); ?>&nbsp;</td>
		<td><?php echo h($applicantdocument['Applicantdocument']['filesize']); ?>&nbsp;</td>
		<td><?php echo h($applicantdocument['Applicantdocument']['filemime']); ?>&nbsp;</td>
		<td><?php echo h($applicantdocument['Applicantdocument']['created']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $applicantdocument['Applicantdocument']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $applicantdocument['Applicantdocument']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $applicantdocument['Applicantdocument']['id']), null, __('Are you sure you want to delete # %s?', $applicantdocument['Applicantdocument']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Applicantdocument'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Archives'), array('controller' => 'archives', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Archive'), array('controller' => 'archives', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Applicants'), array('controller' => 'applicants', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Applicant'), array('controller' => 'applicants', 'action' => 'add')); ?> </li>
	</ul>
</div>
