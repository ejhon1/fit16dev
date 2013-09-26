<div class="docnotes index">
	<h2><?php echo __('Document Notes'); ?></h2>
    <button type="button" class="expand">Expand all</button>
    <?php
    echo $this->Form->create('Docnote');
    echo $this->Form->input('note');
    echo $this->Form->end(__('Submit'));
    ?>
	<table cellpadding="0" cellspacing="0">
    <tbody>
	<?php foreach ($docnotes as $docnote): ?>
	<tr>
		<td>
			<?php echo h($docnote['User']['id']); ?>
        <td><?php echo h($this->Time->format('d-m-Y', $docnote['Docnote']['created'])); ?>&nbsp;</td>
    </tr>
    <tr>
		<td colspan="2"><?php echo h($docnote['Docnote']['note']); ?>&nbsp;</td>

	</tr>
    </tbody>
<?php endforeach; ?>
	</table>

</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Docnote'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Documents'), array('controller' => 'documents', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Document'), array('controller' => 'documents', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
