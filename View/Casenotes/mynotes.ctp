<?php echo $this->HTML->css('usersIndex'); ?>

<div class="casenotes index">
	<h2><?php echo __('Contact Notes'); ?></h2>
	<div class="actions">
        <ul>
            <li>
            <?php echo $this->Html->link(__('Add Contact Notes'), array('controller' => 'casenotes', 'action' => 'mynotesadd')); ?>
            </li>
        </ul>
    	</div>
	<table cellpadding="0" cellspacing="0">
        <tr>
            <th class="heading">Date</th>
            <th class="heading">Note</th>
            <th class="heading">User ID</th>
            <th class="actions"><?php echo __('View'); ?></th>
        </tr>

		<?php foreach ($casenotes as $casenote): ?>
			<tr>
				<td><?php echo h($casenote['Casenote']['created']); ?>&nbsp;</td>
				<td><?php echo h($casenote['Casenote']['note']); ?>&nbsp;</td>
				<td><?php echo $this->Html->link($casenote['User']['id'], array('controller' => 'users', 'action' => 'view', $casenote['User']['id'])); ?></td>
				<td class="actions">
					<?php echo $this->Html->link(__('View'), array('action' => 'view', $casenote['Casenote']['id'])); ?>
			</tr>
<?php endforeach; ?>
	</table>

</div>
