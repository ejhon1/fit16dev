<?php
$loggedUser = $this->UserAuth->getUser();
if(!empty($loggedUser['User']['type']) && $loggedUser['User']['type'] == 'Employee')
{
?>

<div class="home">
    <br>
    <div class="actions">
        <?php echo $this->Html->link(__('Generate Reports'), array('controller' => 'clientcases', 'action' => 'reporting')); ?>
    </div>
    <br>
    <div class="row">
        <div class="span5"><p>
            <h3><?php echo __('Number of cases at each stage'); ?></h3>
            <br>
            <table>
                <thead>
                <tr>
                    <th class="heading">No. of Cases</th>
                    <th class="heading">Status</th>
                    <th class="heading">Action</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $i = 0;
                foreach ($statuses as $status): ?>
                    <tr class="list">
                        <td valign="top">
                            <?php echo h($count[$i]); ?>
                        </td>
                        <td valign="top">
                            <?php echo h($status['Status']['status_type']); ?>
                        </td>
                        <td class="actions">
                            <?php echo $this->Html->link(__('View'), array('controller' => 'clientcases', 'action' => 'index', $status['Status']['id'])); ?>
                        </td>
                    </tr>
                <?php
                $i++;
                endforeach; ?>
                </tbody>
            </table>
        </p></div>
        <div class="span5"><p>
            <h3><?php echo __('Most recent documents'); ?><a class="btn pull-right" data-toggle="modal" href="./documents">Full list</a></h3>
            <br>
            <table>
                <thead>
                <tr>
                    <th class="heading">Archive</th>
                    <th class="heading">Category</th>
                    <th class="heading">Uploaded</th>
                    <th class="heading">Action</th>
                </tr>
                </thead>
                <tbody>
                <?php
                foreach ($documents as $document): ?>
                    <tr>
                        <td valign="top">
                            <?php echo h($document['Archive']['archive_name']); ?>
                        </td>
                        <td>
                            <?php
                            if(!empty($document['Applicant']['id']))
                            {
                                echo 'Applicant';
                            }
                            else if(!empty($document['Ancestortype']['id']))
                            {
                                echo 'Ancestor';
                            }
                            else if(!empty($document['Document']['copy_type']) && $document['Document']['copy_type'] != 'Digital')
                            {
                                echo h($document['Document']['copy_type']);
                            }
                            else
                            {
                                echo 'Unknown';
                            }
                            ?>
                        </td>
                        <td valign="top">
                            <?php echo h($this->Time->format('d-m-Y', $document['Document']['created'])); ?>
                        </td>
                        <td class="actions">
                            <?php echo $this->Html->link(__('View'), array('controller' => 'documents', 'action' => 'view', $document['Document']['id'])); ?>
                            <?php if($document['Document']['copy_type'] == 'Digital')
                            {
                                echo $this->Html->link(__('Download'), array('controller' => 'documents', 'action' => 'sendFile', $document['Document']['id']));
                            }
                            ?>
                        </td>
                    </tr>
                <?php
                endforeach; ?>
                </tbody>
            </table>
        </p></div>
    </div>
    <br>
    <div class="row">
        <div class="span5"><p>
            <h3><?php echo __('Most recent contact notes'); ?><a class="btn pull-right" data-toggle="modal" href="./casenotes">Full list</a></h3>
            <br>
            <table>
                <tbody>
                <?php
                foreach ($casenotes as $casenote): ?>
                    <tr>
                        <td valign="top">
                            <?php echo h($casenote['Casenote']['subject']); ?>
                        </td>
                        <td valign="top">
                            <?php echo h($this->Time->format('h:i d-m-Y', $casenote['Casenote']['created'])); ?>
                        </td>
                        <td class="actions">
                            <?php echo $this->Html->link(__('View'), array('controller' => 'clientcases', 'action' => 'view', $casenote['Casenote']['clientcase_id'], '#' => 'tab4')); ?>
                        </td>
                    </tr>
                    <tr>
                        <td valign="top" colspan="3">
                            <?php echo String::truncate($casenote['Casenote']['note'], 55, array('html' => true));
                            //echo h($casenote['Casenote']['note']); ?>
                        </td>
                    </tr>
                <?php
                endforeach; ?>
                </tbody>
            </table>
        </p></div>
        <div class="span5"><p>
            <h3><?php echo __('Most recent document notes'); ?><a class="btn pull-right" data-toggle="modal" href="./docnotes">Full list</a></h3>
            <br>
            <table>
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
                            <?php echo h($this->Time->format('h:i d-m-Y', $docnote['Docnote']['created'])); ?>
                        </td>
                        <td class="actions">
                            <?php echo $this->Html->link(__('View'), array('controller' => 'docnotes', 'action' => 'notes', $docnote['Docnote']['document_id'])); ?>
                        </td>
                    </tr>
                    <tr>
                        <td valign="top" colspan="4">
                            <?php echo String::truncate($docnote['Docnote']['note'], 55, array('html' => true)); ?>
                        </td>
                    </tr>
                <?php
                endforeach; ?>
                </tbody>
            </table>
        </p></div>
    </div>
</div>

<?php } ?>
