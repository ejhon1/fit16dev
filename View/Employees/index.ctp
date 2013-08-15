<?php
    echo $this->Html->script('JQueryUser');
    echo $this->HTML->css('usersIndex');
    echo $this->HTML->css('jquery.dataTables');
?>

<div class="employees index">
	<h2><?php echo __('Employees'); ?></h2>
	<table cellpadding="0" cellspacing="0" id="data">
    <thead>
    <tr>
            <th class="heading">Name</th>
            <th class="heading">Email Address</th>
            <th class="heading">Role</th>
            <th class="heading">Status</th>
			<th class="actions"><?php echo __('View'); ?></th>
	</tr>
    </thead>
    <tbody>
	<?php foreach ($employees as $employee): ?>
	<tr>
        <td valign="top"><?php echo h($employee['Employee']['first_name'].' '.$employee['Employee']['surname']); ?>&nbsp;</td>
        <td valign="top"><?php echo h($employee['Employee']['email']); ?>&nbsp;</td>
        <td valign="top"><?php echo h($employee['Role']['type']); ?>&nbsp;</td>
        <td valign="top"><?php echo h($employee['Employee']['status']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $employee['Employee']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Employee'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
