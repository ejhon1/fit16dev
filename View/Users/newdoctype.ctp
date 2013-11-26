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
				<span class="umstyle1"><?php echo __('Add new document type'); ?></span>
				<div style="clear:both"></div>
			</div>
			<div class="umhr"></div>
            <p>
            <div class="astreq">Fields marked with <font color='red'>*</font> are required.</div>
            </p>
			<div class="um_box_mid_content_mid" id="register">
				<div class="um_box_mid_content_mid_left">
					<?php echo $this->Form->create('User', array('action' => 'newdoctype')); ?>
						<div>
							<div class="umstyle3"><?php echo __('Document Category');?><font color='red'>*</font></div>
							<div class="umstyle4" ><?php echo $this->Form->input("Documenttype.category" ,array('type' => 'select', 'options' => array('Ancestor' => 'Ancestor', 'Applicant' => 'Applicant', 'Both' => 'Both'), 'label' => false,'div' => false,'class'=>"umstyle5" ))?></div>
							<div style="clear:both"></div>
						</div>
					<div>
						<div class="umstyle3"><?php echo __('Document Type');?><font color='red'>*</font></div>
						<div class="umstyle4" ><?php echo $this->Form->input("Documenttype.type" ,array('label' => false,'div' => false,'class'=>"umstyle5" ))?></div>
                        <div style="clear:both"></div>
					</div>
					<div>
						<div class="umstyle3"><?php echo __('Code');?><font color='red'>*</font></div>
						<div class="umstyle4" ><?php echo $this->Form->input("Documenttype.code" ,array('label' => false,'div' => false,'class'=>"umstyle5" ))?></div>
						<div style="clear:both"></div>
					</div>
					<div>
						<div class="umstyle3"></div>
						<div class="umstyle4"><?php echo $this->Form->Submit(__('Add Document Type'));?></div>
						<div style="clear:both"></div>
					</div>
					<?php echo $this->Form->end(); ?>
				</div>
				<div class="um_box_mid_content_mid_right" align="right"></div>
				<div style="clear:both"></div>
			</div>
		</div>
	</div>
	<div class="um_box_down"></div>
</div>
<script>
document.getElementById("UserUserGroupId").focus();
</script>
