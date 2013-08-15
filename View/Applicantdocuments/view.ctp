<div class="applicantdocuments view">
<h2><?php  echo __('Applicantdocument'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($applicantdocument['Applicantdocument']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Archive'); ?></dt>
		<dd>
			<?php echo $this->Html->link($applicantdocument['Archive']['id'], array('controller' => 'archives', 'action' => 'view', $applicantdocument['Archive']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Applicant'); ?></dt>
		<dd>
			<?php echo $this->Html->link($applicantdocument['Applicant']['title'], array('controller' => 'applicants', 'action' => 'view', $applicantdocument['Applicant']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Document Type'); ?></dt>
		<dd>
			<?php echo h($applicantdocument['Applicantdocument']['document_type']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Note'); ?></dt>
		<dd>
			<?php echo h($applicantdocument['Applicantdocument']['note']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Filename'); ?></dt>
		<dd>
			<?php echo h($applicantdocument['Applicantdocument']['filename']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Filesize'); ?></dt>
		<dd>
			<?php echo h($applicantdocument['Applicantdocument']['filesize']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Filemime'); ?></dt>
		<dd>
			<?php echo h($applicantdocument['Applicantdocument']['filemime']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($applicantdocument['Applicantdocument']['created']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Applicantdocument'), array('action' => 'edit', $applicantdocument['Applicantdocument']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Applicantdocument'), array('action' => 'delete', $applicantdocument['Applicantdocument']['id']), null, __('Are you sure you want to delete # %s?', $applicantdocument['Applicantdocument']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Applicantdocuments'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Applicantdocument'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Archives'), array('controller' => 'archives', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Archive'), array('controller' => 'archives', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Applicants'), array('controller' => 'applicants', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Applicant'), array('controller' => 'applicants', 'action' => 'add')); ?> </li>
	</ul>
</div>
