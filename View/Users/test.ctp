<div class="test">

    <?php echo $this->Form->create('User'); ?>
    <fieldset>
    <?php
        echo $this->Form->input('Applicant.email');
    ?>
    </fieldset>
    <?php echo $this->Form->end(__('Submit')); ?>

</div>