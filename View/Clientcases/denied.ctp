<?php
echo $this->Html->script('bootstrap-datepicker.js');
echo $this->HTML->css('datepicker');
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
    <li><a href="#tab2" data-toggle="tab">Eligibility Check</a></li>
</ul>
<div id="my-tab-content" class="tab-content">
    <div class="tab-pane active" id="tab1">
        <p>
        <h3>Case Information</h3>
        <p>
        <table>
            <tbody>
            <tr>
                <th>Date of enquiry</th>
                <td><?php echo h($this->Time->format('d-m-Y', $clientcase['Clientcase']['created'])); ?></td>
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

        <br><br><br>
        <h3><?php echo __('Applicants'); ?></h3>
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
                            <td><?php echo $mainapplicant['Applicant']['birthdate']; ?></td>
                            <td><?php echo $mainapplicant['Applicant']['email']; ?></td>
                            <td><?php echo $mainapplicant['Applicant']['landline_number']; ?></td>
                            <td><?php echo $mainapplicant['Applicant']['mobile_number']; ?></td>
                        </tr>
                    </table>
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
                            <td><?php echo $applicant['Applicant']['birthdate']; ?></td>
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
    <div class="tab-pane" id="tab2">
        <p>
        <h3>Eligibility Check Information</h3>
        <p>
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
</div>
</div>
