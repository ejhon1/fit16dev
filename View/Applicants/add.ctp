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
        <legend><?php echo __('Add Applicant'); ?></legend>
        <?php
        /** echo $this->Form->input('archive', array('options' => $archives)); */
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
