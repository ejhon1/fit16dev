<?php echo $this->Html->script('bootstrap-datepicker.js');
echo $this->HTML->css('datepicker');
echo $this->HTML->script('JQueryUser');?>
    <script>
        $(document).ready(function() {
            $('.datepicker').datepicker({
                autoclose: true
            });
        });
    </script>

<?php echo $this->Form->create('Clientcase'); ?>
    <fieldset>
       <?php echo $this->Form->input('date1', array('label' => 'First date','class'=>'datepicker', 'id'=>"dpd1")); ?>
       <?php echo $this->Form->input('date2', array('label' => 'Second date','class'=>'datepicker', 'id'=>"dpd2")); ?>
       <?php
       echo $this->Form->input('selection', array(
           'options' => array(
               1 => 'Successful enquiries',
               2 => 'Denied enquiries',
               3 => 'Contact notes sent',
               4 => 'Documents uploaded',
               5 => 'Document notes added',
               6 => 'Changed statuses',
               7 => 'No contact notes',
               8 => 'No status changes')
       ));
       ?>
        <?php echo $this->Form->end(__('Submit')); ?>
    </fieldset>

<?php if($selected == 1)
{ ?>
    <h3>Successful Enquiries</h3>
    <?php echo $this->Form->create('Clientcase', array('action' => 'report'));
    echo $this->Form->hidden('date1', array('default' => $date1));
    echo $this->Form->hidden('date2', array('default' => $date2));
    echo $this->Form->end(__('Excel Report'));?>
    <br>
    <table id="data">
        <thead>
        <tr>
            <th class="heading">Archive</th>
            <th class="heading">Applicant Name</th>
            <th class="heading">Date Created</th>
            <th class="heading">Status</th>
            <th class="heading">View</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($clientcases as $clientcase): ?>
            <tr class="list">
                <td valign="top">
                    <?php echo h($clientcase['Archive']['archive_name']); ?>
                </td>
                <td valign="top">
                    <?php echo h($clientcase['Applicant']['first_name'].' '.$clientcase['Applicant']['surname']); ?>
                </td>
                <td valign="top"><?php echo h($this->Time->format('d-m-Y', $clientcase['Clientcase']['created'])); ?>&nbsp;</td>
                <td valign="top">
                    <?php echo h($clientcase['Status']['status_type']); ?>
                </td>
                <td class="actions">
                    <?php echo $this->Html->link(__('View'), array('action' => 'view', $clientcase['Clientcase']['id'])); ?>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

<?php } else if($selected == 2)
{
?>
    <h3>Denied Enquiries</h3>
    <?php echo $this->Form->create('Clientcase', array('action' => 'report2'));
    echo $this->Form->hidden('date1', array('default' => $date1));
    echo $this->Form->hidden('date2', array('default' => $date2));
    echo $this->Form->end(__('Excel Report'));?>
    <br>
    <table id="data">
        <thead>
        <tr>
            <th class="heading">Archive</th>
            <th class="heading">Applicant Name</th>
            <th class="heading">Date Created</th>
            <th class="heading">Status</th>
            <th class="heading">View</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($deniedcases as $deniedcase): ?>
            <tr class="list">
                <td valign="top">
                    <?php echo h($deniedcase['Applicant']['first_name'].' '.$deniedcase['Applicant']['surname']); ?>
                </td>
                <td valign="top"><?php echo h($this->Time->format('d-m-Y', $deniedcase['Clientcase']['created'])); ?>&nbsp;</td>
                <td class="actions">
                    <?php echo $this->Html->link(__('View'), array('action' => 'view', $deniedcase['Clientcase']['id'])); ?>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php } else if($selected == 3)
{
    ?>
    <h3>Contact notes sent</h3>
    <?php echo $this->Form->create('Casenote', array('controller' => 'casenotes', 'action' => 'report'));
    echo $this->Form->hidden('date1', array('default' => $date1));
    echo $this->Form->hidden('date2', array('default' => $date2));
    echo $this->Form->end(__('Excel Report'));?>
    <table id="data">
        <thead>
        <tr>
            <th class="heading">Archive</th>
            <th class="heading">Author</th>
            <th class="heading">Client</th>
            <th class="heading">Subject</th>
            <th class="heading">Created</th>
            <th class="actions"></th>
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
                    <?php if(!empty($casenote['Employee']['first_name']))
                    {
                        echo h($casenote['Employee']['first_name'].' '.$casenote['Employee']['surname']);
                    } else
                    {
                        echo h($casenote['Applicant']['first_name'].' '.$casenote['Applicant']['surname']);
                    }?>
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
        <?php endforeach; ?>
        </tbody>
    </table>
<?php }  else if($selected == 4)
{
    ?>
    <h3>Documents uploaded</h3>
    <?php echo $this->Form->create('Document', array('controller' => 'documents', 'action' => 'report'));
    echo $this->Form->hidden('date1', array('default' => $date1));
    echo $this->Form->hidden('date2', array('default' => $date2));
    echo $this->Form->end(__('Excel Report'));?>
    <table id="data">
        <thead>
        <tr>
            <th class="heading">Archive</th>
            <th class="heading">Client</th>
            <th class="heading">Type</th>
            <th class="heading">Filename</th>
            <th class="heading">Uploaded</th>
            <th class="actions"><?php echo __('Actions'); ?></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($documents as $document): ?>
            <tr class="list">
                <td>
                    <?php echo h($document['Archive']['archive_name']); ?>
                </td>
                <td>
                    <?php echo h($document['Applicant']['first_name'].' '.$document['Applicant']['surname']); ?>
                </td>
                <td valign="top">
                    <?php echo h($document['Documenttype']['type']); ?>
                </td>
                <td valign="top"><?php echo h($document['Document']['filename']); ?></td>
                <td valign="top"><?php echo h($this->Time->format('d-m-Y h:i', $document['Document']['created'])); ?></td>
                <td class="actions">
                    <?php echo $this->Html->link(__('View'), array('controller' => 'clientcases', 'action' => 'view', $document['Clientcase']['id'], '#' => 'tab5')); ?>
                    <?php if($document['Document']['copy_type'] == 'Digital')
                    {
                        echo $this->Html->link(__('Download'), array('controller' => 'documents', 'action' => 'sendFile', $document['Document']['id']));
                    }
                    ?>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php } else if($selected == 5)
{
    ?>
    <h3>Document notes sent</h3>
    <?php echo $this->Form->create('Docnote', array('controller' => 'docnotes', 'action' => 'report'));
    echo $this->Form->hidden('date1', array('default' => $date1));
    echo $this->Form->hidden('date2', array('default' => $date2));
    echo $this->Form->end(__('Excel Report'));?>
    <table id="data">
        <thead>
        <tr>
            <th class="heading">Archive</th>
            <th class="heading">Author</th>
            <th class="heading">Client</th>
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
                    <?php if(!empty($docnote['Docnote']['employee_id']))
                    {
                        echo h($docnote['Employee']['first_name'].' '.$docnote['Employee']['surname']);
                    }
                    else
                    {
                        echo h($docnote['Applicant']['first_name'].' '.$docnote['Applicant']['surname']);
                    }
                    ?>
                </td>
                <td valign="top">
                    <?php echo h($docnote['Applicant']['first_name'].' '.$docnote['Applicant']['surname']); ?>
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
<?php } else if($selected == 6)
{
    ?>
    <h3>Cases with status changes</h3>
    <?php echo $this->Form->create('Clientcase', array('action' => 'report3'));
    echo $this->Form->hidden('date1', array('default' => $date1));
    echo $this->Form->hidden('date2', array('default' => $date2));
    echo $this->Form->end(__('Excel Report'));?>
    <br>
    <table id="data">
        <thead>
        <tr>
            <th class="heading">Archive</th>
            <th class="heading">Applicant Name</th>
            <th class="heading">Date Created</th>
            <th class="heading">Status</th>
            <th class="heading">View</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($changedcases as $changedcase): ?>
            <tr class="list">
                <td valign="top">
                    <?php echo h($changedcase['Archive']['archive_name']); ?>
                </td>
                <td valign="top">
                    <?php echo h($changedcase['Applicant']['first_name'].' '.$changedcase['Applicant']['surname']); ?>
                </td>
                <td valign="top"><?php echo h($this->Time->format('d-m-Y', $changedcase['Clientcase']['created'])); ?>&nbsp;</td>
                <td valign="top">
                    <?php echo h($changedcase['Status']['status_type']); ?>
                </td>
                <td class="actions">
                    <?php echo $this->Html->link(__('View'), array('action' => 'view', $changedcase['Clientcase']['id'])); ?>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php } else if($selected == 7)
{

?>
<?php } else if($selected == 8)
{
?>
    <h3>Cases without status changes</h3>
    <br>
    <table id="data">
        <thead>
        <tr>
            <th class="heading">Archive</th>
            <th class="heading">Applicant Name</th>
            <th class="heading">Date Created</th>
            <th class="heading">Status</th>
            <th class="heading">View</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($nochangedcases as $nochangedcase): ?>
            <tr class="list">
                <td valign="top">
                    <?php echo h($nochangedcase['Archive']['archive_name']); ?>
                </td>
                <td valign="top">
                    <?php echo h($nochangedcase['Applicant']['first_name'].' '.$nochangedcase['Applicant']['surname']); ?>
                </td>
                <td valign="top"><?php echo h($this->Time->format('d-m-Y', $nochangedcase['Clientcase']['created'])); ?>&nbsp;</td>
                <td valign="top">
                    <?php echo h($nochangedcase['Status']['status_type']); ?>
                </td>
                <td class="actions">
                    <?php echo $this->Html->link(__('View'), array('action' => 'view', $nochangedcase['Clientcase']['id'])); ?>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

<?php
}?>
