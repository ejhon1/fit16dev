<?php
echo $this->HTML->script('JQueryUser');
?>
<div class="docnotes index">
	<h2><?php echo __('Document Notes'); ?></h2>
    <table id="data">
        <thead>
        <tr>
            <th class="heading">Archive</th>
            <th class="heading">Client</th>
            <th class="heading">Note</th>
            <th class="heading">Created</th>
            <th class="heading"></th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($docnotes as $docnote): ?>
            <tr>
                <td valign="top">
                    <?php echo h($docnote['Archive']['archive_name']); ?>
                </td>
                <td valign="top">
                    <?php echo h($docnote['Applicant']['first_name'].' '.$docnote['Applicant']['surname']); ?>
                </td>
                <td valign="top">
                    <?php echo String::truncate($docnote['Docnote']['note'], 25, array('html' => true)); ?>
                </td>
                <td valign="top">
                    <?php echo h($this->Time->format('d-m-Y', $docnote['Docnote']['created'])); ?>
                </td>
                <td class="actions">
                    <?php echo $this->Html->link(__('View'), array('controller' => 'docnotes', 'action' => 'notes', $docnote['Docnote']['document_id'])); ?>
                </td>
            </tr>
        <?php
        endforeach; ?>
        </tbody>
    </table>
</div>
