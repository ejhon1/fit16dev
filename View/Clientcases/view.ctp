<div class="clientcases view">
<script>
    $(function()
    {
        $( "#tabs" ).tabs();
    });
    $(function() {
        $( "#accordion" ).accordion({
            active: false,
            collapsible: true,
            heightStyle: "content"

        });
    });
    
    $(function () {
	$("#accordion").accordion(
	{
		collapsible:true,
		active:false
	});
		var icons = $( "#accordion" ).accordion( "option", "icons" );
		$('.open').click(function () 
		{
			$('.ui-accordion-header').removeClass('ui-corner-all').addClass('ui-accordion-header-active ui-state-active ui-corner-top').attr(
			{
				'aria-selected': 'true',
				'tabindex': '0'
			});
			$('.ui-accordion-header-icon').removeClass(icons.header).addClass(icons.headerSelected);
			$('.ui-accordion-content').addClass('ui-accordion-content-active').attr(
		{
			'aria-expanded': 'true',
			'aria-hidden': 'false'
		}).show();
			$(this).attr("disabled","disabled");
				$('.close').removeAttr("disabled");
			});
			$('.close').click(function () 
			{
				$('.ui-accordion-header').removeClass('ui-accordion-header-active ui-state-active ui-corner-top').addClass('ui-corner-all').attr(
				{
					'aria-selected': 'false',
					'tabindex': '-1'
				});
				$('.ui-accordion-header-icon').removeClass(icons.headerSelected).addClass(icons.header);
				$('.ui-accordion-content').removeClass('ui-accordion-content-active').attr(
				{
					'aria-expanded': 'false',
					'aria-hidden': 'true'
				}).hide();
				$(this).attr("disabled","disabled");
				$('.open').removeAttr("disabled");
			});
			$('.ui-accordion-header').click(function () 
			{
				$('.open').removeAttr("disabled");
				$('.close').removeAttr("disabled");
        
			});
		});
</script>

<div id="tabs">
<ul>
    <li><a href="#tabs-1">Information</a></li>
    <li><a href="#tabs-2">Applicants</a></li>
    <?php if($clientcase['Clientcase']['born_in_poland'] != NULL)
    {
        ?>
        <li><a href="#tabs-3">Eligibility Check</a></li>
    <?php
    }
    ?>
    <li><a href="#tabs-4">Case Status</a></li>
    <li><a href="#tabs-5">Case Notes</a></li>
    <li><a href="#tabs-6">Documents</a></li>
</ul>
<div id="tabs-1">
    <p>
    <h3>Case Information</h3>
    <p>
    <dl>
        <dt><?php echo __('Archive name'); ?></dt>
        <dd>
            <?php echo $this->Html->link($clientcase['Archive']['archive_name'], array('controller' => 'archives', 'action' => 'view', $clientcase['Archive']['id'])); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Current status'); ?></dt>
        <dd>
            <?php echo h($clientcase['Status']['status_type']); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Open or closed'); ?></dt>
        <dd>
            <?php echo h($clientcase['Clientcase']['open_or_closed']); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Date of enquiry'); ?></dt>
        <dd>
            <?php echo h($this->Time->format('d-m-Y', $clientcase['Clientcase']['created'])); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Appointment date'); ?></dt>
        <?php if($clientcase['Clientcase']['appointment_date'] != NULL)
        {
            ?>
            <dd>
                <?php echo h($this->Time->format('d-m-Y h:i', $clientcase['Clientcase']['appointment_date'])); ?>
                &nbsp;
            </dd>
        <?php
        }
        else
        {
            ?>
            <dd>
                <?php echo __('Add'); ?>
                &nbsp;
            </dd>
        <?php
        }
        ?>
        <dt><?php echo __('File status:'); ?></dt>
        <?php
        if(!empty($currentloan['Archiveloan']['date_borrowed']) && empty($currentloan['Archiveloan']['date_returned']))
        {
        ?>
            <dd> <?php echo __('Borrowed'); ?> &nbsp; </dd>
            <dt><?php echo __('Date Borrowed'); ?></dt>
            <dd> <?php echo h($this->Time->format('d-m-Y h:i', $currentloan['Archiveloan']['date_borrowed'])); ?>&nbsp;</dd>
        <?php
            if($currentloan['Archiveloan']['employee_id'] == $employee['Employee']['id'])
            {
                echo $this->Form->create('Archiveloan');
                echo $this->Form->hidden('id', array('default' => $currentloan['Archiveloan']['id']));
                echo $this->Form->hidden('employee_id', array('default' => NULL));
                echo $this->Form->hidden('date_returned', array('default' => date('Y-m-d h:i:s')));
                echo $this->Form->end(__('Return'));
            }
        }
        else
        {
            ?>
            <dd> <?php echo __('On Shelf'); ?> &nbsp; </dd>
        <?php
            echo $this->Form->create('Archiveloan');
            echo $this->Form->hidden('archive_id', array('default' => $clientcase['Clientcase']['archive_id']));
            echo $this->Form->hidden('employee_id', array('default' => $employee['Employee']['id']));
            echo $this->Form->hidden('date_borrowed', array('default' => date('Y-m-d h:i:s')));
            echo $this->Form->end(__('Borrow'));
        }
        ?>

        <br>
        <dt><?php echo __('Main applicant'); ?></dt>
        <dd>
            <?php echo $this->Html->link($clientcase['Applicant']['first_name'].' '.$clientcase['Applicant']['surname'], array('controller' => 'applicants', 'action' => 'view', $clientcase['Applicant']['id'])); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Landline Number'); ?></dt>
                <dd>
                    <?php echo $clientcase['Applicant']['landline_number']; ?>
                    &nbsp;
                </dd>

                <dt><?php echo __('Mobile Number'); ?></dt>
                <dd>
                    <?php echo $clientcase['Applicant']['mobile_number']; ?>
                    &nbsp;
                </dd>


                <dt><?php echo __('Email'); ?></dt>
                <dd>
                    <?php echo $clientcase['Applicant']['email']; ?>
                    &nbsp;
                </dd>
    </dl>
</div>
<div id="tabs-2">
    <p>
    <h3><?php echo __('Applicants'); ?></h3>
    <?php if (!empty($applicants)): ?>
        <table cellpadding = "0" cellspacing = "0">
            <tr>
                <th><?php echo __('Name'); ?></th>
                <th><?php echo __('Email'); ?></th>
                <th><?php echo __('Phone Number'); ?></th>
                <th><?php echo __('Type'); ?></th>
                <th class="actions"><?php echo __('Actions'); ?></th>
            </tr>
            <?php foreach ($applicants as $applicant): ?>
                <tr>
                    <td><?php echo h($applicant['Applicant']['title'].' '.$applicant['Applicant']['first_name'].' '.$applicant['Applicant']['surname']); ?></td>
                    <td><?php echo $applicant['Applicant']['email']; ?></td>
                    <td><?php echo $applicant['Applicant']['landline_number']; ?></td>
                    <td><?php echo $applicant['Applicant']['applicant_type']; ?></td>
                    <td class="actions">
                        <?php echo $this->Html->link(__('View'), array('controller' => 'applicants', 'action' => 'view', $applicant['Applicant']['id'])); ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
    <div class="actions">
        <ul>
            <li><?php echo $this->Html->link(__('Add Related Applicant'), array('controller' => 'applicants', 'action' => 'add', $clientcase['Clientcase']['id'])); ?> </li>
        </ul>
    </div>
</div>
<?php if($clientcase['Clientcase']['born_in_poland'] != NULL)
{
    ?>
    <div id="tabs-3">
        <p>
        <h3>Case Information</h3>
        <p>
        <dl>
            <dt><?php echo __('Born In Poland'); ?></dt>
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
            </dd>
        </dl>
    </div>
<?php
}
?>
<div id="tabs-4">
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


<div id="tabs-5">
    <p>
    <h3><?php echo __('Related Casenotes'); ?></h3>
    <?php if (!empty($clientcase['Casenote'])): ?>
        <table cellpadding = "0" cellspacing = "0">
            <tr>
                <!-- <th><?php echo __('Id'); ?></th>
<th><?php echo __('Clientcase Id'); ?></th>
<th><?php echo __('User Id'); ?></th>
<th><?php echo __('Notesubject Id'); ?></th> -->
                <th><?php echo __('Created'); ?></th>
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
                    <th><?php echo $this->Time->format('d-m-Y',$casenote['created']); ?></th>
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
<div id="tabs-6">
    <div class="accordion-expand-holder">
			<button type="button" class="open">Expand all</button>
			<button type="button" class="close">Collapse all</button>
		</div>
		<div id="accordion">
			<h3>Ancestor Documents</h3>
			<div>
				<?php if (!empty($ancestordocuments)): ?>
				<table cellpadding="0" cellspacing="0">
					<tr>
						<th class="heading">Ancestor Type</th>
						<th class="heading">Document Type</th>
		                <th class="heading">File name</th>
						<th class="heading">Uploaded</th>
						<th class="actions"><?php echo __('View'); ?></th>
						</tr>
						<?php foreach ($ancestordocuments as $ancestordocument): ?>
						<tr class="list">
							<td valign="top">
								<?php echo h($ancestordocument['Ancestortype']['ancestor_type']); ?>
								</td>
								<td valign="top">
									<?php echo h($ancestordocument['Documenttype']['type']); ?>
									</td>
									<td valign="top"><?php echo h($ancestordocument['Document']['filename']); ?>&nbsp;</td>
									<td valign="top"><?php echo h($this->Time->format('d-m-Y h:i',$ancestordocument['Document']['created'])); ?>&nbsp;</td>
									<td class="actions">
										<?php echo $this->Html->link(__('View'), array('controller' => 'documents', 'action' => 'view', $ancestordocument['Document']['id'])); ?>
							</td>
						</tr>
					<?php endforeach; ?>
				</table>

				<?php
					endif;
					?>
					</div>
					<h3>Applicant Documents</h3>
					<div>
						<?php if (!empty($applicantdocuments)): ?>

						<table cellpadding="0" cellspacing="0">
							<tr>
								<th class="heading">Applicant</th>
								<th class="heading">Document Type</th>
								<th class="heading">File Name</th>
								<th class="heading">Uploaded</th>
								<th class="heading">View</th>
								</tr>
								<?php foreach ($applicantdocuments as $applicantdocument): ?>
								<tr class="list">
									<td valign="top">
										<?php echo h($applicantdocument['Applicant']['first_name'].' '.$applicantdocument['Applicant']['surname']); ?>
										</td>
										<td valign="top">
											<?php echo h($applicantdocument['Documenttype']['type']); ?>
										</td>
										<td valign="top"><?php echo h($applicantdocument['Document']['filename']); ?>&nbsp;</td>
										<td valign="top"><?php echo h($this->Time->format('d-m-Y h:i',$applicantdocument['Document']['created'])); ?>&nbsp;</td>
										<td class="actions">
											<?php echo $this->Html->link(__('View'), array('controller' => 'documents', 'action' => 'view', $applicantdocument['Document']['id'])); ?>
										</td>
							</tr>
							<?php endforeach; ?>
						</table>
						<?php
							endif;
						?>
					</div>
				</div>
			</div>
		</div>
</div>

</div>
</div>
<br/> 
