<div class="enquiries index">
	<h2><?php echo __('Enquiries'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('client_id'); ?></th>
			<th><?php echo $this->Paginator->sort('enquiry_status'); ?></th>
			<th><?php echo $this->Paginator->sort('born_in_poland'); ?></th>
			<th><?php echo $this->Paginator->sort('nationality_of_parents'); ?></th>
			<th><?php echo $this->Paginator->sort('mother_name'); ?></th>
			<th><?php echo $this->Paginator->sort('father_name'); ?></th>
			<th><?php echo $this->Paginator->sort('nationality_of_grandparents'); ?></th>
			<th><?php echo $this->Paginator->sort('mat_grandmother_name'); ?></th>
			<th><?php echo $this->Paginator->sort('mat_grandfather_name'); ?></th>
			<th><?php echo $this->Paginator->sort('pat_grandmother_name'); ?></th>
			<th><?php echo $this->Paginator->sort('pat_grandfather_name'); ?></th>
			<th><?php echo $this->Paginator->sort('nationality_of_others'); ?></th>
			<th><?php echo $this->Paginator->sort('serve_in_army'); ?></th>
			<th><?php echo $this->Paginator->sort('serve_in_army_info'); ?></th>
			<th><?php echo $this->Paginator->sort('when_left_poland'); ?></th>
			<th><?php echo $this->Paginator->sort('where_left_poland'); ?></th>
			<th><?php echo $this->Paginator->sort('where_left_poland_other'); ?></th>
			<th><?php echo $this->Paginator->sort('have_passport'); ?></th>
			<th><?php echo $this->Paginator->sort('possess_documents'); ?></th>
			<th><?php echo $this->Paginator->sort('possess_documents_types'); ?></th>
			<th><?php echo $this->Paginator->sort('possess_documents_other'); ?></th>
			<th><?php echo $this->Paginator->sort('other_factors'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($enquiries as $enquiry): ?>
	<tr>
		<td><?php echo h($enquiry['Enquiry']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($enquiry['Client']['id'], array('controller' => 'clients', 'action' => 'view', $enquiry['Client']['id'])); ?>
		</td>
		<td><?php echo h($enquiry['Enquiry']['enquiry_status']); ?>&nbsp;</td>
		<td><?php echo h($enquiry['Enquiry']['born_in_poland']); ?>&nbsp;</td>
		<td><?php echo h($enquiry['Enquiry']['nationality_of_parents']); ?>&nbsp;</td>
		<td><?php echo h($enquiry['Enquiry']['mother_name']); ?>&nbsp;</td>
		<td><?php echo h($enquiry['Enquiry']['father_name']); ?>&nbsp;</td>
		<td><?php echo h($enquiry['Enquiry']['nationality_of_grandparents']); ?>&nbsp;</td>
		<td><?php echo h($enquiry['Enquiry']['mat_grandmother_name']); ?>&nbsp;</td>
		<td><?php echo h($enquiry['Enquiry']['mat_grandfather_name']); ?>&nbsp;</td>
		<td><?php echo h($enquiry['Enquiry']['pat_grandmother_name']); ?>&nbsp;</td>
		<td><?php echo h($enquiry['Enquiry']['pat_grandfather_name']); ?>&nbsp;</td>
		<td><?php echo h($enquiry['Enquiry']['nationality_of_others']); ?>&nbsp;</td>
		<td><?php echo h($enquiry['Enquiry']['serve_in_army']); ?>&nbsp;</td>
		<td><?php echo h($enquiry['Enquiry']['serve_in_army_info']); ?>&nbsp;</td>
		<td><?php echo h($enquiry['Enquiry']['when_left_poland']); ?>&nbsp;</td>
		<td><?php echo h($enquiry['Enquiry']['where_left_poland']); ?>&nbsp;</td>
		<td><?php echo h($enquiry['Enquiry']['where_left_poland_other']); ?>&nbsp;</td>
		<td><?php echo h($enquiry['Enquiry']['have_passport']); ?>&nbsp;</td>
		<td><?php echo h($enquiry['Enquiry']['possess_documents']); ?>&nbsp;</td>
		<td><?php echo h($enquiry['Enquiry']['possess_documents_types']); ?>&nbsp;</td>
		<td><?php echo h($enquiry['Enquiry']['possess_documents_other']); ?>&nbsp;</td>
		<td><?php echo h($enquiry['Enquiry']['other_factors']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $enquiry['Enquiry']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $enquiry['Enquiry']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $enquiry['Enquiry']['id']), null, __('Are you sure you want to delete # %s?', $enquiry['Enquiry']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Enquiry'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Clients'), array('controller' => 'clients', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Client'), array('controller' => 'clients', 'action' => 'add')); ?> </li>
	</ul>
</div>
