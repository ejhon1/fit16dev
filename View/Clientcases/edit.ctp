<div class="clientcases form">
<?php echo $this->Form->create('Clientcase'); ?>
	<fieldset>
		<legend><?php echo __('Edit Clientcase'); ?></legend>
	<?php
		//echo $this->Form->input('id');
		//echo $this->Form->input('user_id');
		//echo $this->Form->input('archive_id');
		//echo $this->Form->input('status_id');
		//echo $this->Form->input('applicant_id');
		//echo $this->Form->input('open_or_closed');
		echo $this->Form->input('existing_family');
		//echo $this->Form->input('appointment_date');
		echo $this->Form->input('born_in_poland');
		echo $this->Form->input('nationality_of_parents');
		echo $this->Form->input('mother_name');
		echo $this->Form->input('father_name');
		echo $this->Form->input('nationality_of_grandparents');
		echo $this->Form->input('mat_grandmother_name');
		echo $this->Form->input('mat_grandfather_name');
		echo $this->Form->input('pat_grandmother_name');
		echo $this->Form->input('pat_grandfather_name');
		echo $this->Form->input('nationality_of_others');
		echo $this->Form->input('serve_in_army');
		echo $this->Form->input('serve_in_army_info');
		echo $this->Form->input('when_left_poland');
		echo $this->Form->input('where_left_poland');
		echo $this->Form->input('where_left_poland_other');
		echo $this->Form->input('have_passport');
		echo $this->Form->input('possess_documents');
		echo $this->Form->input('possess_documents_types');
		echo $this->Form->input('possess_documents_other');
		echo $this->Form->input('other_factors');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<!--
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Clientcase.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Clientcase.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Clientcases'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Archives'), array('controller' => 'archives', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Archive'), array('controller' => 'archives', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Statuses'), array('controller' => 'statuses', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Status'), array('controller' => 'statuses', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Applicants'), array('controller' => 'applicants', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Applicant'), array('controller' => 'applicants', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Casenotes'), array('controller' => 'casenotes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Casenote'), array('controller' => 'casenotes', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Casestatuses'), array('controller' => 'casestatuses', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Casestatus'), array('controller' => 'casestatuses', 'action' => 'add')); ?> </li>
	</ul>
</div>
-->
