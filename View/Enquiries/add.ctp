<div class="enquiries form">
<?php echo $this->Form->create('Enquiry'); ?>
	<fieldset>
		<legend><?php echo __('Add Enquiry'); ?></legend>
	<?php
		echo $this->Form->input('client_id');
		echo $this->Form->input('enquiry_status');
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
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Enquiries'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Clients'), array('controller' => 'clients', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Client'), array('controller' => 'clients', 'action' => 'add')); ?> </li>
	</ul>
</div>
