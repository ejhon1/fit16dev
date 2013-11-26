<div class="casestatuses view">
<h2><?php echo __('Casestatus'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($casestatus['Casestatus']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Clientcase'); ?></dt>
		<dd>
			<?php echo $this->Html->link($casestatus['Clientcase']['id'], array('controller' => 'clientcases', 'action' => 'view', $casestatus['Clientcase']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo $this->Html->link($casestatus['Status']['id'], array('controller' => 'statuses', 'action' => 'view', $casestatus['Status']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Casestatus'), array('action' => 'edit', $casestatus['Casestatus']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Casestatus'), array('action' => 'delete', $casestatus['Casestatus']['id']), null, __('Are you sure you want to delete # %s?', $casestatus['Casestatus']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Casestatuses'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Casestatus'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Clientcases'), array('controller' => 'clientcases', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Clientcase'), array('controller' => 'clientcases', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Statuses'), array('controller' => 'statuses', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Status'), array('controller' => 'statuses', 'action' => 'add')); ?> </li>
	</ul>
</div>
