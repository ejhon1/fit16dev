<?php echo $this->Html->script('bootstrap-datepicker.js');
echo $this->HTML->css('datepicker'); ?>
<?php echo $this->Html->script('jquery.smartWizard-2.0.min'); ?>
<?php echo $this->Html->script('jquery.smartWizard-2.0'); ?>
<?php echo $this->Html->script('show-hide-checkbox'); ?>
<?php echo $this->Html->css('smart_wizard'); ?>

<div class="users form">
<?php echo $this->Form->create('User');
//$td = date("d-m-Y");
$test = "<font color='red'>*</font>";
?>
<script>
    $(document).ready(function() {
        $('.datepicker').datepicker({
            autoclose: true
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function(){
// Smart Wizard
        $('#wizard').smartWizard({transitionEffect:'fade',onLeaveStep:leaveAStepCallback,onFinish:onFinishCallback});

        function leaveAStepCallback(obj){
            var step_num= obj.attr('rel');
            return validateSteps(step_num);
        }
        function onFinishCallback(){
            if(validateAllSteps()){
                $('form').submit();
            }
        }
    });

    function validateAllSteps(){
        var isStepValid = true;

        if(validateStep1() == false){
            isStepValid = false;
            $('#wizard').smartWizard('setError',{stepnum:1,iserror:true});
        }else{
            $('#wizard').smartWizard('setError',{stepnum:1,iserror:false});
        }
        if(validateStep2() == false){
            isStepValid = false;
            $('#wizard').smartWizard('setError',{stepnum:2,iserror:true});
        }else{
            $('#wizard').smartWizard('setError',{stepnum:2,iserror:false});
        }
        return isStepValid;
    }
    function validateSteps(step){
        var isStepValid = true;
// validate step 1
        if(step == 1){
            if(validateStep1() == false ){
                isStepValid = false;
// $('#wizard').smartWizard('showMessage','Please correct the errors in step'+step+ ' and click next.');
                $('#wizard').smartWizard('setError',{stepnum:step,iserror:true});
            }else{
                $('#wizard').smartWizard('setError',{stepnum:step,iserror:false});
            }
        }
        if(step == 2){
            if(validateStep2() == false ){
                isStepValid = false;
// $('#wizard').smartWizard('showMessage','Please correct the errors in step'+step+ ' and click next.');
                $('#wizard').smartWizard('setError',{stepnum:step,iserror:true});
            }else{
                $('#wizard').smartWizard('setError',{stepnum:step,iserror:false});
            }
        }
        return isStepValid;
    }
    function validateStep1(){
        var isValid = true;
// Validate First Name
        var firstname = $('#firstname').val();
        if(firstname && firstname.length > 0){
            if(!validateFirstName(firstname)){
                isValid = false;
                $('#msg_firstname').html('Firstname can only contain letters').show();
            }else{
                $('#msg_firstname').html('').hide();
            }
        }else{
            isValid = false;
            $('#msg_firstname').html('Please enter firstname').show();
        }

// validate surname
        var surname = $('#surname').val();
        if(surname && surname.length > 0){
            if(!validateSurname(surname)){
                isValid = false;
                $('#msg_surname').html('Surname can only contain letters').show();
            }else{
                $('#msg_surname').html('').hide();
            }
        }else{
            isValid = false;
            $('#msg_surname').html('Please enter surname').show();
        }
// validate phone number
        var phone = $('#phone').val();
        if(phone && phone.length > 0){
            if(!validatePhone(phone)){
                isValid = false;
                $('#msg_phone').html('Phone is invalid. Try again!').show();
            }else{
                $('#msg_phone').html('').hide();
            }
        }else{
            isValid = false;
            $('#msg_phone').html('Please enter phone number').show();
        }
//validate email
        var email = $('#email').val();
        if(email && email.length > 0){
            if(!isValidEmailAddress(email)){
                isValid = false;
                $('#msg_email').html('Email is invalid').show();
            }else{
                $('#msg_email').html('').hide();
            }
        }else{
            isValid = false;
            $('#msg_email').html('Please enter email address').show();
        }
        return isValid;
    }
    function validateStep2()
    {
        var isValid = true;
        var born_in_poland = $("input[@name='born_in_poland']:checked").val();
        if(!born_in_poland){
            isValid = false;
            $('#msg_bip').html('Please select an option').show();
        }else{
			isValid = true;
            $('#msg_bip').html('').hide();
        }
        return isValid;
    }
    function validateFirstName(firstname) {
        var pattern = new RegExp("^([a-zA-Z '-]+)$");
        return pattern.test(firstname);
    }
    function validateSurname(surname) {
        var pattern = new RegExp("^([a-zA-Z '-]+)$");
        return pattern.test(surname);
    }
    function validatePhone(phone)
    {
        var pattern = new RegExp("^([a-zA-Z,#/ \.\(\)\-\+\*]*[0-9]){7}[0-9a-zA-Z,#/ \.\(\)\-\+\*]*$");
        return pattern.test(phone);
    }
    function isValidEmailAddress(emailAddress) {
        var pattern = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
        return pattern.test(emailAddress);
    }
</script>
<script>
    $(function() {
        $( "#datepicker" ).datepicker({
            changeMonth: true,
            changeYear: true,
            yearRange: "-100:+0",
            showAnim: 'slideDown',
            dateFormat: "dd-mm-yy"
        });

    });
</script>
<script type="text/javascript">
    $(document).ready(function(){ 
 
        $(window).scroll(function(){
            if ($(this).scrollTop() > 100) {
                $('.buttonNext').fadeIn();
            } else {
                $('.buttonNext').fadeOut();
            }
        }); 
 
        $('.buttonNext').click(function(){
            $("html, body").animate({ scrollTop: 0 }, 600);
            return false;
        });
 
    });
</script>
<script type="text/javascript">
    $(document).ready(function(){ 
 
        $(window).scroll(function(){
            if ($(this).scrollTop() > 100) {
                $('.buttonPrevious').fadeIn();
            } else {
                $('.buttonPrevious').fadeOut();
            }
        }); 
 
        $('.buttonPrevious').click(function(){
            $("html, body").animate({ scrollTop: 0 }, 600);
            return false;
        });
 
    });
</script>
<script>
$(document).ready(function(){
    	$("input[value='No']").change(function(){
        var checked = $(this).attr('checked');
        	if (checked) {
           		$('#warning').show();             
        	} else {
            	$('#warning').hide();
        	}
    	});        
		});
</script>

<fieldset>
<legend><?php echo __('Eligibility Assessment'); ?></legend>
<div id="wizard" class="swMain">
<ul>
    <li><a href="#step-1">
            <label class="stepNumber">1</label>
<span class="stepDesc">
Step 1<br />
<small>Applicant Details</small>
</span>
        </a></li>
    <li><a href="#step-2">
            <label class="stepNumber">2</label>
<span class="stepDesc">
Step 2<br />
<small>Polishness</small>
</span>
        </a></li>
    <li><a href="#step-3">
            <label class="stepNumber">3</label>
<span class="stepDesc">
Step 3<br />
<small>Family History</small>
</span>
        </a></li>
    <li><a href="#step-4">
            <label class="stepNumber">4</label>
<span class="stepDesc">
Step 4<br />
<small>Documents</small>
</span>
        </a></li>
</ul>
<div id="step-1">
    <h2 class="StepTitle">Applicant Details</h2>
    <h4><i>Fields marked with an asterisk (*) are required. </i></h4>
    <br />
    <?php
    echo $this->Form->input('Applicant.title', array(
        'options' => array(
            '' => '',
            'Mr' => 'Mr',
            'Mrs' => 'Mrs',
            'Ms' => 'Ms',
            'Miss' => 'Miss')
    ));
    ?>
    <td align="left"><span id="msg_firstname"></span>&nbsp;</td>
    <?php
        echo $this->Form->input('Applicant.first_name', array(
            'id' => 'firstname')
        );
    ?>
    <td align="left"><span id="msg_surname"></span>&nbsp;</td>
    <?php
        echo $this->Form->input('Applicant.surname', array(
            'id' => 'surname')
        );
    ?>
    <?php
        echo $this->Form->input('Applicant.birthdate', array('label' => 'Date of birth',
            'id' => 'datepicker',
            'type'=>'text',
            'class'=>'datepicker'));
	?>
    <td align="left"><span id="msg_phone"></span>&nbsp;</td>
    <?php
        echo $this->Form->input('Applicant.landline_number', array(
            'id' => 'phone',
            'label' => 'Phone Number'.$test)
        );
    ?>
    <td align="left"><span id="msg_email"></span>&nbsp;</td>
    <?php
        echo $this->Form->input('Applicant.email', array(
            'id' => 'email',
            'label' => 'E-mail Address'.$test)
        );
        echo $this->Form->input('Clientcase.existing_family', array(
		'label' => 'If any, please specify other family members who have already registered for Polaron\'s services'));
    ?>
</div>

<div id="step-2">
    <h2 class="StepTitle">Polishness</h2>
    <?php
    ?>
    <br />
    <td align="left"><span id="msg_bip"></span>&nbsp;</td>
	<table>
    	<tr>
    		<td>
				<?php
                echo $this->Form->input('ClientCase.born_in_poland', array(
                    'id' => 'bip',
                    'class' => 'bip',
                    'type' => 'radio',
                    'options' => array(
                        'Yes' => 'Yes',
                        'No' => 'No'),
                    'legend' => 'I was born in Poland'));
                ?>
    		</td>
    		<td>
				<?php
                echo $this->Form->input('ClientCase.spouse_nationality', array(
                    'id' => 'spouse',
                    'type' => 'radio',
                    'options' => array(
                        'Yes' => 'Yes',
                        'No' => 'No'),
                    'legend' => 'My Spouse is Polish'));
                ?>
    		</td>
            <td>
            	<div id="warning" style="display:none">Please be aware that your spouse does not qualify for a Polish passport, , unless she or he has ancestors who are Polish, in which case, your spouse would be required to complete a separate application for confirmation of Polish citizenship. However, as the spouse of a Polish citizen, they have the right to live and work in Europe, and all other associated benefits. </div>
            </td>
    	</tr>
    </table>
    
    <?php
    echo $this->Form->input('ClientCase.nationality_of_parents', array(
        'type' => 'select',
        'multiple' => 'checkbox',
        'options' => array(
            'Mother' => 'My mother is/was Polish',
            'Father' => 'My father is/was Polish'),
        'label' => 'Parents\' Nationality'));

    echo $this->Form->input('ClientCase.mother_name', array(
        'div' => array(
            'id' => 'mother',
            'title' => 'mother',
            'style' => 'display:none'),
        'label' => 'Mother\'s name'));
    echo $this->Form->input('ClientCase.father_name', array(
        'div' => array(
            'id' => 'father',
            'title' => 'father',
            'style' => 'display:none'),
        'label' => 'Father\'s name'));

    echo $this->Form->input('ClientCase.nationality_of_grandparents', array(
        'type' => 'select',
        'multiple' => 'checkbox',
        'options' => array(
            'Maternal Grandmother' => 'My maternal grandmother is/was Polish',
            'Maternal Grandfather' => 'My maternal grandfather is/was Polish',
            'Paternal Grandmother' => 'My paternal grandmother is/was Polish',
            'Paternal Grandfather' => 'My paternal grandfather is/was Polish'),
        'label' => 'Grandparents\' Nationality'));

    echo $this->Form->input('ClientCase.mat_grandmother_name', array(
        'div' => array(
            'id' => 'mat_grandmother',
            'title' => 'mat_grandmother',
            'style' => 'display:none'),
        'label' => 'Maternal grandmother\'s name'));
    echo $this->Form->input('ClientCase.mat_grandfather_name', array(
        'div' => array(
            'id' => 'mat_grandfather',
            'title' => 'mat_grandfather',
            'style' => 'display:none'),
        'label' => 'Maternal grandfather\'s name'));
    echo $this->Form->input('ClientCase.pat_grandmother_name', array(
        'div' => array(
            'id' => 'pat_grandmother',
            'title' => 'pat_grandmother',
            'style' => 'display:none'),
        'label' => 'Paternal grandmother\'s name'));
    echo $this->Form->input('ClientCase.pat_grandfather_name', array(
        'div' => array(
            'id' => 'pat_grandfather',
            'title' => 'pat_grandfather',
            'style' => 'display:none'),
        'label' => 'Paternal grandfather\'s name'));

    echo $this->Form->input('ClientCase.nationality_of_others', array(
        'label' => 'Please specify any other family members of Polish decent here'));

    ?>
    <!-- <button type="button" id="btn1" onclick="panels('panel1');return false;">Next</button> -->
</div>

<div id="step-3">
    <h2 class="StepTitle">Family History</h2>
    <?php
    echo $this->Form->input('ClientCase.brief_history', array(
        'label'=> 'Please write a brief history of your family here'));
    echo $this->Form->input('ClientCase.serve_in_army', array(
        'type' => 'radio',
        'options' => array(
            'Yes' => 'Yes',
            'No' => 'No',
            'Not Sure' => 'Not Sure'),
        'legend' => 'Did any of your ancestors serve in the Polish army?'));
    echo $this->Form->input('ClientCase.serve_in_army_info', array(
        'label' => 'Please put any known information of this here'));
    echo $this->Form->input('ClientCase.when_left_poland', array(
        'type' => 'select',
        'multiple' => 'checkbox',
        'options' => array(
            'Never left' => 'They never left Poland',
            'Before WW1 (before 1918)' => 'They left Poland before WW1 (before 1918)',
            'Before WW2 (before 1939)' => 'They left Poland before WW2 (before 1939)',
            'During WW2 (1939-1945)' => 'They left Poland during WW2 (1939-1945)',
            'After WW2 (after 1945)' => 'They left Poland after WW2 (after 1945)'),
        'label' => 'When did your ancestors leave Poland?'));
    echo $this->Form->input('ClientCase.where_left_poland', array(
        'type' => 'select',
        'multiple' => 'checkbox',
        'options' => array(
            'Australia' => 'Australia',
            'Germany' => 'Germany',
            'France' => 'France',
            'Austria' => 'Austria',
            'Italy' => 'Italy',
            'Middle East' => 'Middle East',
            'New Zealand' => 'New Zealand',
            'USA' => 'USA',
            'UK' => 'UK',
            'Israel' => 'Israel'),
        'label' => 'Where did your ancestors go after leaving Poland? (please select all that apply)'));
    echo $this->Form->input('ClientCase.where_left_poland_other', array(
        'label' => ' If other, please specify'));

    //echo $this->Form->input('enquiry_date', array('default' => $td));
    //echo $this->Form->input('Applicant.first_name');
    //echo $this->Form->input('Applicant.middle_name');
    //echo $this->Form->input('0.Applicant.surname');
    ?>
    <!-- <button type="button" id="btn2" onclick="panels('panel2');return false;">Previous</button> -->
</div>
<div id="step-4">
    <h2 class="StepTitle">Documents</h2>
    <?php
    echo $this->Form->input('ClientCase.have_passport', array(
        'type' => 'radio',
        'options' => array(
            'Yes' => 'Yes',
            'No' => 'No'),
        'legend' => 'I have/had a Polish passport and wish to renew it'));
    echo $this->Form->input('ClientCase.possess_documents', array(
        'type' => 'radio',
        'options' => array(
            'Yes' => 'Yes',
            'No' => 'No',
            'Not sure' => 'Not Sure'),
        'legend' => 'Do you have any Polish documents from your relatives/ancestors?'));
    echo $this->Form->input('ClientCase.possess_documents_types', array(
        'type' => 'select',
        'multiple' => 'checkbox',
        'options' => array(
            'Polish passport(s)' => 'Polish passport(s)',
            'Birth certificate(s)' => 'Birth certificate(s)',
            'Marriage certificate(s)' => 'Marriage certificate(s)',
            'Baptism certificate(s)' => 'Baptism certificate(s)',
            'Army records' => 'Army records',
            'School records' => 'School records',
            'Naturalisation Certificates' => 'Naturalisation Certificates',
            'International Refugee Organisation Certificate(s)' => 'International Refugee Organisation Certificate(s)',
            'Immigration Documents' => 'Immigration Documents',
            'Change of name Certificate(s)' => 'Change of name Certificate(s)',
            'Not sure what they are' => 'Not sure what they are'),
        'label' => 'If yes, please select the following Polish documents you possess (select all that apply)'));
    echo $this->Form->input('ClientCase.possess_documents_other', array(
        'label' => 'If other, please specify'));
    echo $this->Form->input('ClientCase.other_factors', array(
        'type' => 'select',
        'multiple' => 'checkbox',
        'options' => array(
            'My family comes from an area that is no longer in Poland' => 'My family comes from an area that is no longer in Poland',
            'One of my ancestors served in a foreign army' => 'One of my ancestors served in a foreign army',
            'One of my ancestors held public office outside of Poland' => 'One of my ancestors held public office outside of Poland',
            'None of the above' => 'None of the above'),'label' => 'Please select all that apply '));
    ?>
</div>
</div>
</fieldset>
</div>
