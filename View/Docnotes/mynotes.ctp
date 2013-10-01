<div class="docnotes index">
	<h2><?php echo __('Document Notes'); ?></h2>
    <br>
    <br>
    <?php
    echo $this->Form->create('Docnote');
    echo $this->Form->input('note');
    echo $this->Form->end(__('New note'));
    ?>
	<table cellpadding="0" cellspacing="0">
    <tbody>
	<?php foreach ($docnotes as $docnote): ?>
	<tr>
		<td>
            <?php if(!empty($docnote['Docnote']['employee_id']))
            {
                ?>
                <?php echo h($docnote['Employee']['first_name'].' '.$docnote['Employee']['surname'].' (Staff)'); ?>
            <?php
            }
            else
            {
                ?>
                <?php echo h($docnote['Clientcase']['Applicant']['first_name'].' '.$docnote['Clientcase']['Applicant']['surname'].' (Client)'); ?>
            <?php
            }
            ?>
        <td><?php echo h($this->Time->format('d-m-Y', $docnote['Docnote']['created'])); ?>&nbsp;</td>
    </tr>
    <tr>
		<td colspan="2"><?php echo h($docnote['Docnote']['note']); ?>&nbsp;</td>

	</tr>
    </tbody>
<?php endforeach; ?>
	</table>

</div>
