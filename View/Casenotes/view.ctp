<div class="casenotes view">
<h2><?php echo __('Contact Note'); ?></h2>
    <br>
    <div class="actions">
        <?php echo $this->Html->link(__('Return to case'), array('controller' => 'Clientcases', 'action' => 'view', $casenote['Casenote']['clientcase_id'], '#' => 'tab4')); ?>
    </div>
    <br>
	<dl>
		<dt><?php echo __('Created by'); ?></dt>
		<dd>
            <?php echo h($author); ?>
            &nbsp;
		</dd>
		<dt><?php echo __('Subject'); ?></dt>
		<dd>
			<?php echo h($casenote['Casenote']['subject']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Note Type'); ?></dt>
		<dd>
			<?php echo h($casenote['Casenote']['note_type']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Note'); ?></dt>
		<dd>
			<?php echo h($casenote['Casenote']['note']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($this->Time->format('d-m-Y h:i', $casenote['Casenote']['created'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>

