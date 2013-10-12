<?php
echo $this->HTML->script('JQueryUser');
?>
<div class="docnotes index">
	<h2><?php echo __('Document Notes'); ?></h2>
    <table id="data">
        <thead>
        <tr>
            <th>Author</th>
            <th>Note</th>
            <th>Created</th>
            <th>View</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($docnotes as $docnote): ?>
            <tr>
                <td valign="top">
                    <?php if(!empty($docnote['Docnote']['employee_id']))
                    {
                        echo h($docnote['Employee']['first_name'].' '.$docnote['Employee']['surname'].' (Staff)');
                    }
                    else
                    {
                        echo h($docnote['Clientcase']['Applicant']['first_name'].' '.$docnote['Clientcase']['Applicant']['surname'].' (Client)');
                    }
                    ?>
                </td>
                <td valign="top">
                    <?php echo String::truncate($docnote['Docnote']['note'], 255, array('html' => true)); ?>
                </td>
                <td valign="top">
                    <?php echo h($this->Time->format('d-m-Y h:i', $docnote['Docnote']['created'])); ?>
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
