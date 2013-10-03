

<div class="casenotes index">
	<h2><?php echo __('Contact Notes'); ?></h2>
	<div class="actions">
        <ul>
            <li>
            <?php echo $this->Html->link(__('Add a Note'), array('controller' => 'casenotes', 'action' => 'mynotesadd')); ?>
            </li>
        </ul>
    	</div>
	<table cellpadding="0" cellspacing="0">
        <tr>
            <th class="heading">Date</th>
            <th class="heading">Note</th>
        </tr>

		<?php foreach ($casenotes as $casenote): ?>
			<tr>
				<td><?php echo h($casenote['Casenote']['created']); ?>&nbsp;</td>
				<td><?php echo h($casenote['Casenote']['note']); ?>&nbsp;</td>
			</tr>
<?php endforeach; ?>
	</table>

</div>
