<?php echo $this->Html->script('bootstrap-datepicker.js');
echo $this->HTML->css('datepicker'); ?>

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

        <?php echo $this->Form->end(__('Submit')); ?>
    </fieldset>


<?php if(!empty($date1))
{
?>    <table>
        <tbody>
            <tr>
                <th>Successful Enquiries</th>
                <td><?php echo h($noSucEnq); ?></td>
            </tr>
            <tr>
                <th>Denied Enquiries</th>
                <td><?php echo h($noDenEnq); ?></td>
            </tr>
            <tr>
                <th>Case Notes Sent</th>
                <td><?php echo h($noCaseNotes); ?></td>
            </tr>
            <tr>
                <th>Documents Downloaded</th>
                <td><?php echo h($noDocsDown); ?></td>
            </tr>
            <tr>
                <th>Document Notes Added</th>
                <td><?php echo h($noDocNotes); ?></td>
            </tr>
        </tbody>
    </table>
    <br><br>

    <table id="data">
        <thead>
        <tr>
            <th class="heading">Applicant Name</th>
            <th class="heading">Status</th>
            <th class="heading">Archive Name</th>
            <th class="heading">Open or Closed</th>
            <th class="heading">Date Created</th>
            <th class="heading">View</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($clientcases as $clientcase): ?>

            <tr class="list">
                <td valign="top">
                    <?php echo h($clientcase['Applicant']['first_name'].' '.$clientcase['Applicant']['surname']); ?>
                </td>
                <td valign="top">
                    <?php echo h($clientcase['Status']['status_type']); ?>
                </td>
                <td valign="top">
                    <?php echo h($clientcase['Archive']['archive_name']); ?>
                </td>
                <td valign="top"><?php echo h($clientcase['Clientcase']['open_or_closed']); ?>&nbsp;</td>
                <td valign="top"><?php echo h($this->Time->format('d-m-Y', $clientcase['Clientcase']['created'])); ?>&nbsp;</td>
                <td class="actions">
                    <?php echo $this->Html->link(__('View'), array('action' => 'view', $clientcase['Clientcase']['id'])); ?>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php } ?>
