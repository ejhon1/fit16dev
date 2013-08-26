<div class="clientcases view">
	<script>
        $(function() 
        {
            $( "#tabs" ).tabs();
        });
    </script>
    
    <div id="tabs">
        <ul>
            <li><a href="#tabs-1">Information</a></li>
            <li><a href="#tabs-2">Applicants</a></li>
            <li><a href="#tabs-3">Case Status</a></li>
            <li><a href="#tabs-4">Case Notes</a></li>
        </ul>
        <div id="tabs-1">
            <p>
            <h3>Case Information</h3>
            <p>
			<dl>
				<!-- <dt><?php echo __('Id'); ?></dt>
				<dd>
					<?php echo h($clientcase['Clientcase']['id']); ?>
					&nbsp;
				</dd>
				<dt><?php echo __('User'); ?></dt>
				<dd>
					<?php echo $this->Html->link($clientcase['User']['id'], array('controller' => 'users', 'action' => 'view', $clientcase['User']['id'])); ?>
					&nbsp;
				</dd> -->
				<dt><?php echo __('Archive'); ?></dt>
				<dd>
					<?php echo $this->Html->link($clientcase['Archive']['id'], array('controller' => 'archives', 'action' => 'view', $clientcase['Archive']['id'])); ?>
					&nbsp;
				</dd>
				<dt><?php echo __('Status'); ?></dt>
				<dd>
					<?php echo $this->Html->link($clientcase['Status']['id'], array('controller' => 'statuses', 'action' => 'view', $clientcase['Status']['id'])); ?>
					&nbsp;
				</dd>
				<!-- <dt><?php echo __('Applicant'); ?></dt>
				<dd>
					<?php echo $this->Html->link($clientcase['Applicant']['title'], array('controller' => 'applicants', 'action' => 'view', $clientcase['Applicant']['id'])); ?>
					&nbsp;
				</dd> -->
				<dt><?php echo __('Open Or Closed'); ?></dt>
				<dd>
					<?php echo h($clientcase['Clientcase']['open_or_closed']); ?>
					&nbsp;
				</dd>
				<dt><?php echo __('Enquiry Date'); ?></dt>
				<dd>
					<?php echo h($clientcase['Clientcase']['enquiry_date']); ?>
					&nbsp;
				</dd>
				<dt><?php echo __('Appointment Date'); ?></dt>
				<dd>
					<?php echo h($clientcase['Clientcase']['appointment_date']); ?>
					&nbsp;
				</dd>
				<!-- <dt><?php echo __('Born In Poland'); ?></dt>
				<dd>
					<?php echo h($clientcase['Clientcase']['born_in_poland']); ?>
					&nbsp;
				</dd>
				<dt><?php echo __('Nationality Of Parents'); ?></dt>
				<dd>
					<?php echo h($clientcase['Clientcase']['nationality_of_parents']); ?>
					&nbsp;
				</dd>
				<dt><?php echo __('Mother Name'); ?></dt>
				<dd>
					<?php echo h($clientcase['Clientcase']['mother_name']); ?>
					&nbsp;
				</dd>
				<dt><?php echo __('Father Name'); ?></dt>
				<dd>
					<?php echo h($clientcase['Clientcase']['father_name']); ?>
					&nbsp;
				</dd>
				<dt><?php echo __('Nationality Of Grandparents'); ?></dt>
				<dd>
					<?php echo h($clientcase['Clientcase']['nationality_of_grandparents']); ?>
					&nbsp;
				</dd>
				<dt><?php echo __('Mat Grandmother Name'); ?></dt>
				<dd>
					<?php echo h($clientcase['Clientcase']['mat_grandmother_name']); ?>
					&nbsp;
				</dd>
				<dt><?php echo __('Mat Grandfather Name'); ?></dt>
				<dd>
					<?php echo h($clientcase['Clientcase']['mat_grandfather_name']); ?>
					&nbsp;
				</dd>
				<dt><?php echo __('Pat Grandmother Name'); ?></dt>
				<dd>
					<?php echo h($clientcase['Clientcase']['pat_grandmother_name']); ?>
					&nbsp;
				</dd>
				<dt><?php echo __('Pat Grandfather Name'); ?></dt>
				<dd>
					<?php echo h($clientcase['Clientcase']['pat_grandfather_name']); ?>
					&nbsp;
				</dd>
				<dt><?php echo __('Nationality Of Others'); ?></dt>
				<dd>
					<?php echo h($clientcase['Clientcase']['nationality_of_others']); ?>
					&nbsp;
				</dd>
				<dt><?php echo __('Serve In Army'); ?></dt>
				<dd>
					<?php echo h($clientcase['Clientcase']['serve_in_army']); ?>
					&nbsp;
				</dd>
				<dt><?php echo __('Serve In Army Info'); ?></dt>
				<dd>
					<?php echo h($clientcase['Clientcase']['serve_in_army_info']); ?>
					&nbsp;
				</dd>
				<dt><?php echo __('When Left Poland'); ?></dt>
				<dd>
					<?php echo h($clientcase['Clientcase']['when_left_poland']); ?>
					&nbsp;
				</dd>
				<dt><?php echo __('Where Left Poland'); ?></dt>
				<dd>
					<?php echo h($clientcase['Clientcase']['where_left_poland']); ?>
					&nbsp;
				</dd>
				<dt><?php echo __('Where Left Poland Other'); ?></dt>
				<dd>
					<?php echo h($clientcase['Clientcase']['where_left_poland_other']); ?>
					&nbsp;
				</dd>
				<dt><?php echo __('Have Passport'); ?></dt>
				<dd>
					<?php echo h($clientcase['Clientcase']['have_passport']); ?>
					&nbsp;
				</dd>
				<dt><?php echo __('Possess Documents'); ?></dt>
				<dd>
					<?php echo h($clientcase['Clientcase']['possess_documents']); ?>
					&nbsp;
				</dd>
				<dt><?php echo __('Possess Documents Types'); ?></dt>
				<dd>
					<?php echo h($clientcase['Clientcase']['possess_documents_types']); ?>
					&nbsp;
				</dd>
				<dt><?php echo __('Possess Documents Other'); ?></dt>
				<dd>
					<?php echo h($clientcase['Clientcase']['possess_documents_other']); ?>
					&nbsp;
				</dd>
				<dt><?php echo __('Other Factors'); ?></dt>
				<dd>
					<?php echo h($clientcase['Clientcase']['other_factors']); ?>
					&nbsp;
				</dd>
				<dt><?php echo __('Created'); ?></dt>
				<dd>
					<?php echo h($clientcase['Clientcase']['created']); ?>
					&nbsp;
				</dd>
				<dt><?php echo __('Modified'); ?></dt>
				<dd>
					<?php echo h($clientcase['Clientcase']['modified']); ?>
					&nbsp;
				</dd> -->
			</dl>
		</div>
		
		<div id="tabs-2">
            <p>
            <h3><?php echo __('Applicants'); ?></h3>
            <?php if (!empty($clientcase['Applicant'])): ?>
            <table cellpadding = "0" cellspacing = "0">
            <tr>
            	<!-- <th><?php echo __('Id'); ?></th>
				<th><?php echo __('Clientcase Id'); ?></th>
				<th><?php echo __('Archive Id'); ?></th>
				<th><?php echo __('Birthdate'); ?></th>
				<th><?php echo __('Title'); ?></th> -->
				<th><?php echo __('First Name'); ?></th>
				<!-- <th><?php echo __('Middle Name'); ?></th> -->
				<th><?php echo __('Surname'); ?></th>
				<th><?php echo __('Email'); ?></th>
				<th><?php echo __('Landline Number'); ?></th>
				<th><?php echo __('Mobile Number'); ?></th>
				<th><?php echo __('Applicant Type'); ?></th>
				<!-- <th><?php echo __('Created'); ?></th>
				<th><?php echo __('Modified'); ?></th> -->
				<th class="actions"><?php echo __('Actions'); ?></th>
			</tr>
		<?php
			$i = 0;
			foreach ($clientcase['Applicant'] as $applicant): ?>
			<tr>
				<!-- <td><?php echo $applicant['id']; ?></td>
				<td><?php echo $applicant['clientcase_id']; ?></td>
				<td><?php echo $applicant['archive_id']; ?></td>
				<td><?php echo $applicant['birthdate']; ?></td>
				<td><?php echo $applicant['title']; ?></td> -->
				<td><?php echo $applicant['first_name']; ?></td>
				<!-- <td><?php echo $applicant['middle_name']; ?></td> -->
				<td><?php echo $applicant['surname']; ?></td>
				<td><?php echo $applicant['email']; ?></td>
				<td><?php echo $applicant['landline_number']; ?></td>
				<td><?php echo $applicant['mobile_number']; ?></td>
				<td><?php echo $applicant['applicant_type']; ?></td>
				<!-- <td><?php echo $applicant['created']; ?></td>
				<td><?php echo $applicant['modified']; ?></td> -->
				<td class="actions">
					<?php echo $this->Html->link(__('View'), array('controller' => 'applicants', 'action' => 'view', $applicant['id'])); ?>
					<?php echo $this->Html->link(__('Edit'), array('controller' => 'applicants', 'action' => 'edit', $applicant['id'])); ?>
					<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'applicants', 'action' => 'delete', $applicant['id']), null, __('Are you sure you want to delete # %s?', $applicant['id'])); ?>
				</td>
			</tr>
		<?php endforeach; ?>
		</table>
	<?php endif; ?>
	
		<div class="actions">
			<ul>
				<li><?php echo $this->Html->link(__('New Applicant'), array('controller' => 'applicants', 'action' => 'add')); ?> </li>
			</ul>
		</div>
	</div>
	
	<div id="tabs-3">
        <p>
        <h3><?php echo __('Related Casestatuses'); ?></h3>
		<?php if (!empty($clientcase['Casestatus'])): ?>
		<table cellpadding = "0" cellspacing = "0">
			<tr>
				<th><?php echo __('Id'); ?></th>
				<th><?php echo __('Clientcase Id'); ?></th>
				<th><?php echo __('Status Id'); ?></th>
				<th class="actions"><?php echo __('Actions'); ?></th>
			</tr>
			<?php
				$i = 0;
				foreach ($clientcase['Casestatus'] as $casestatus): ?>
			<tr>
				<td><?php echo $casestatus['id']; ?></td>
				<td><?php echo $casestatus['clientcase_id']; ?></td>
				<td><?php echo $casestatus['status_id']; ?></td>
				<td class="actions">
					<?php echo $this->Html->link(__('View'), array('controller' => 'casestatuses', 'action' => 'view', $casestatus['id'])); ?>
					<?php echo $this->Html->link(__('Edit'), array('controller' => 'casestatuses', 'action' => 'edit', $casestatus['id'])); ?>
					<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'casestatuses', 'action' => 'delete', $casestatus['id']), null, __('Are you sure you want to delete # %s?', $casestatus['id'])); ?>
				</td>
			</tr>
			<?php endforeach; ?>
		</table>
		<?php endif; ?>

		<div class="actions">
			<ul>
				<li><?php echo $this->Html->link(__('New Casestatus'), array('controller' => 'casestatuses', 'action' => 'add')); ?> </li>
				</ul>
		</div>
	</div>


	<div id="tabs-4">
        <p>
        <h3><?php echo __('Related Casenotes'); ?></h3>
		<?php if (!empty($clientcase['Casenote'])): ?>
		<table cellpadding = "0" cellspacing = "0">
			<tr>
				<!-- <th><?php echo __('Id'); ?></th>
				<th><?php echo __('Clientcase Id'); ?></th>
				<th><?php echo __('User Id'); ?></th>
				<th><?php echo __('Notesubject Id'); ?></th> -->
				<th><?php echo $this->Time->format('d-m-Y',$casenote['created']); ?></th>
				<th><?php echo __('Note Type'); ?></th>
				<th><?php echo __('Note'); ?></th>
				
				<!-- <th><?php echo __('Modified'); ?></th> -->
				<th class="actions"><?php echo __('Actions'); ?></th>
			</tr>
			<?php
				$i = 0;
				foreach ($clientcase['Casenote'] as $casenote): ?>
				<tr>
					<!-- <td><?php echo $casenote['id']; ?></td>
					<td><?php echo $casenote['clientcase_id']; ?></td>
					<td><?php echo $casenote['user_id']; ?></td>
					<td><?php echo $casenote['notesubject_id']; ?></td> -->
					<td><?php echo $casenote['created']; ?></td>
					<td><?php echo $casenote['note_type']; ?></td>
					<td><?php echo $casenote['note']; ?></td>
					
					<!-- <td><?php echo $casenote['modified']; ?></td> -->
					<td class="actions">
						<?php echo $this->Html->link(__('View'), array('controller' => 'casenotes', 'action' => 'view', $casenote['id'])); ?>
						<!-- <?php echo $this->Html->link(__('Edit'), array('controller' => 'casenotes', 'action' => 'edit', $casenote['id'])); ?>
						<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'casenotes', 'action' => 'delete', $casenote['id']), null, __('Are you sure you want to delete # %s?', $casenote['id'])); ?> -->
					</td>
					</tr>
			<?php endforeach; ?>
		</table>
			<?php endif; ?>

			<div class="actions">
				<ul>
					<li><?php echo $this->Html->link(__('New Casenote'), array('controller' => 'casenotes', 'action' => 'add')); ?> </li>
				</ul>
			</div>
	</div>
</div>		
<br/>		
<div>
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Clientcase'), array('action' => 'edit', $clientcase['Clientcase']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Clientcase'), array('action' => 'delete', $clientcase['Clientcase']['id']), null, __('Are you sure you want to delete # %s?', $clientcase['Clientcase']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Clientcases'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Clientcase'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Archives'), array('controller' => 'archives', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Archive'), array('controller' => 'archives', 'action' => 'add')); ?> </li>
		<!-- <li><?php echo $this->Html->link(__('List Statuses'), array('controller' => 'statuses', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Status'), array('controller' => 'statuses', 'action' => 'add')); ?> </li> -->
		<li><?php echo $this->Html->link(__('List Applicants'), array('controller' => 'applicants', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Applicant'), array('controller' => 'applicants', 'action' => 'add')); ?> </li>
		<!-- <li><?php echo $this->Html->link(__('List Casenotes'), array('controller' => 'casenotes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Casenote'), array('controller' => 'casenotes', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Casestatuses'), array('controller' => 'casestatuses', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Casestatus'), array('controller' => 'casestatuses', 'action' => 'add')); ?> </li> -->
	</ul>
</div>

