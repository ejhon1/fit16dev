<?php
echo $this->Html->script('JQueryUser');
echo $this->HTML->css('usersIndex');
echo $this->HTML->css('jquery.dataTables');
?>

<div class="applicants index">
	<h2><?php echo __('Enquiries'); ?></h2>
	<table cellpadding="0" cellspacing="0" id="data">
    <thead>
	<tr>
        <th class="heading">Archive Name</th>
        <th class="heading">Main Applicant</th>
        <th class="heading">Email Address</th>
        <th class="actions"><?php echo __('View'); ?></th>
	</tr>
    </thead>
    <tbody>
	<?php foreach ($applicants as $applicant):
    if($applicant['Client']['status'] == 'Enquiry')
    {?>
    <tr class="list">
        <td valign="top">
			<?php echo $this->Html->link($applicant['Archive']['archive_name'], array('controller' => 'archives', 'action' => 'view', $applicant['Archive']['id'])); ?>
		</td>
        <td valign="top"><?php echo h($applicant['Applicant']['title'].' '.$applicant['Applicant']['first_name']. ' '.$applicant['Applicant']['surname']); ?>&nbsp;</td>
        <td valign="top"><?php echo h($applicant['Applicant']['email']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('controller' => 'clients', 'action' => 'view', $applicant['Applicant']['client_id'])); ?>
        </td>
	</tr>
    <?php
    }
    endforeach; ?>
    </tbody>
	</table>
	<p>
</div>

