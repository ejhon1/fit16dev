<?php echo $this->Html->script('bootstrap-datepicker.js');
echo $this->HTML->css('datepicker'); ?>

<div class="applicants form">
<?php echo $this->Form->create('Applicant'); ?>
    <script>
        $(document).ready(function() {
            $('.datepicker').datepicker({
                autoclose: true
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
		echo $this->Form->input('date', array('label' => 'Date of birth',
            'id' => 'datepicker',
            'type'=>'text',
            'class'=>'datepicker', 'default' => $test));
        echo $test;
		echo $this->Form->input('email');
		echo $this->Form->input('landline_number');
		echo $this->Form->input('mobile_number');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>

