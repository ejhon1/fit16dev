<div class="docnotes index">
	<h2><?php echo __('Document Notes'); ?></h2>
    <br>
    <div class="actions">
        <?php echo $this->Html->link(__('Return to case'), array('controller' => 'Clientcases', 'action' => 'view', $clientcase['Clientcase']['id'], '#' => 'tab5')); ?>
    </div>
    <br>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <?php
            if(!empty($document['Ancestortype']['ancestor_type']))
            {
                ?>
                <th class="heading">Ancestor Type</th>
            <?php
            }
            else{
                ?>
                <th class="heading">Applicant</th>
            <?php
            }
            ?>
            <th class="heading">Document Type</th>
            <th class="heading">File name</th>
            <th class="heading">Uploaded</th>
        </tr>
        <tr class="list">
            <?php
            if(!empty($document['Ancestortype']['ancestor_type']))
            {
                ?>
                <td valign="top"><?php echo h($document['Ancestortype']['ancestor_type']); ?></td>
            <?php
            }
            else{
                ?>
                <td valign="top"><?php echo h($document['Applicant']['first_name'].' '.$document['Applicant']['surname']); ?></td>
            <?php
            }
            ?>
            <td valign="top">
                <?php echo h($document['Documenttype']['type']); ?>
            </td>
            <td valign="top"><?php echo h($document['Document']['filename']); ?>&nbsp;</td>
            <td valign="top"><?php echo h($this->Time->format('h:i d-m-Y',$document['Document']['created'])); ?>&nbsp;</td>
        </tr>
    </table>
    <br>
    <?php
    echo $this->Form->create('Docnote');
    echo $this->Form->input('note');
    echo $this->Form->end(__('Add Note'));
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
