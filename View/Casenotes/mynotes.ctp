<div class="casenotes index">
	<h2><?php echo __('Contact Notes'); ?></h2>
	<br>
	<a class="btn" data-toggle="modal" href="#myModal">Add Note</a>
	<br><br>
	<table cellpadding="0" cellspacing="0">
        <tr>
            <th class="heading">Date/Time</th>
			<th class="heading">Subject</th>
            <th class="heading">Note</th>
        </tr>

		<?php foreach ($casenotes as $casenote): ?>
			<tr>
				<td><?php echo h($casenote['Casenote']['created']); ?>&nbsp;</td>
				<td><?php echo h($casenote['Casenote']['subject']); ?></td>
				<td><?php echo h($casenote['Casenote']['note']); ?>&nbsp;</td>
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
	  		echo $this->Form->input('note');
            ?>
        </fieldset>
    </div>
    <div class="modal-footer">
        <?php echo $this->Form->end(__('Add Note')); ?>
    </div>
</div>
