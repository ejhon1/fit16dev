<?php
  echo $this->HTML->script('JQueryUser');
?>
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

    /*$(document).ready(function() {
        if (location.hash !== '') $('a[href="' + location.hash + '"]').tab('show');
        return $('a[data-toggle="tab"]').on('shown', function(e) {
            return location.hash = $(e.target).attr('href').substr(1);
        });

    });

    $(document).ready(function()  {
        $('a[data-toggle="tab"]').on('shown', function(e) {
            location.hash = $(e.target).attr('href').substr(1);
            $(this).focus();
            return false; // or true - whichever you prefer
        });
    });
    ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    */





    /*$(function() {
        $( "#accordion" ).accordion({
            active: false,
            collapsible: true,
            heightStyle: "content"

        });
        $('.nav nav-tabs').on('click', false);
    });


    $(function () {
	$("#accordion").accordion(
	{
		collapsible:true,
		active:false
	});
		var icons = $( "#accordion" ).accordion( "option", "icons" );
		$('.expand').click(function ()
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
				$('.expand').removeAttr("disabled");
			});
			$('.ui-accordion-header').click(function () 
			{
				$('.expand').removeAttr("disabled");
				$('.close').removeAttr("disabled");
        
			});
		});

    $(window).load(function() {
        $(".acc-wizard").accwizard();
    });
     */
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
    <li><a href="#tab4" data-toggle="tab">Case Notes</a></li>
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
                <td><?php echo h($clientcase['Clientcase']['open_or_closed']); ?></td>
                <th>Date of enquiry</th>
                <td><?php echo h($this->Time->format('d-m-Y', $clientcase['Clientcase']['created'])); ?></td>
            </tr>
            <tr>
                <th>Appointment date</th>
                <td>
                    <?php if($clientcase['Clientcase']['appointment_date'] != NULL)
                    {
                        echo h($this->Time->format('d-m-Y h:i', $clientcase['Clientcase']['appointment_date']));
                    }
                    else
                    {
                            echo __('Add');
                    }
                    ?>
                </td>
                <th></th>
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
                        <td>???</td>
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

        <br><br>
        <h3><?php echo __('Applicants'); ?></h3>
        <div class="actions">
            <ul>
                <li><?php echo $this->Html->link(__('Add Applicant'), array('controller' => 'applicants', 'action' => 'add', $clientcase['Clientcase']['id'])); ?> </li>
            </ul>
        </div>
        <?php if (!empty($applicants)): ?>
            <table cellpadding = "0" cellspacing = "0">
                <tr>
                    <th><?php echo __('Name'); ?></th>
                    <th><?php echo __('Email'); ?></th>
                    <th><?php echo __('Phone Number'); ?></th>
                    <th><?php echo __('Type'); ?></th>
                </tr>
                <?php foreach ($applicants as $applicant): ?>
                    <tr>
                        <td><?php echo h($applicant['Applicant']['title'].' '.$applicant['Applicant']['first_name'].' '.$applicant['Applicant']['surname']); ?></td>
                        <td><?php echo $applicant['Applicant']['email']; ?></td>
                        <td><?php echo $applicant['Applicant']['landline_number']; ?></td>
                        <td><?php echo $applicant['Applicant']['applicant_type']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php endif; ?>





    </div>
    <?php if($clientcase['Clientcase']['born_in_poland'] != NULL)
    {
        ?>
        <div class="tab-pane" id="tab2">
            <p>
            <h3>Eligibility Check Information</h3>
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
                <dt><?php echo __('Maternal Grandmother Name'); ?></dt>
                <dd>
                    <?php echo h($clientcase['Clientcase']['mat_grandmother_name']); ?>
                    &nbsp;
                </dd>
                <dt><?php echo __('Maternal Grandfather Name'); ?></dt>
                <dd>
                    <?php echo h($clientcase['Clientcase']['mat_grandfather_name']); ?>
                    &nbsp;
                </dd>
                <dt><?php echo __('Paternal Grandmother Name'); ?></dt>
                <dd>
                    <?php echo h($clientcase['Clientcase']['pat_grandmother_name']); ?>
                    &nbsp;
                </dd>
                <dt><?php echo __('Paternal Grandfather Name'); ?></dt>
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
                <dt><?php echo __('Serve In Army Information'); ?></dt>
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
                <dt><?php echo __('Passport'); ?></dt>
                <dd>
                    <?php echo h($clientcase['Clientcase']['have_passport']); ?>
                    &nbsp;
                </dd>
                <dt><?php echo __('Documents'); ?></dt>
                <dd>
                    <?php echo h($clientcase['Clientcase']['possess_documents']); ?>
                    &nbsp;
                </dd>
                <dt><?php echo __('Documents Types'); ?></dt>
                <dd>
                    <?php echo h($clientcase['Clientcase']['possess_documents_types']); ?>
                    &nbsp;
                </dd>
                <dt><?php echo __('Other Documents'); ?></dt>
                <dd>
                    <?php echo h($clientcase['Clientcase']['possess_documents_other']); ?>
                    &nbsp;
                </dd>
                <dt><?php echo __('Other Factors'); ?></dt>
                <dd>
                    <?php echo h($clientcase['Clientcase']['other_factors']); ?>
                    &nbsp;
                </dd>
                <dt><?php echo __('Date Registered'); ?></dt>
                <dd>
                    <?php echo $this->Time->format('d-m-Y',$clientcase['Clientcase']['created']); ?>
                    &nbsp;
                </dd>
            </dl>
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
                <td><?php echo $casestatus['Casestatus']['employee_id']; ?></td>
            </tr>
            <?php endforeach; ?>
            </table>
        <?php endif; ?>
    </div>


    <div class="tab-pane" id="tab4">
        <p>
        <h3><?php echo __('Related Casenotes'); ?></h3>
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
		                     <?php
		                      $note = substr($casenote['note'], 0, 50);
		                     echo $note.' ... ';
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

        <div class="actions">
            <ul>
                <li><?php echo $this->Html->link(__('New Casenote'), array('controller' => 'casenotes', 'action' => 'add', $clientcase['Clientcase']['id'])); ?> </li>
            </ul>
        </div>
    </div>
    <div class="tab-pane" id="tab5">
        <div class="panel-group" id="accordion">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a class="accordion-toggle" data-toggle="collapse" data-target="#collapseOne" href="#collapseOne">
                            Ancestor Documents
                        </a><a class="btn" data-toggle="modal" href="#myModal2">Upload</a>
                    </h4>
                </div>
                <div id="collapseOne" class="panel-collapse collapse in">
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
                                        <td valign="top"><?php echo h($this->Time->format('d-m-Y h:i',$ancestordocument['Document']['created'])); ?>&nbsp;</td>
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
                        </a><a class="btn" data-toggle="modal" href="#myModal3" >Upload</a>
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
                                            <?php echo h($applicantdocument['Applicant']['first_name'].' '.$applicantdocument['Applicant']['surname']); ?>
                                            </td>
                                            <td valign="top">
                                                <?php echo h($applicantdocument['Documenttype']['type']); ?>
                                            </td>
                                            <td valign="top"><?php echo h($applicantdocument['Document']['filename']); ?>&nbsp;</td>
                                            <td valign="top"><?php echo h($this->Time->format('d-m-Y h:i',$applicantdocument['Document']['created'])); ?>&nbsp;</td>
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
            echo $this->Form->input('applicant_id', array('options'=>$applicantslist, 'label'=>'Applicant'));
            echo $this->Form->input('documenttype_id', array('options'=>$documentTypes, 'label'=>'Type of document'));
            echo $this->Form->hidden('clientcase_id', array('default' => $id));
            ?>
        </fieldset>
    </div>
    <div class="modal-footer">
        <?php echo $this->Form->end(__('Upload File')); ?>
    </div>
</div>
