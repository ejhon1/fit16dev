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
				<span class="umstyle1"><?php echo __('Edit Group'); ?></span>
				<div style="clear:both"></div>
			</div>
			<div class="umhr"></div>
            <p>
            <div class="astreq">Fields marked with <font color='red'>*</font> are required.</div>
            </p>
			<div class="um_box_mid_content_mid" id="addgroup">
				<?php echo $this->Form->create('UserGroup'); ?>
				<?php echo $this->Form->hidden('id')?>
				<div>
					<div class="umstyle3"><?php echo __('Group Name');?><font color='red'>*</font></div>
					<div class="umstyle4" ><?php echo $this->Form->input("name" ,array('label' => false,'div' => false,'class'=>"umstyle5" ))?></div>
					<div class="umstyle7">E.g. Business User</div>
					<div style="clear:both"></div>
				</div>
				<div>
					<div class="umstyle3"><?php echo __('Alias Group Name');?><font color='red'>*</font></div>
					<div class="umstyle4" ><?php echo $this->Form->input("alias_name" ,array('label' => false,'div' => false,'class'=>"umstyle5" ))?></div>
					<div class="umstyle7">E.g. Business_User (Must not contain spaces) (Recommended that you do not change this)</div>
					<div style="clear:both"></div>
				</div>
                <?php /*
				<div>
					<div class="umstyle3"><?php echo __('Allow Registration');?></div>
					<div class="umstyle4"><?php echo $this->Form->input("allowRegistration" ,array("type"=>"checkbox",'label' => false))?></div>
					<div style="clear:both"></div>
				</div>
                   */ ?>
				<div>
					<div class="umstyle3"></div>
					<div class="umstyle4"><?php echo $this->Form->Submit(__('Update Group'));?></div>
					<div style="clear:both"></div>
				</div>
				<?php echo $this->Form->end(); ?>
			</div>
		</div>
	</div>
	<div class="um_box_down"></div>
</div>
<script>
document.getElementById("UserUserGroupId").focus();
</script>