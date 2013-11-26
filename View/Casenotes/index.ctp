<?php
echo $this->HTML->script('JQueryUser');
?>
<div class="casenotes index">
	<h2><?php echo __('Contact Notes'); ?></h2>
	<table id="data">
    <thead>
	<tr>
        <th class="heading">Archive</th>
        <th class="heading">Client</th>
        <th class="heading">Subject</th>
        <th class="heading">Note</th>
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
                <?php echo h($casenote['Applicant']['first_name'].' '.$casenote['Applicant']['surname']); ?>
            </td>
            <td valign="top">
                <?php echo h($casenote['Casenote']['subject']); ?>
            </td>
            <td valign="top">
                <?php echo String::truncate($casenote['Casenote']['note'], 60, array('html' => true));
                //echo h($casenote['Casenote']['note']); ?>
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
</div>
