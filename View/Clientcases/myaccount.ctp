<div class="clientcases view">
    <h2><?php echo __('Your account information'); ?></h2>

    <div class="um_box_mid_content_mid" id="index">
        <table cellspacing="0" cellpadding="0" width="100%" border="0" >
            <tbody>
            <tr>
                <td id="infotype"><strong><?php echo __('Test1');?></strong></td>
                <td><?php echo h($clientcase['Applicant']['first_name'])?></td>
            </tr>
            <tr>
                <td id="infotype"><strong><?php echo __('Test1');?></strong></td>
                <td><?php echo h($clientcase['Applicant']['first_name'])?></td>
            </tr>
            </tbody>
            </table>
    </div>

	<dl>
		<dt><?php echo __('First Name'); ?></dt>
		<dd>
			<?php echo h($clientcase['Applicant']['first_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Surname'); ?></dt>
		<dd>
			<?php echo h($clientcase['Applicant']['surname']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo h($clientcase['Status']['status_type']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Email'); ?></dt>
		<dd>
			<?php echo h($clientcase['Applicant']['email']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
        <li><?php echo $this->Html->link(__('Change Password'), array('controller' => '/','action' => 'changePassword')); ?> </li>
    </ul>
</div>
