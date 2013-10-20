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
        echo $this->Form->hidden('clientcase_id');
		echo $this->Form->input('title', array(
            'options' => array(
                '' => '',
                'Mr' => 'Mr',
                'Mrs' => 'Mrs',
                'Ms' => 'Ms',
                'Miss' => 'Miss')));
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
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>

