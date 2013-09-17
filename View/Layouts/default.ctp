<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

/**
 * $cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
 */
 
$cakeDescription = __d('cake_dev', 'Polaron: European Solutions');
$loggedUser = $this->Session->read('UserAuth.User');
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $cakeDescription ?>:
		<?php echo $title_for_layout; ?>
	</title>
	<div id="header">
        	<?php
				/** echo $this->Html->image('polaronLogo.png', array('alt'=> 'Polaron Logo', true)); */
				echo $this->Html->image('polaronLogo.png', array("alt" => "Home", 'url' => array ('controller' => 'Pages', 'action' => 'display', 'home')));
			?>
        </div>
	<?php
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');

		echo $this->Html->meta('icon');
		
		echo $this->Html->css('default');
		echo $this->Html->css('cake.generic');
        echo $this->Html->css('jQuery.dataTables');
        echo $this->Html->css('/usermgmt/css/umstyle');


		echo $this->Html->script('jquery');
		echo $this->Html->script('jquery.smartWizard-2.0.min');
		echo $this->Html->script('jquery.smartWizard-2.0');
		echo $this->Html->script('jquery.dataTables');

    //Not sure what these are for, but they break DataTables
        //echo $this->Html->script('jquery-1.5.min.js');
        //echo $this->Html->script('jquery-ui-1.10.3.custom.min.js');
        //echo $this->Html->css('jquery-ui-1.10.3.custom.min.css');

    echo $this->Html->script('jquery-ui-1.10.3.custom.js');
    echo $this->Html->css('jquery-ui-1.10.3.custom.css');

		
		?>
			
				<div id="navigation">
					<!-- <ul  class="nav nav-tabs"> -->
					<ul>
					<?php
					if(!empty($loggedUser) && $loggedUser['type']=='Employee')
					{
						?>
						<li><?php echo $this->Html->link('Home', '/'); ?> </li>
						<li><?php echo $this->Html->link('Cases', '/clientcases', array('controller'=>'ClientCases', 'action'=>'index'));?> </li>
                        <li><?php echo $this->Html->link('Archives', '/archives', array('controller'=>'archives', 'action'=>'index'));?> </li>
                        <li><?php echo $this->Html->link('Staff Dashboard', '/dashboard', array('controller'=>'employees', 'action'=>'index'));?> </li>
						<li><?php echo $this->Html->link('My Account', '/employees/myaccount', array('controller' => 'employees', 'action' => 'myaccount')); ?></li>
					<?php
					}
					else if(!empty($loggedUser) && $loggedUser['type']=='Client')
					{
					?>
                        <li><?php echo $this->Html->link('Case notes', '/casenotes', array('controller'=>'casenotes', 'action'=>'mynotes'));?> </li>
						<li><?php echo $this->Html->link('Documents', '/documents', array('controller'=>'documents', 'action'=>'mydocs'));?> </li>
						<li><?php echo $this->Html->link('Account', '/users', array('controller'=>'clientcases', 'action'=>'myaccount'));?> </li><?php
					}
					else
					{
					?>
						<li><?php echo $this->Html->link('Login', '/login'); ?> </li>
						<li><?php echo $this->Html->link('Register', '../users/newclient'); ?> </li>
					<?php
					}
					if(!empty($loggedUser))
					{
					?>
						<li><?php echo $this->Html->link(__("Sign Out",true),"/logout") ?> </li>
					<?php
					}
					?>
					</ul>
				</div> 
</head>
<body>
    
	<div id="container">
    	
        <!-- <div id="loginReg">
        	<ul>
            	
            </ul>
		</div> -->
        
    	
        
        <!-- <div id="navigation"> -->
            <!-- <ul  class="nav nav-tabs"> -->
            <!-- <ul>
                <li><?php /** echo $this->Html->link('Home', 'http://ie.infotech.monash.edu.au/team16/Development/'); ?> </li>
                <li><?php echo $this->Html->link('Documents', array('controller'=>'Documents', 'action'=>'index'));?> </li>
                <li><?php echo $this->Html->link('Users', array('controller'=>'Users', 'action'=>'index'));?> </li>
                <li><?php echo $this->Html->link('Login', 'http://ie.infotech.monash.edu.au/team16/Development/users/login'); ?> </li>
            	<li><?php echo $this->Html->link('Register', 'http://ie.infotech.monash.edu.au/team16/Development/users/signup'); */ ?> </li>
            </ul>
    	</div> -->
        
		<div id="content">

			<?php echo $this->Session->flash(); ?>

			<?php echo $this->fetch('content'); ?>
		</div>
        
        <div id="footer">
        	<p>Copyright &copy; 2013 <a href="http://ie.infotech.monash.edu.au/team16/Development/">Polaron</a>. All Rights Reserved<br/></p>
        </div>
	</div>
	<?php /** echo $this->element('sql_dump'); */ ?>
</body>
</html>
<script type="text/javascript">
$(document).ready(function(){
$("#datepicker_img img").click(function(){
$("#datepicker").datepicker(
{
dateFormat: 'yy-mm-dd',
onSelect: function(dateText, inst){
$('#select_date').val(dateText);
$("#datepicker").datepicker("destroy");
}
}
);
});
});
</script>
