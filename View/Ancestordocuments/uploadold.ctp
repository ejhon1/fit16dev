<div class="ancestordocuments form">
<?php echo $this->Form->create('Ancestordocument', array('type' => 'file'));?>
	<fieldset>
		<legend><?php echo __('Upload a document relating to your Polish ancestor'); ?></legend>
	<?php
        //echo $this->Form->hidden('archive_id', array('default' => $client['Client']['archive_id']));
        echo $this->Form->input('file', array('type' => 'file'));
        echo $this->Form->input('ancestor_type', array('options'=>$ancestorTypes, 'label'=>'Family member'));
        echo $this->Form->input('document_type', array('options'=>$documentTypes, 'label'=>'Type of document'));
        echo $this->Form->input('note');
		?>
	</fieldset>
<?php echo $this->Form->end('Upload File'); ?>
</div>

