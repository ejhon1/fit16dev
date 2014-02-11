<?php
echo $this->Html->script('bootstrap-datepicker.js');
echo $this->HTML->css('datepicker');
echo $this->HTML->script('JQueryUser');
?>

<script>
    $(document).ready(function() {
        $('.datepicker').datepicker({
            autoclose: true
        });
    });
    $(function(){
        var hash = window.location.hash;
        hash && $('ul.nav a[href="' + hash + '"]').tab('show');

        $('.nav-tabs a').click(function (e) {
            $(this).tab('show');
            var scrollmem = $('body').scrollTop();
            window.location.hash = this.hash;
            $('html,body').scrollTop(scrollmem);
        });
    });
</script>
<div class="documents view">
    <h2><?php echo __('Document return date'); ?></h2>

   <?php echo $this->Form->create('Document');?>

    <fieldset>
        <?php
        echo $this->Form->input('dateReturned', array('label' => 'Date Returned','class'=>'datepicker', 'id'=>"dpd2"));
        echo $this->Form->hidden('clientcase_id', array('default' => $_GET["case"]));
        echo $this->Form->hidden('id', array('default' => $_GET["document"]));
        ?>
    </fieldset>

    <?php echo $this->Form->end(__('Add Date')); ?>

</div>