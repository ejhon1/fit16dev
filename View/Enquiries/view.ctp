<div class="enquiries view">
<h2><?php  echo __('Enquiry'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($enquiry['Enquiry']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Client'); ?></dt>
		<dd>
			<?php echo $this->Html->link($enquiry['Client']['id'], array('controller' => 'clients', 'action' => 'view', $enquiry['Client']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Enquiry Status'); ?></dt>
		<dd>
			<?php echo h($enquiry['Enquiry']['enquiry_status']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Born In Poland'); ?></dt>
		<dd>
			<?php echo h($enquiry['Enquiry']['born_in_poland']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Nationality Of Parents'); ?></dt>
		<dd>
			<?php echo h($enquiry['Enquiry']['nationality_of_parents']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Mother Name'); ?></dt>
		<dd>
			<?php echo h($enquiry['Enquiry']['mother_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Father Name'); ?></dt>
		<dd>
			<?php echo h($enquiry['Enquiry']['father_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Nationality Of Grandparents'); ?></dt>
		<dd>
			<?php echo h($enquiry['Enquiry']['nationality_of_grandparents']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Mat Grandmother Name'); ?></dt>
		<dd>
			<?php echo h($enquiry['Enquiry']['mat_grandmother_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Mat Grandfather Name'); ?></dt>
		<dd>
			<?php echo h($enquiry['Enquiry']['mat_grandfather_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Pat Grandmother Name'); ?></dt>
		<dd>
			<?php echo h($enquiry['Enquiry']['pat_grandmother_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Pat Grandfather Name'); ?></dt>
		<dd>
			<?php echo h($enquiry['Enquiry']['pat_grandfather_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Nationality Of Others'); ?></dt>
		<dd>
			<?php echo h($enquiry['Enquiry']['nationality_of_others']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Serve In Army'); ?></dt>
		<dd>
			<?php echo h($enquiry['Enquiry']['serve_in_army']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Serve In Army Info'); ?></dt>
		<dd>
			<?php echo h($enquiry['Enquiry']['serve_in_army_info']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('When Left Poland'); ?></dt>
		<dd>
			<?php echo h($enquiry['Enquiry']['when_left_poland']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Where Left Poland'); ?></dt>
		<dd>
			<?php echo h($enquiry['Enquiry']['where_left_poland']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Where Left Poland Other'); ?></dt>
		<dd>
			<?php echo h($enquiry['Enquiry']['where_left_poland_other']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Have Passport'); ?></dt>
		<dd>
			<?php echo h($enquiry['Enquiry']['have_passport']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Possess Documents'); ?></dt>
		<dd>
			<?php echo h($enquiry['Enquiry']['possess_documents']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Possess Documents Types'); ?></dt>
		<dd>
			<?php echo h($enquiry['Enquiry']['possess_documents_types']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Possess Documents Other'); ?></dt>
		<dd>
			<?php echo h($enquiry['Enquiry']['possess_documents_other']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Other Factors'); ?></dt>
		<dd>
			<?php echo h($enquiry['Enquiry']['other_factors']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Enquiry'), array('action' => 'edit', $enquiry['Enquiry']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Enquiry'), array('action' => 'delete', $enquiry['Enquiry']['id']), null, __('Are you sure you want to delete # %s?', $enquiry['Enquiry']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Enquiries'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Enquiry'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Clients'), array('controller' => 'clients', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Client'), array('controller' => 'clients', 'action' => 'add')); ?> </li>
	</ul>
</div>
