<div class="archives index">
	<h2><?php echo __('Archives'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('archive_name'); ?></th>
			<th><?php echo $this->Paginator->sort('family_name'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($archives as $archive): ?>
	<tr>
		<td><?php echo h($archive['Archive']['id']); ?>&nbsp;</td>
		<td><?php echo h($archive['Archive']['archive_name']); ?>&nbsp;</td>
		<td><?php echo h($archive['Archive']['family_name']); ?>&nbsp;</td>
		<td><?php echo h($archive['Archive']['created']); ?>&nbsp;</td>
		<td><?php echo h($archive['Archive']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $archive['Archive']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $archive['Archive']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $archive['Archive']['id']), null, __('Are you sure you want to delete # %s?', $archive['Archive']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Archive'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Ancestordocuments'), array('controller' => 'ancestordocuments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Ancestordocument'), array('controller' => 'ancestordocuments', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Applicantdocuments'), array('controller' => 'applicantdocuments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Applicantdocument'), array('controller' => 'applicantdocuments', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Applicants'), array('controller' => 'applicants', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Applicant'), array('controller' => 'applicants', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Clients'), array('controller' => 'clients', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Client'), array('controller' => 'clients', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Paperfiles'), array('controller' => 'paperfiles', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Paperfile'), array('controller' => 'paperfiles', 'action' => 'add')); ?> </li>
	</ul>
</div>
