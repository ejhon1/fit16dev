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
<div id="carousel-example-generic" class="carousel slide">
	<!-- indicators -->
	<ol class="carousel-indicators">
		<li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
		<li data-target="#carousel-example-generic" data-slide-to="1"></li>
		<li data-target="#carousel-example-generic" data-slide-to="2"></li>
	</ol>
	
	<!-- Wrapper for slides-->
	<div class="carousel-inner">
		<div class="item" align="center">
			<?php echo $this->Html->image('websitebanner.png', array(
				'alt' => 'Website Banner',
				
			));?>
			
		</div>
		<div class="item" align="center">
			<?php echo $this->Html->image('TESTPIC1.png', array(
				'alt' => 'Kraków',
			));?>
			
		</div>
		<div class="item active" align="center">
			<?php echo $this->Html->image('TESTPIC2.png', array(
				'alt' => 'Polska',
			));?>
			
		</div>
		<div class="item" align="center">
			<?php echo $this->Html->image('TESTPIC3.png', array(
				'alt' => 'Passport',
			));?>
			
		</div>
		<div class="item" align="center">
			<?php echo $this->Html->image('TESTPIC4.png', array(
				'alt' => 'Warszava',
			));?>
			
		</div>
		<div class="item" align="center">
			<?php echo $this->Html->image('TESTPIC5.png', array(
				'alt' => 'Warszava Map',
			));?>
			
		</div>
		<div class="item" align="center">
			<?php echo $this->Html->image('TESTPIC6.png', array(
				'alt' => 'Books',
			));?>
			
		</div>
	</div>	

<div class="umtop">
	<?php echo $this->Session->flash(); ?>
	<div class="um_box_up"></div>
	<div class="um_box_mid">
		<div class="um_box_mid_content">
			<div class="um_box_mid_content_top">
				<span class="umstyle1"><?php echo __('Sign In or'); ?></span>
				<span  class="umstyle2"><?php echo $this->Html->link(__("Sign Up",true),"/register") ?></span>
				<span class="umstyle2" style="float:right"><?php echo $this->Html->link(__("Home",true),"/") ?></span>
				<div style="clear:both"></div>
			</div>
			<div class="umhr"></div>
			<div class="um_box_mid_content_mid" id="login">
				<div class="um_box_mid_content_mid_left">
					<?php echo $this->Form->create('User', array('action' => 'login')); ?>
					<div>
						<div class="umstyle3"><?php echo __('Email / Username');?></div>
						<div class="umstyle4" ><?php echo $this->Form->input("username" ,array('label' => false,'div' => false,'class'=>"umstyle5" ))?></div>
						<div style="clear:both"></div>
					</div>
					<div>
						<div class="umstyle3"><?php echo __('Password');?></div>
						<div class="umstyle4"><?php echo $this->Form->input("password" ,array("type"=>"password",'label' => false,'div' => false,'class'=>"umstyle5" ))?></div>
						<div style="clear:both"></div>
					</div>
					<div>
					<?php   if(!isset($this->request->data['User']['remember']))
								$this->request->data['User']['remember']=true;
					?>
						<div class="umstyle3"><?php echo __('Remember me');?></div>
						<div class="umstyle4"><?php echo $this->Form->input("remember" ,array("type"=>"checkbox",'label' => false))?></div>
						<div style="clear:both"></div>
					</div>
					<div>
						<div class="umstyle3"></div>
						<div class="umstyle4"><?php echo $this->Form->Submit(__('Sign In'));?></div>
						<div style="clear:both"></div>
					</div>
					<?php echo $this->Form->end(); ?>
					<div  align="left"><?php echo $this->Html->link(__("Forgot Password?",true),"/forgotPassword",array("class"=>"style30")) ?></div>
				</div>
				<div class="um_box_mid_content_mid_right" align="right">

				</div>
				<div style="clear:both"></div>
			</div>
		</div>
	</div>
	<div class="um_box_down"></div>
</div>
<script>
document.getElementById("UserEmail").focus();
</script>
