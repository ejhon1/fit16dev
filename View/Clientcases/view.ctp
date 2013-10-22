<?php
echo $this->Html->script('bootstrap-datepicker.js');
echo $this->HTML->css('datepicker');
echo $this->HTML->script('JQueryUser');
?>

<script>
    $(document).ready(function() {
        $('.datepicker').datepicker({
            autoclose: true
        });
    });


</script>

<div class="clientcases view">
<script>
    $(function(){
        var hash = window.location.hash;
        hash && $('ul.nav a[href="' + hash + '"]').tab('show');

        $('.nav-tabs a').click(function (e) {
            $(this).tab('show');
            var scrollmem = $('body').scrollTop();
            window.location.hash = this.hash;
            $('html,body').scrollTop(scrollmem);
        });
    });
</script>

<div id="clientcases">
<ul id="tabs" class="nav nav-tabs" data-tabs="tabs">
    <li class="active"><a href="#tab1" data-toggle="tab">Information</a></li>
    <?php if($clientcase['Clientcase']['born_in_poland'] != NULL)
    {
        ?>
        <li><a href="#tab2" data-toggle="tab">Eligibility Check</a></li>
    <?php
    }
    ?>
    <li><a href="#tab3" data-toggle="tab">Case Status</a></li>
    <li><a href="#tab4" data-toggle="tab">Contact Notes</a></li>
    <li><a href="#tab5" data-toggle="tab">Documents</a></li>
</ul>
<div id="my-tab-content" class="tab-content">
    <div class="tab-pane active" id="tab1">
        <p>
        <h3>Case Information</h3>
        <p>
        <table>
            <tbody>
            <tr>
                <th>Archive name</th>
                <td><?php echo h($clientcase['Archive']['archive_name']); ?></td>
                <th>Current status</th>
                <td><?php echo h($clientcase['Status']['status_type']); ?></td>
            </tr>
            <tr>
                <th>Open or closed</th>
                <td><?php 
                		if($clientcase['Clientcase']['open_or_closed'] == 'Open')
                		{
	                		echo h($clientcase['Clientcase']['open_or_closed']); 
	                		echo $this->Form->create('Clientcase', array('action' => 'updateOpenClose', $clientcase['Clientcase']['id']));
                			echo $this->Form->hidden('id', array('default' => $clientcase['Clientcase']['id']));
                            echo $this->Form->hidden('open_or_closed', array('default' => 'Closed'));
                            echo $this->Form->end(__('Close'));?></td>
                        <?php
                		}
                		else
                		{
                			echo h($clientcase['Clientcase']['open_or_closed']); 
                   			echo $this->Form->create('Clientcase', array('action' => 'updateOpenClose', $clientcase['Clientcase']['id']));
                			echo $this->Form->hidden('id', array('default' => $clientcase['Clientcase']['id']));
                            echo $this->Form->hidden('open_or_closed', array('default' => 'Open'));
                            echo $this->Form->end(__('Open')); ?></td>
                        <?php
                		}
						?>
                <th>Date of enquiry</th>
                <td><?php echo h($this->Time->format('d-m-Y', $clientcase['Clientcase']['created'])); ?></td>
            </tr>
            <tr>
                <th>Appointment date</th>
                <td>
                    <?php if(!empty($clientcase['Clientcase']['appointment_date']))
                    {
                        echo h($this->Time->format('d-m-Y', $clientcase['Clientcase']['appointment_date']));
                    ?>
                    	<br/>

                    <?php
                    }
                    else
                    {
                    ?>
                        None
                    <?php
                    }
                    ?>
                </td>

                <td> <?php if(!empty($clientcase['Clientcase']['appointment_date']))
                    { ?>
                        <a class="btn" data-toggle="modal" href="#modalEditdAppointmentDate">Edit Date</a>
                    <?php
                    }else
                    {
                        ?>
                        <a class="btn" data-toggle="modal" href="#modalAddAppointmentDate">Add Date</a>
                    <?php
                    }
                    ?>
                </td>
                <td></td>
            </tr>
            <tr>
                <th>File status</th>
                    <?php
                    if(!empty($currentloan['Archiveloan']['date_borrowed']) && empty($currentloan['Archiveloan']['date_returned']))
                    {
                        ?>
                        <td> <?php echo __('Borrowed'); ?></td>
                        <th>Borrowed by</th>
                        <td><?php echo $employee['Employee']['first_name']. ' '.$employee['Employee']['surname']; ?></td>
                </tr>
                <tr>
                        <th><?php echo __('Date Borrowed'); ?></th>
                        <td> <?php echo h($this->Time->format('d-m-Y h:i', $currentloan['Archiveloan']['date_borrowed'])); ?></td>
                        <td>
                         <?php
                        if($currentloan['Archiveloan']['employee_id'] == $employee['Employee']['id'])
                        {
                            echo $this->Form->create('Archiveloan');
                            echo $this->Form->hidden('id', array('default' => $currentloan['Archiveloan']['id']));
                            //echo $this->Form->input('employee_id', array('default' => NULL));
                            echo $this->Form->hidden('date_returned', array('default' => date('Y-m-d h:i:s')));
                            echo $this->Form->end(__('Return'));
                        }

                        ?>
                </td>
                <td></td>
            <?php
                    }
                    else
                    {
                        ?>
                        <td> <?php echo __('On Shelf'); ?></td>
                        <td>
                        <?php
                        echo $this->Form->create('Archiveloan');
                        echo $this->Form->hidden('archive_id', array('default' => $clientcase['Clientcase']['archive_id']));
                        echo $this->Form->hidden('employee_id', array('default' => $employee['Employee']['id']));
                        echo $this->Form->hidden('date_borrowed', array('default' => date('Y-m-d h:i:s')));
                        echo $this->Form->end(__('Borrow'));
                       ?>
                       </td>
                        <td></td>
                    <?php
                    }
                    ?>
            </tr>
            <tr>

            </tr>
            </tbody>
        </table>
        <br>
        <?php if(count($applicantslist) > 1)
        {
            ?>
            <a class="btn" data-toggle="modal" href="#changeMainApplicant">ChangePrimaryApplicant</a>
        <?php
        }
        ?>
        <div class="actions">
            <ul>
        <?php
        if($user['User']['active'] != 1 && $user['User']['password'] == NULL)
        {
            ?>
                    <li><?php echo $this->Html->link(__('Activate'), array('plugin' => 'usermgmt', 'controller' => 'users', 'action' => 'activateAccount', $clientcase['Clientcase']['id'])); ?> </li>
        <?php
        }
        else{
            ?>
            <li><?php echo $this->Html->link(__('Recover Password'), array('plugin' => 'usermgmt', 'controller' => 'users', 'action' => 'recoverPassword', $clientcase['Clientcase']['id'])); ?> </li>
        <?php
        }
        if($archivecount <= 1)
        {
        ?>
                    <li><?php echo $this->Html->link(__('Merge'), array('action' => 'merge', $clientcase['Clientcase']['id'])); ?> </li>
                <?php
        }
                ?>
            </ul>
        </div>

        <br><br><br>
        <h3><?php echo __('Applicants'); ?></h3>
        <div class="actions">
            <ul>
                <li><?php echo $this->Html->link(__('Add Applicant'), array('controller' => 'applicants', 'action' => 'add', $clientcase['Clientcase']['id'])); ?> </li>
            </ul>
        </div>
        
        <br />
        <br />
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a class="accordion-toggle" data-toggle="collapse" data-target="#MainApplicant" href="#MainApplicant">
                        <?php echo h($mainapplicant['Applicant']['title'].' '.$mainapplicant['Applicant']['first_name'].' '.$mainapplicant['Applicant']['middle_name'].' '.$mainapplicant['Applicant']['surname']); ?>
                    </a></h4>
            </div>
            <div id="MainApplicant" class="panel-collapse collapse in">
                <div class="panel-body">
                    <table cellpadding = "0" cellspacing = "0">
                        <tr>
                            <th><?php echo __('Birthdate'); ?></th>
                            <th><?php echo __('Email'); ?></th>
                            <th><?php echo __('Phone Number'); ?></th>
                            <th><?php echo __('Mobile Number'); ?></th>
                            <th></th>
                        </tr>
                        <tr>
                            <td><?php echo $this->Time->format('d-m-Y',$mainapplicant['Applicant']['birthdate']); ?></td>
                            <td><?php echo $mainapplicant['Applicant']['email']; ?></td>
                            <td><?php echo $mainapplicant['Applicant']['landline_number']; ?></td>
                            <td><?php echo $mainapplicant['Applicant']['mobile_number']; ?></td>
                            <td class="actions"><?php echo $this->Html->link(__('Edit Applicant'), array('controller' => 'applicants', 'action' => 'edit', $mainapplicant['Applicant']['id'])); ?></td>
                        </tr>
                    </table>
                    <?php if(!empty($address))
                    {
                    ?>
                        <br>
                        <dl>
                            <dt><?php echo __('Address Line'); ?></dt>
                            <dd>
                                <?php echo h($address['Address']['address_line']); ?>
                                &nbsp;
                            </dd>
                            <dt><?php echo __('Suburb'); ?></dt>
                            <dd>
                                <?php echo h($address['Address']['suburb']); ?>
                                &nbsp;
                            </dd>
                            <dt><?php echo __('Postcode'); ?></dt>
                            <dd>
                                <?php echo h($address['Address']['postcode']); ?>
                                &nbsp;
                            </dd>
                            <dt><?php echo __('State'); ?></dt>
                            <dd>
                                <?php echo h($address['Address']['state']); ?>
                                &nbsp;
                            </dd>
                            <dt><?php echo __('Country'); ?></dt>
                            <dd>
                                <?php echo h($address['Country']['country_name']); ?>
                                &nbsp;
                            </dd>
                        </dl>
                        <br>
                        <div class="actions">
                            <ul>
                                <li><?php echo $this->Html->link(__('Change Address'), array('controller' => 'addresses', 'action' => 'edit', $address['Address']['id'])); ?> </li>
                            </ul>
                        </div>
                    <?php
                    }else{
                    ?>
                        <div class="actions">
                            <ul>
                                <li><?php echo $this->Html->link(__('Add Address'), array('controller' => 'addresses', 'action' => 'add', $mainapplicant['Applicant']['id'])); ?> </li>
                            </ul>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>

        <?php $i = 0;
        foreach ($applicants as $applicant):
            ?>

        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a class="accordion-toggle" data-toggle="collapse" data-target="<?php echo h('#Applicant'.$i); ?>" href="<?php echo h('#Applicant'.$i); ?>">
                        <?php echo h($applicant['Applicant']['title'].' '.$applicant['Applicant']['first_name'].' '.$applicant['Applicant']['middle_name'].' '.$applicant['Applicant']['surname']); ?>
                </a></h4>
            </div>
            <div id="<?php echo h('Applicant'.$i); ?>" class="panel-collapse collapse">
                <div class="panel-body">
                    <table cellpadding = "0" cellspacing = "0">
                        <tr>
                            <th><?php echo __('Birthdate'); ?></th>
                            <th><?php echo __('Email'); ?></th>
                            <th><?php echo __('Phone Number'); ?></th>
                            <th><?php echo __('Mobile Number'); ?></th>
                            <th></th>
                        </tr>
                        <tr>
                            <td><?php echo $this->Time->format('d-m-Y',$applicant['Applicant']['birthdate']); ?></td>
                            <td><?php echo $applicant['Applicant']['email']; ?></td>
                            <td><?php echo $applicant['Applicant']['landline_number']; ?></td>
                            <td><?php echo $applicant['Applicant']['mobile_number']; ?></td>
                            <td><?php echo $applicant['Applicant']['mobile_number']; ?></td>
                            <td class="actions"><?php echo $this->Html->link(__('Edit Applicant'), array('controller' => 'applicants', 'action' => 'edit', $applicant['Applicant']['id'])); ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <?php $i++;
        endforeach; ?>

    </div>
    <?php if($clientcase['Clientcase']['born_in_poland'] != NULL)
    {
        ?>
        <div class="tab-pane" id="tab2">
            <p>
            <h3>Eligibility Check Information</h3>
            <p>
            <div class="actions">
	            <ul>
		            <li>
			        	<?php echo $this->Html->link(__('Edit'), array('controller' => 'clientcases', 'action' => 'edit', $clientcase['Clientcase']['id'])); ?>
		            </li>
	            </ul>
	    </div>
            <table>
            	<tbody>
            		<tr  nth-child(even)>
            			<th>Existing Family</th>
            			<td><?php echo h($clientcase['Clientcase']['existing_family']); ?></td>
            			<th></th>
            			<td></td>
            		</tr>
            		<tr>
            			<th>Born In Poland</th>
            			<td><?php echo h($clientcase['Clientcase']['born_in_poland']); ?></td>
            			<th></th>
            			<td></td>
            		</tr>
            		<tr>
            			<th>Nationality Of Parents</th>
						<td><?php echo h($clientcase['Clientcase']['nationality_of_parents']); ?></td>
						<th></th>
						<td></td>
            		</tr>
            		<tr>
            			<th>Mother Name</th>
            			<td><?php echo h($clientcase['Clientcase']['mother_name']); ?></td>
            			<th>Father Name</th>
            			<td><?php echo h($clientcase['Clientcase']['father_name']); ?></td>
            		</tr>
            		<tr>
            			<th>Nationality Of Grandparents</th>
            			<td><?php echo h($clientcase['Clientcase']['nationality_of_grandparents']); ?></td>
            			<th></th>
            			<td></td>
            		</tr>
            		<tr>
            			<th>Maternal Grandmother Name</th>
            			<td><?php echo h($clientcase['Clientcase']['mat_grandmother_name']); ?></td>
            			<th>Maternal Grandfather Name</th>
            			<td><?php echo h($clientcase['Clientcase']['mat_grandfather_name']); ?></td>
            		</tr>
            		<tr>
	            		<th>Paternal Grandmother Name</th>
	            		<td><?php echo h($clientcase['Clientcase']['pat_grandmother_name']); ?></td>
	            		<th>Paternal Grandfather Name</th>
	            		<td><?php echo h($clientcase['Clientcase']['pat_grandfather_name']); ?></td>
            		</tr>
            		<tr>
            			<th>Nationality of Others</th>
            			<td><?php echo h($clientcase['Clientcase']['nationality_of_others']); ?></td>
            			<th></th>
            			<td></td>
            		</tr>
            		<tr>
            			<th>Service In Army</th>
            			<td><?php echo h($clientcase['Clientcase']['serve_in_army']); ?></td>
            			<th></th>
            			<td></td>
            		</tr>
            		<tr>
            			<th>Service In Army Information</th>
            			<td><?php echo h($clientcase['Clientcase']['serve_in_army_info']); ?></td>
            			<th></th>
            			<td></td>
            		</tr>
            		<tr>
            			<th>When Left Poland</th>
            			<td><?php echo h($clientcase['Clientcase']['when_left_poland']); ?></td>
            			<th></th>
            			<td></td>
            		</tr>
            		<tr>
            			<th>Where Left Poland</th>
            			<td><?php echo h($clientcase['Clientcase']['where_left_poland']); ?></td>
            			<th></th>
            			<td></td>
            		</tr>
            		<tr>
            			<th>Where Left Poland Other</th>
            			<td><?php echo h($clientcase['Clientcase']['where_left_poland_other']); ?></td>
            			<th></th>
            			<td></td>
            		</tr>
            		<tr>
            			<th>Passport Available?</th>
            			<td><?php echo h($clientcase['Clientcase']['have_passport']); ?></td>
            			<th>Documents Available?</th>
						<td><?php echo h($clientcase['Clientcase']['possess_documents']); ?></td>
            		</tr>
            		<tr>
            			<th>Document Types</th>
            			<td><?php echo h($clientcase['Clientcase']['possess_documents_types']); ?></td>
            			<th></th>
            			<td></td>
            		</tr>
            		<tr>
            			<th>Other Documents</th>
				<td><?php echo h($clientcase['Clientcase']['possess_documents_other']); ?></td>
				<th></th>
				<td></td>
            		</tr>
            		<tr>
            			<th>Other Factors</th>
            			<td><?php echo h($clientcase['Clientcase']['other_factors']); ?></td>
            			<th>Date Registered</th>
            			<td><?php echo $this->Time->format('d-m-Y',$clientcase['Clientcase']['created']); ?></td>
            		</tr>
            	</tbody>
            </table>
        </div>
    <?php
    }
    ?>
    <div class="tab-pane" id="tab3">
    <p>
    <h3><?php echo __('Case Status'); ?></h3>
    <a class="btn" data-toggle="modal" href="#myModal1">Update Status</a>
    <?php if (!empty($clientcase['Casestatus'])): ?>
        <table cellpadding = "0" cellspacing = "0">
            <tr>
                <th><?php echo __('Status'); ?></th>
                <th><?php echo __('Date Updated'); ?></th>
                <th><?php echo __('Employee'); ?></th>
            </tr>
            <?php foreach ($casestatuses as $casestatus): ?>
            <tr>
                <td><?php echo $casestatus['Status']['status_type']; ?></td>
                <td><?php echo $casestatus['Casestatus']['date_updated']; ?></td>
                <td><?php echo $employee['Employee']['first_name']. ' '.$employee['Employee']['surname']; ?></td>
            </tr>
            <?php endforeach; ?>
            </table>
        <?php endif; ?>
    </div>


    <div class="tab-pane" id="tab4">
        <p>
        <h3><?php echo __('Contact Notes'); ?></h3>
        <!--<a class="btn" data-toggle="modal" href="#modalCaseNoteAdd">Add Note</a>-->
		<div class="actions">
            <ul>
                <li><?php echo $this->Html->link(__('New Note'), array('controller' => 'casenotes', 'action' => 'add', $clientcase['Clientcase']['id'])); ?> </li>
            </ul>
        </div>
        <?php if (!empty($clientcase['Casenote'])): ?>
            <table cellpadding = "0" cellspacing = "0" id="data">
			<thead> 
                <tr>
                    <th><?php echo __('Created'); ?></th>
                    <th><?php echo __('Subject'); ?></th>
                    <th><?php echo __('Note Type'); ?></th>
                    <th><?php echo __('Note'); ?></th>
                    <th class="actions"><?php echo __('Actions'); ?></th>
                </tr>
				</thead>
				<tbody>
                <?php
                $i = 0;
                foreach ($clientcase['Casenote'] as $casenote): ?>
                    <tr>
                        <th><?php echo $this->Time->format('d-m-Y',$casenote['created']); ?></th>
                        <td><?php echo $casenote['subject']; ?></td>
                        <td><?php echo $casenote['note_type']; ?></td>
                        <td>
		                     <?php echo String::truncate($casenote['note'], 50, array('html' => true));
						?>
		             </td> 
                        <td class="actions">
                            <?php echo $this->Html->link(__('View'), array('controller' => 'casenotes', 'action' => 'view', $casenote['id'])); ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
				</tbody> 
            </table>
        <?php endif; ?>

        
    </div>
    <div class="tab-pane" id="tab5">
    <div class="actions">
	
	</div>
        <div class="panel-group" id="accordion">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a class="accordion-toggle" data-toggle="collapse" data-target="#collapseOne" href="#collapseOne">
                            Ancestor Documents
                        </a><a class="btn pull-right" data-toggle="modal" href="#myModal2">Upload</a>
                    </h4>
                </div>
                <div id="collapseOne" class="panel-collapse collapse">
                    <div class="panel-body">
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
                                        <td valign="top"><?php echo h($this->Time->format('d-m-Y',$ancestordocument['Document']['created'])); ?>&nbsp;</td>
                                        <td>
                                            <?php echo $this->html->link($this->html->image("comments_icon.png"), array('controller' => 'docnotes', 'action' => 'notes', $ancestordocument['Document']['id']), array('escape' => false)); ?>
                                            <?php echo $this->html->link($this->html->image("download_icon.png"), array('controller' => 'documents', 'action' => 'sendfile', $ancestordocument['Document']['id']), array('escape' => false)); ?>
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
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a class="accordion-toggle" data-toggle="collapse" data-target="#collapseTwo" href="#collapseTwo">
                            Applicant Documents
                        </a><a class="btn pull-right" data-toggle="modal" href="#myModal3" >Upload</a>
                    </h4>
                </div>
                <div id="collapseTwo" class="panel-collapse collapse">
                    <div class="panel-body">
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
                                            <?php echo h($applicantdocument['Applicant']['first_name']); ?>
                                            </td>
                                            <td valign="top">
                                                <?php echo h($applicantdocument['Documenttype']['type']); ?>
                                            </td>
                                            <td valign="top"><?php echo h($applicantdocument['Document']['filename']); ?>&nbsp;</td>
                                            <td valign="top"><?php echo h($this->Time->format('d-m-Y',$applicantdocument['Document']['created'])); ?>&nbsp;</td>
                                        <td>
                                            <?php echo $this->html->link($this->html->image("comments_icon.png"), array('controller' => 'docnotes', 'action' => 'notes', $ancestordocument['Document']['id']), array('escape' => false)); ?>
                                            <?php echo $this->html->link($this->html->image("download_icon.png"), array('controller' => 'documents', 'action' => 'sendfile', $applicantdocument['Document']['id']), array('escape' => false)); ?>
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
                       <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a class="accordion-toggle" data-toggle="collapse" data-target="#collapseThree" href="#collapseThree">
                            Applicant Physical Documents
                        </a><a class="btn pull-right" data-toggle="modal" href="#modalAddPhysicalDoc1" >Add</a>
                    </h4>
                </div>
                <div id="collapseThree" class="panel-collapse collapse">
                    <div class="panel-body">
                        <?php if (!empty($physicalappdocuments)): ?>

                            <table cellpadding="0" cellspacing="0">
                                <tr>
                                    <th class="heading">Applicant Name</th>
                                    <th class="heading">Document Type</th>
                                    <th class="heading">Date Received</th>
                                    <th class="heading">Date Returned</th>
                                    <th class="heading">Category</th>
                                    <th class="heading">View</th>
                                </tr>
                                <?php foreach ($physicalappdocuments as $physicalappdocument): ?>
                                    <tr class="list">
                                        <td valign="top">
                                            <?php echo h($physicalappdocument['Applicant']['first_name']); ?>
                                        </td>
                                        <td valign="top">
                                            <?php echo h($physicalappdocument['Documenttype']['type']); ?>
                                        </td>
                                        <td valign="top">
                                            <?php echo h($this->Time->format('d-m-Y', $physicalappdocument['Document']['date_received'])); ?>
                                        </td>
                                        <td valign="top">
                                            <?php echo h($this->Time->format('d-m-Y', $physicalappdocument['Document']['date_returned'])); ?>
                                        </td>
                                        <td valign="top">
                                            <?php echo h($physicalappdocument['Document']['copy_type']); ?>
                                        </td>
                                        <td>
                                            <?php echo $this->html->link($this->html->image("comments_icon.png"), array('controller' => 'docnotes', 'action' => 'notes', $physicalappdocument['Document']['id']), array('escape' => false)); ?>
                                            <a class="" data-toggle="modal" href="#modalEditAppReturnedDate"><?php echo $this->html->image("cake.icon.png")?></a>
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


<div class="panel panel-default">
    <div class="panel-heading">
        <h4 class="panel-title">
            <a class="accordion-toggle" data-toggle="collapse" data-target="#collapseFour" href="#collapseFour">
                Ancestor Physical Documents
            </a><a class="btn pull-right" data-toggle="modal" href="#modalAddPhysicalDoc2" >Add</a>
        </h4>
    </div>
    <div id="collapseFour" class="panel-collapse collapse">
        <div class="panel-body">
            <?php if (!empty($physicalancdocuments)): ?>

                <table cellpadding="0" cellspacing="0">
                    <tr>
                        <th class="heading">Ancestor</th>
                        <th class="heading">Document Type</th>
                        <th class="heading">Date Received</th>
                        <th class="heading">Date Returned</th>
                        <th class="heading">Category</th>
                        <th class="heading">View</th>
                    </tr>
                    <?php foreach ($physicalancdocuments as $physicalancdocument): ?>
                        <tr class="list">
                            <td valign="top">
                                <?php echo h($physicalancdocument['Ancestortype']['ancestor_type']); ?>
                            </td>
                            <td valign="top">
                                <?php echo h($physicalancdocument['Documenttype']['type']); ?>
                            </td>
                            <td valign="top">
                                <?php echo h($this->Time->format('d-m-Y', $physicalancdocument['Document']['date_received'])); ?>
                            </td>
                            <td valign="top">
                                <?php echo h($this->Time->format('d-m-Y', $physicalancdocument['Document']['date_returned'])); ?>
                            </td>
                            <td valign="top">
                                <?php echo h($physicalancdocument['Document']['copy_type']); ?>
                            </td>
                            <td>
                                <?php echo $this->html->link($this->html->image("comments_icon.png"), array('controller' => 'docnotes', 'action' => 'notes', $physicalancdocument['Document']['id']), array('escape' => false)); ?>
                                <a class="" data-toggle="modal" href="#modalEditAncReturnedDate"><?php echo $this->html->image("cake.icon.png")?></a>
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


<div class="modal hide" id="myModal1"><!-- note the use of "hide" class -->

    <div class="modal-header">
        <button class="close" data-dismiss="modal">×</button>
        <h3>Update Case Status</h3>
    </div>
    <div class="modal-body">

        <?php echo $this->Form->create('Casestatus', array('action' => 'updatestatus')); ?>
        <fieldset>
            <?php
            echo $this->Form->input('status_id', array('default' => $clientcase['Clientcase']['status_id']));
            echo $this->Form->hidden('date_updated', array('default' => date('Y-m-d h:i:s')));
            echo $this->Form->hidden('clientcase_id', array('default' => $id));
            echo $this->Form->hidden('employee_id', array('default' => $employee['Employee']['id']));
            ?>
        </fieldset>

    </div>
    <div class="modal-footer">
        <?php echo $this->Form->end(__('Submit')); ?>
    </div>
</div>

<div class="modal hide" id="myModal2"><!-- note the use of "hide" class -->

    <div class="modal-header">
        <button class="close" data-dismiss="modal">×</button>
        <h3>Upload a document relating to an ancestor</h3>
    </div>
    <div class="modal-body">

        <?php echo $this->Form->create('Document', array('type' => 'file', 'default' => 'false', 'action' => 'staffuploadan'));?>
        <fieldset>
            <?php
            //echo $this->Form->hidden('archive_id', array('default' => $client['Client']['archive_id']));
            echo $this->Form->input('file', array('id' => 'file', 'type' => 'file'));
            echo $this->Form->input('ancestortype_id', array('id' => 'ancestortype_id','options'=>$ancestorTypes, 'label'=>'Family member'));
            echo $this->Form->input('documenttype_id', array('id' => 'documenttype_id','options'=>$documentTypes, 'label'=>'Type of document'));
            echo $this->Form->hidden('clientcase_id', array('default' => $id));

            ?>
        </fieldset>
    </div>
    <div class="modal-footer">
        <?php echo $this->Form->end(__('Upload File')); ?>
    </div>
</div>


<div class="modal hide" id="myModal3"><!-- note the use of "hide" class -->

    <div class="modal-header">
        <button class="close" data-dismiss="modal">×</button>
        <h3>Upload a document relating to an applicant</h3>
    </div>
    <div class="modal-body">

        <?php echo $this->Form->create('Document', array('type' => 'file', 'default' => 'false', 'action' => 'staffuploadapp'));?>
        <fieldset>
            <?php
            //echo $this->Form->hidden('archive_id', array('default' => $client['Client']['archive_id']));
            echo $this->Form->input('file', array('type' => 'file'));
            echo $this->Form->input('applicant_id', array('options'=>$applicantslist, 'label'=>'Applicant:'));
            echo $this->Form->input('documenttype_id', array('options'=>$documentTypes, 'label'=>'Type of document'));
            echo $this->Form->hidden('clientcase_id', array('default' => $id));
            ?>
        </fieldset>
    </div>
    <div class="modal-footer">
        <?php echo $this->Form->end(__('Upload File')); ?>
    </div>
</div>

<div class="modal hide" id="modalCaseNoteAdd"><!-- note the use of "hide" class -->
    <div class="modal-header">
        <button class="close" data-dismiss="modal">×</button>
        <h3>Add Contact Note</h3>
    </div>
    <div class="modal-body">
		<?php echo $this->Form->create('Casenote', array('action' => 'add')); ?>
        <fieldset>
            <?php
			echo $this->Form->hidden('clientcase_id', array('default' => $id));
			echo $this->Form->input('subject');
			
			echo $this->Form->input('note_type', array(
					'type' => 'radio',
					'legend'=>'Note Type',
					'default' => 'Internal',
					'options' => array('Internal' => 'Internal', 'Public'=>'Public')));
		echo $this->Form->input('note');
            ?>
        </fieldset>
    </div>
    <div class="modal-footer">
        <?php echo $this->Form->end(__('Add Note')); ?>
    </div>
</div>

<div class="modal hide" id="modalAddAppointmentDate"><!-- note the use of "hide" class -->
    <div class="modal-header">
        <button class="close" data-dismiss="modal">×</button>
        <h3>Add Appointment Date</h3>
    </div>
    <div class="modal-body">
		<?php echo $this->Form->create('Clientcase', array('action' => 'updateAppointmentDate', $clientcase['Clientcase']['id'])); ?>
        <fieldset>
        <?php
            echo $this->Form->hidden('id', array('default' => $id));
         echo $this->Form->input('appointmentDate', array('label' => 'Appointment Date','class'=>'datepicker', 'id'=>"dpd7"));

			
            ?>
        </fieldset>
    </div>
    <div class="modal-footer">
        <?php echo $this->Form->end(__('Add Date')); ?>
    </div>
</div>
<div class="modal hide" id="modalAddPhysicalDoc1"><!-- note the use of "hide" class -->
    <div class="modal-header">
        <button class="close" data-dismiss="modal">×</button>
        <h3>Add Applicant Physical Document</h3>
    </div>
    <div class="modal-body">
        <?php echo $this->Form->create('Document', array('type' => 'file', 'default' => 'false', 'action' => 'addphydoc', $id));?>
        <fieldset>
            <?php
            echo $this->Form->hidden('clientcase_id', array('default' => $id));
            echo $this->Form->input('applicant_id', array('options'=>$applicantslist, 'label'=>'Applicant:'));
            echo $this->Form->input('documenttype_id', array('options'=>$documentTypes, 'label'=>'Type of document'));
	    echo $this->Form->input('dateReceived', array('label' => 'Date Received','class'=>'datepicker', 'id'=>"dpd5"));
            echo $this->Form->input('copy_type', array(
                'type' => 'radio',
                'legend'=>'Note Type',
                'default' => 'Original',
                'options' => array('Original' => 'Original', 'Certified/Notarised'=>'Certified/Notarised')));
            ?>
        </fieldset>
    </div>
    <div class="modal-footer">
        <?php echo $this->Form->end(__('Add Document')); ?>
    </div>
</div>

<div class="modal hide" id="modalAddPhysicalDoc2"><!-- note the use of "hide" class -->
    <div class="modal-header">
        <button class="close" data-dismiss="modal">×</button>
        <h3>Add Ancestor Physical Document</h3>
    </div>
    <div class="modal-body">
        <?php echo $this->Form->create('Document', array('type' => 'file', 'default' => 'false', 'action' => 'addphydoc', $id));?>

        <fieldset>
            <?php
            echo $this->Form->hidden('clientcase_id', array('default' => $id));
            echo $this->Form->input('ancestortype_id', array('id' => 'ancestortype_id','options'=>$ancestorTypes, 'label'=>'Family member:'));
            echo $this->Form->input('documenttype_id', array('options'=>$documentTypes, 'label'=>'Type of document'));
            echo $this->Form->input('dateReceived', array('label' => 'Date Received','class'=>'datepicker', 'id'=>"dpd4"));
            echo $this->Form->input('copy_type', array(
                'type' => 'radio',
                'legend'=>'Note Type',
                'default' => 'Original',
                'options' => array('Original' => 'Original', 'Certified/Notarised'=>'Certified/Notarised')));
            ?>
        </fieldset>
    </div>
    <div class="modal-footer">
        <?php echo $this->Form->end(__('Add Document')); ?>
    </div>
</div>

<div class="modal hide" id="modalEditAppReturnedDate"><!-- note the use of "hide" class -->
    <div class="modal-header">
        <button class="close" data-dismiss="modal">×</button>
        <h3>Edit Applicant Document Return Date</h3>
    </div>
    <div class="modal-body">

        <?php echo $this->Form->create('Document', array('action' => 'editdate', $id));?>

        <fieldset>
            <?php
            echo $this->Form->hidden('clientcase_id', array('default' => $id));
            echo $this->Form->hidden('id', array('default' => $physicalappdocument['Document']['id']));
	    echo $this->Form->input('dateReturned', array('label' => 'Date Returned','class'=>'datepicker', 'id'=>"dpd2"));
            ?>
        </fieldset>
    </div>
    <div class="modal-footer">
        <?php echo $this->Form->end(__('Add Date')); ?>
    </div>
</div>

<div class="modal hide" id="modalEditAncReturnedDate"><!-- note the use of "hide" class -->
    <div class="modal-header">
        <button class="close" data-dismiss="modal">×</button>
        <h3>Edit Ancestor Document Return Date</h3>
    </div>
    <div class="modal-body">

        <?php echo $this->Form->create('Document', array('action' => 'editdate', $id));?>

        <fieldset>
            <?php
            echo $this->Form->hidden('clientcase_id', array('default' => $id));
            echo $this->Form->hidden('id', array('default' => $physicalancdocument['Document']['id']));
            echo $this->Form->input('dateReturned', array('label' => 'Date Returned','class'=>'datepicker', 'id'=>"dpd1")); 

            ?>
        </fieldset>
    </div>
    <div class="modal-footer">
        <?php echo $this->Form->end(__('Add Date')); ?>
    </div>
</div>

<div class="modal hide" id="modalEditdAppointmentDate"><!-- note the use of "hide" class -->
    <div class="modal-header">
        <button class="close" data-dismiss="modal">×</button>
        <h3>Edit Appointment Date</h3>
    </div>
    <div class="modal-body">
		<?php echo $this->Form->create('Clientcase', array('action' => 'editAppointmentDate', $clientcase['Clientcase']['id'])); ?>
        <fieldset>
        <?php
            echo $this->Form->hidden('id', array('default' => $id));
            echo $this->Form->input('appointmentDate', array('label' => 'First date','class'=>'datepicker', 'id'=>'dpd8', 'default' => $appdate));
            ?>
        </fieldset>
    </div>
    <div class="modal-footer">
        <?php echo $this->Form->end(__('Edit Date')); ?>
    </div>
</div>

<div class="modal hide" id="changeMainApplicant"><!-- note the use of "hide" class -->
    <div class="modal-header">
        <button class="close" data-dismiss="modal">×</button>
        <h3>Change the main applicant</h3>
    </div>
    <div class="modal-body">
        This will change the main applicant associated with a case. Only an applicant with an email address is eligible. <br>
        Note: This will NOT change the email that the client uses to login.
        <?php echo $this->Form->create('Clientcase', array('action' => 'changeMainApplicant'));?>
        <fieldset>
            <?php
            echo $this->Form->hidden('id', array('default' => $id));
            echo $this->Form->input('applicant_id', array('options'=>array($applicantslist), 'label'=>'Applicant'));
            ?>
        </fieldset>
    </div>
    <div class="modal-footer">
        <?php echo $this->Form->end(__('Submit')); ?>
    </div>
</div>
