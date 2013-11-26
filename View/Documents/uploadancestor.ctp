<div class="documents form">
<?php echo $this->Form->create('Document', array('type' => 'file'));?>
	<fieldset>
		<legend><?php echo __('Upload a document relating to your Polish ancestor'); ?></legend>
	<?php
        //echo $this->Form->hidden('archive_id', array('default' => $client['Client']['archive_id']));
        echo $this->Form->input('file', array('type' => 'file'));
        echo $this->Form->input('ancestortype_id', array('options'=>$ancestorTypes, 'label'=>'Family member'));
        echo $this->Form->input('documenttype_id', array('options'=>$documentTypes, 'label'=>'Type of document'));
		?>
	</fieldset>
<?php echo $this->Form->end('Upload File'); ?>
</div>

