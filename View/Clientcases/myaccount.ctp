<div class="clientcases view">
    <h2><?php echo __('Account information'); ?></h2>
<?php /*
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
 */?>
<br>
	<dl>
    <dt><?php echo __('Archive Name'); ?></dt>
		<dd>
			<?php echo h($clientcase['Archive']['archive_name']); ?>
			&nbsp;
		</dd>
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
        </dd>
		<dt><?php echo __('Phone Number'); ?></dt>
		<dd>
			<?php echo h($clientcase['Applicant']['landline_number']); ?>
			&nbsp;
		</dd>
        <dt><?php echo __('Mobile Number'); ?></dt>
		<dd>
			<?php echo h($clientcase['Applicant']['mobile_number']); ?>
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
