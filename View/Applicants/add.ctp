<div class="applicants form">
    <?php echo $this->Form->create('Applicant'); ?>
    <fieldset>
        <legend><?php echo __('Add Applicant'); ?></legend>
        <?php
        echo $this->Form->input('archive', array('options' => $archives));
        echo $this->Form->input('birthdate');
        echo $this->Form->input('title');
        echo $this->Form->input('first_name');
        echo $this->Form->input('middle_name');
        echo $this->Form->input('surname');
        echo $this->Form->input('email');
        echo $this->Form->input('landline_number');
        echo $this->Form->input('mobile_number');
        echo $this->Form->input('applicant_type', array (
            'options' => array(
                'Main Applicant' => 'Main Applicant', 
                'Secondary Applicant' => 'Seconday Applicant')));
        ?>
    </fieldset>
    <?php echo $this->Form->end(__('Submit')); ?>
</div>
