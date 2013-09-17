<?php
echo $this->HTML->script('JQueryUser');
echo $this->HTML->css('jquery.dataTables');
?>

<div class="clientcases index">
    <h2><?php echo __('Cases'); ?></h2>
    <?php
    echo $this->Form->create('Clientcases');
    echo $this->Form->input('status_id', array('empty' => 'All', 'options' => $statuses, 'label' => 'Status Filter'));
    echo $this->Form->end(__('Filter'));
    ?>
    <table cellpadding="0" cellspacing="2" id="data">
        <thead>
        <tr>
            <th class="heading">Archive Name</th>
            <th class="heading">Status</th>
            <th class="heading">Applicant Name</th>
            <th class="heading">Open or Closed</th>
            <th class="heading">Date Created</th>
            <th class="heading">View</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($clientcases as $clientcase): ?>
            <?php if(empty($status) || $clientcase['Clientcase']['status_id'] == $status){
                ?>
            <tr class="list">
                <td valign="top">
                    <?php echo $this->Html->link($clientcase['Archive']['archive_name'], array('controller' => 'archives', 'action' => 'view', $clientcase['Archive']['id'])); ?>
                </td>
                <td valign="top">
                    <?php echo h($clientcase['Status']['status_type']); ?>
                </td>
                <td valign="top">
                    <?php echo $this->Html->link($clientcase['Applicant']['first_name'].' '.$clientcase['Applicant']['surname'], array('controller' => 'applicants', 'action' => 'view', $clientcase['Applicant']['id'])); ?>
                </td>
                <td valign="top"><?php echo h($clientcase['Clientcase']['open_or_closed']); ?>&nbsp;</td>
                <td valign="top"><?php echo h($this->Time->format('d-m-Y', $clientcase['Clientcase']['created'])); ?>&nbsp;</td>
                <td class="actions">
                    <?php echo $this->Html->link(__('View'), array('action' => 'view', $clientcase['Clientcase']['id'])); ?>
                </td>
            </tr>
        <?php
            }
        ?>
        <?php endforeach; ?>
        </tbody>
    </table>
    <p>
</div>

