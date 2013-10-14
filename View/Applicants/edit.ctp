<?php echo $this->Html->css('jquery-ui-1.10.3.custom'); ?>
<?php echo $this->Html->script('jquery-1.5.min'); ?>
<?php echo $this->Html->script('jquery-ui-1.10.3.custom.min'); ?>

<div class="applicants form">
<?php echo $this->Form->create('Applicant'); ?>
	<script>
    $(function() {
        $( "#datepicker" ).datepicker({
            changeMonth: true,
            changeYear: true,
            yearRange: "-100:+0",
            showAnim: 'slideDown',
            dateFormat: "dd-mm-yy"
        });

    });
</script>
    <fieldset>
		<legend><?php echo __('Edit Applicant'); ?></legend>
	<?php
		echo $this->Form->hidden('id');
		/** echo $this->Form->input('clientcase_id'); */
		/** echo $this->Form->input('archive_id'); */
		echo $this->Form->input('title');
		echo $this->Form->input('first_name');
		echo $this->Form->input('middle_name');
		echo $this->Form->input('surname');
		echo $this->Form->input('birthdate', array('label' => 'Date of birth',
            'id' => 'datepicker',
            'type'=>'text',
            'class'=>'datepicker'));
		echo $this->Form->input('email');
		echo $this->Form->input('landline_number');
		echo $this->Form->input('mobile_number');
		echo $this->Form->input('applicant_type', array (
            'type' => 'radio',
			'options' => array(
                'Main Applicant' => 'Main Applicant', 
                'Secondary Applicant' => 'Seconday Applicant'),
			'default' => 'Secondary Applicants',
			'legend' => 'Applicant Type'
			));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Applicant.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Applicant.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Applicants'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Clientcases'), array('controller' => 'clientcases', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Clientcase'), array('controller' => 'clientcases', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Archives'), array('controller' => 'archives', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Archive'), array('controller' => 'archives', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Addresses'), array('controller' => 'addresses', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Address'), array('controller' => 'addresses', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Documents'), array('controller' => 'documents', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Document'), array('controller' => 'documents', 'action' => 'add')); ?> </li>
	</ul>
</div>
