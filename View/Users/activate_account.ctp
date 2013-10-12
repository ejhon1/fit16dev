    <h3>Activate a client's account</h3>
    This form can be used to activate the account of a legacy client or retrieve the login details of a client account. It will send an email to the client with the message entered below, their login details, and a signature or closing paragraph if one is included.
    <?php echo $this->Form->create('User');?>
    <fieldset>
        <?php
        echo $this->Form->hidden('id', array('default' => $clientcase['User']['id']));
        echo $this->Form->input('message', array('type'=>'textarea', 'style'=>'width: 480px; height: 300px;'));
        echo $this->Form->input('signature', array('type'=>'textarea', 'style'=>'width: 480px; height: 100px;'));
        ?>
    </fieldset>

    <?php// echo $this->Form->end(__('Send')); ?>
