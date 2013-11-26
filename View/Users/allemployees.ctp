<?php
/*
	This file is part of UserMgmt.

	Author: Chetan Varshney (http://ektasoftwares.com)

	UserMgmt is free software: you can redistribute it and/or modify
	it under the terms of the GNU General Public License as published by
	the Free Software Foundation, either version 3 of the License, or
	(at your option) any later version.

	UserMgmt is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.

	You should have received a copy of the GNU General Public License
	along with Foobar.  If not, see <http://www.gnu.org/licenses/>.
*/
?>
<div class="umtop">
	<?php echo $this->Session->flash(); ?>
	<?php echo $this->element('dashboard'); ?>
	<div class="um_box_up"></div>
	<div class="um_box_mid">
		<div class="um_box_mid_content">
			<div class="um_box_mid_content_top">
				<span class="umstyle1"><?php echo __('All Staff Members'); ?></span>
				<div style="clear:both"></div>
			</div>
			<div class="umhr"></div>
			<div class="um_box_mid_content_mid" id="index">
				<table cellspacing="0" cellpadding="0" width="100%" border="0" >
					<thead>
						<tr>
							<th><?php echo __('Name');?></th>
							<th><?php echo __('Username');?></th>
							<th><?php echo __('Email');?></th>
							<th><?php echo __('Group');?></th>
							<th><?php echo __('Status');?></th>
							<th><?php echo __('Created');?></th>
							<th><?php echo __('Actions');?></th>
						</tr>
					</thead>
					<tbody>
			<?php       if (!empty($users)) {
							$sl=0;
							foreach ($users as $row) {
								$sl++;
								echo "<tr>";
								echo "<td>".h($row['Employee']['first_name'])." ".h($row['Employee']['surname'])."</td>";
								echo "<td>".h($row['User']['username'])."</td>";
								echo "<td>".h($row['Employee']['email'])."</td>";
								echo "<td>".h($row['UserGroup']['name'])."</td>";
								echo "<td>";
								if ($row['User']['active']==1) {
									echo "Active";
								} else {
									echo "Inactive";
								}
								echo"</td>";
								echo "<td>".date('d-M-Y',strtotime($row['User']['created']))."</td>";
								echo "<td>";
									echo "<span class='icon'><a href='".$this->Html->url('/viewUser/'.$row['User']['id'])."'><img src='".SITE_URL."usermgmt/img/view.png' border='0' alt='View' title='View'></a></span>";
									echo "<span class='icon'><a href='".$this->Html->url('/editUser/'.$row['User']['id'])."'><img src='".SITE_URL."usermgmt/img/edit.png' border='0' alt='Edit' title='Edit'></a></span>";
									echo "<span class='icon'><a href='".$this->Html->url('/changeUserPassword/'.$row['User']['id'])."'><img src='".SITE_URL."usermgmt/img/password.png' border='0' alt='Change Password' title='Change Password'></a></span>";
									if ($row['User']['active']==0) {
										echo "<span class='icon'><a href='".$this->Html->url('/usermgmt/users/makeActiveInactive/'.$row['User']['id'].'/1')."'><img src='".SITE_URL."usermgmt/img/dis-approve.png' border='0' alt='Make Active' title='Make Active'></a></span>";
									} else {
										echo "<span class='icon'><a href='".$this->Html->url('/usermgmt/users/makeActiveInactive/'.$row['User']['id'].'/0')."'><img src='".SITE_URL."usermgmt/img/approve.png' border='0' alt='Make Inactive' title='Make Inactive'></a></span>";
									}
									if ($row['User']['id']!=1 && $row['User']['username']!='Admin') {
										echo $this->Form->postLink($this->Html->image(SITE_URL.'usermgmt/img/delete.png', array("alt" => __('Delete'), "title" => __('Delete'))), array('action' => 'deleteUser', $row['User']['id']), array('escape' => false, 'confirm' => __('Are you sure you want to delete '.$row['Employee']['first_name'].' '.$row['Employee']['surname'].'?')));
									}
								echo "</td>";
								echo "</tr>";
							}
						} else {
							echo "<tr><td colspan=10><br/><br/>No Data</td></tr>";
						} ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<div class="um_box_down"></div>
</div>