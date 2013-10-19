<?php
echo $this->HTML->script('JQueryUser');
?>

<div class="clientcases index">
    <h2><?php echo __('Merging Archives'); ?></h2>

    <?php if(empty($clientcase))
    {
        ?>
        Enter the name of the archive that you want to merge with.
    <br>
    <?php
        echo $this->Form->create('Clientcase'); ?>
    <fieldset>
        <?php echo $this->Form->input('archive_name'); ?>
    </fieldset>

       <?php echo $this->Form->end(__('Search'));
    }
    else
    {
        ?>
        Confirm that this is the archive that you want to merge with.
        <br>
        <?php
        echo $this->Form->create('Clientcase', array('default' => 'false', 'action' => 'performmerge'));
        echo $this->Form->hidden('new_clientcase_id', array('default' => $id));
        echo $this->Form->hidden('old_archive_id', array('default' => $clientcase['Clientcase']['archive_id']));
        ?>
    <p>
        <br>
    <table>
        <thead>
        <tr>
            <th class="heading">Archive Name</th>
            <th class="heading">Applicant Name</th>
            <th class="heading">Status</th>
            <th class="heading">Open or Closed</th>
            <th class="heading">Date Created</th>
        </tr>
        </thead>
        <tbody>
            <tr class="list">
                <td valign="top">
                    <?php echo h($clientcase['Archive']['archive_name']); ?>
    </td>
    <td valign="top">
        <?php echo h($clientcase['Applicant']['first_name'].' '.$clientcase['Applicant']['surname']); ?>
    </td>
    <td valign="top">
        <?php echo h($clientcase['Status']['status_type']); ?>
    </td>
    <td valign="top"><?php echo h($clientcase['Clientcase']['open_or_closed']); ?>&nbsp;</td>
    <td valign="top"><?php echo h($this->Time->format('d-m-Y', $clientcase['Clientcase']['created'])); ?>&nbsp;</td>
    </tr>
    </tbody>
    </table>
    <?php
        echo $this->Form->end(__('Merge'));

    }
        ?>
</div>
