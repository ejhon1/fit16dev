<div class="clientcases view">
    <h2><?php echo __('Account information'); ?></h2>
    <br>
    <div class="actions">
        <ul>
            <li><?php echo $this->Html->link(__('Change Password'), array('controller' => '/','action' => 'changePassword')); ?> </li>
        </ul>
    </div>
<br><br>
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
                    </tr>
                    <tr>
                        <td><?php echo $mainapplicant['Applicant']['birthdate']; ?></td>
                        <td><?php echo $mainapplicant['Applicant']['email']; ?></td>
                        <td><?php echo $mainapplicant['Applicant']['landline_number']; ?></td>
                        <td><?php echo $mainapplicant['Applicant']['mobile_number']; ?></td>
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

