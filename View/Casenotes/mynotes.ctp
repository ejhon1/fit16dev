<div class="casenotes index">
	<h2><?php echo __('Contact Notes'); ?></h2>
	<br>
	<a class="btn" data-toggle="modal" href="#myModal">Add Note</a>
	<br><br>
	<table cellpadding="0" cellspacing="0">
		<?php foreach ($casenotes as $casenote): ?>
			<tr>
				<td><?php echo h($casenote['Casenote']['subject']); ?></td>
				<td><?php if(!empty($casenote['Employee']['first_name']))
                    {
                        echo h($casenote['Employee']['first_name'].' '.$casenote['Employee']['surname']);
                    } else
                    {
                        echo h($casenote['Applicant']['first_name'].' '.$casenote['Applicant']['surname']);
                    }?></td>
				<td><?php echo h($casenote['Casenote']['created']); ?></td>
				
			</tr>
			<tr>
				<td colspan=3><?php echo h($casenote['Casenote']['note']); ?></td>
			</tr>
<?php endforeach; ?>
	</table>

</div>
<div class="modal hide" id="myModal"><!-- note the use of "hide" class -->
    <div class="modal-header">
        <button class="close" data-dismiss="modal">×</button>
        <h3>Add Contact Note</h3>
    </div>
    <div class="modal-body">
		<?php echo $this->Form->create('Casenote', array('action' => 'mynotesadd')); ?>
        <fieldset>
            <?php
	  		echo $this->Form->input('subject');
	  		echo $this->Form->hidden('note_type', array('default' => 'Public'));
	  		echo $this->Form->input('note', array('label' => 'Would you like to send a message to Polaron? Please let us know.'));
            ?>
        </fieldset>
    </div>
    <div class="modal-footer">
        <?php echo $this->Form->end(__('Add Note')); ?>
    </div>
</div>
