<?php
    echo $this->Html->script('JQueryUser');
    echo $this->HTML->css('usersIndex');
?>

<div class="clients index">
	<h2><?php echo __('Clients'); ?></h2>
	<table cellpadding="0" cellspacing="2" id="data">
    <thead>
	<tr>
        <th class="heading">Archive Name</th>
        <th class="heading">Open/closed</th>
        <th class="actions"><?php echo __('View'); ?></th>
	</tr>
    </thead>
    <tbody>
	<?php foreach ($clients as $client):
 //       if($client['Archive']['archive_name']?>

        <tr class="list">
            <td valign="top"><?php echo h($client['Archive']['archive_name']); ?>&nbsp;</td>
            <td valign="top"><?php echo h($client['Client']['open_or_closed']); ?>&nbsp;</td>
            <td class="actions">
                <?php echo $this->Html->link(__('View'), array('action' => 'view', $client['Client']['id'])); ?>
            </td>
        </tr>
<?php endforeach; ?>
    </tbody>
	</table>


	<p>

</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Client'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Archives'), array('controller' => 'archives', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Archive'), array('controller' => 'archives', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Applicants'), array('controller' => 'applicants', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Applicant'), array('controller' => 'applicants', 'action' => 'add')); ?> </li>
	</ul>
</div>
