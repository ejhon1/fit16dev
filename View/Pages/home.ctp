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
                    <th class="heading"></th>
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
                    <th class="heading">Client</th>
                    <th class="heading">Uploaded</th>
                    <th class="heading"></th>
                </tr>
                </thead>
                <tbody>
                <?php
                foreach ($documents as $document): ?>
                    <tr>
                        <td valign="top">
                            <?php echo h($document['Archive']['archive_name']); ?>
                        </td>
                        <td valign="top">
                            <?php echo h($document['Applicant']['first_name'].' '.$document['Applicant']['surname']); ?>
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
                    <thead>
                    <tr>
                        <th class="heading">Archive</th>
                        <th class="heading">Client</th>
                        <th class="heading">Subject</th>
                        <th class="heading">Created</th>
                        <th class="heading"></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($casenotes as $casenote): ?>
                        <tr>
                            <td valign="top">
                                <?php echo h($casenote['Archive']['archive_name']); ?>
                            </td>
                            <td valign="top">
                                <?php echo h($casenote['Applicant']['first_name'].' '.$casenote['Applicant']['surname']); ?>
                            </td>
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
                    <?php
                    endforeach; ?>
                    </tbody>
                </table>
                </p></div>
            <div class="span5"><p>
                <h3><?php echo __('Most recent document notes'); ?><a class="btn pull-right" data-toggle="modal" href="./docnotes">Full list</a></h3>
                <br>
                <table>
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
                                <?php echo h($this->Time->format('h:i d-m-Y', $docnote['Docnote']['created'])); ?>
                            </td>
                            <td class="actions">
                                <?php echo $this->Html->link(__('View'), array('controller' => 'docnotes', 'action' => 'notes', $docnote['Docnote']['document_id'])); ?>
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
