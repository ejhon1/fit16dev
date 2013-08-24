<?php echo $this->Html->css('jquery-ui-1.10.3.custom'); ?>
<?php echo $this->Html->script('jquery-1.5.min'); ?>
<?php echo $this->Html->script('jquery-ui-1.10.3.custom.min'); ?>

<div class="users form">
<?php echo $this->Form->create('User');
//$td = date("d-m-Y");
?>
    <script type="text/javascript">
        function panels(id)
        {
            var e = document.getElementById(id);
            if(e == panel1)
            {
                if(e.style.display != 'none')
                {
                    e.style.display = 'none';
                    panel2.style.display = 'block';
                }
                else
                {
                    e.style.display = 'block';
                    panel2.style.display = 'none';
                }

            }
            else if(e == panel2)
            {
                if(e.style.display != 'none')
                {
                    e.style.display = 'none';
                    panel1.style.display = 'block';
                }
                else
                {
                    e.style.display = 'block';
                    panel1.style.display = 'none';
                }
            }
            scroll(0,0);
        }

        $(function() {
            $( "#datepicker" ).datepicker();
        });
    </script>
    <script>
        $(function() {
            $( "#datepicker" ).datepicker();
        });
    </script>

	<fieldset>
		<legend><?php echo __('Quickcheck Eligibility Form'); ?></legend>
        <br>
        Fields marked with an * are required.
        <br><br>
        <div id="panel1" class="panel1">
        <?php
        echo $this->Form->input('Applicant.title');
            ?>

            <p>Date: <input type="text" id="datepicker" /></p>

            <?php
        echo $this->Form->input('Applicant.first_name');
        echo $this->Form->input('Applicant.surname');
        echo $this->Form->input('Applicant.landline_number', array('label' => 'Phone Number'));
        echo $this->Form->input('Applicant.email', array('label' => 'E-mail Address'));
		echo $this->Form->input('username');
		echo $this->Form->input('password');
        echo $this->Form->input('password_confirm', array('label' => 'Confirm Password'));

        echo $this->Form->input('ClientCase.born_in_poland', array('type' => 'radio', 'options' => array('Yes' => 'Yes', 'No' => 'No'), 'legend' => 'I was born in Poland'));
        //echo $this->Form->input('ClientCase.nationality_of_parents', array('label' => 'Parents\' Nationality'));
        //echo $this->Form->input('par_nat_checkbox', array('type' => 'select','multiple' => 'checkbox',
        // 'options' => array('Mother' => 'My mother is/was Polish', 'Father' =>  'My father is/was Polish'), 'label' => 'Parents\' Nationality'));
        echo $this->Form->input('ClientCase.nationality_of_parents', array('type' => 'select', 'multiple' => 'checkbox','options' => array(
            'Mother' => 'My mother is/was Polish', 'Father' =>  'My father is/was Polish'), 'label' => 'Parents\' Nationality'));
        echo $this->Form->input('ClientCase.mother_name', array('label' => 'Mother\'s name','id' =>'test', 'display' => 'none'));
        echo $this->Form->input('ClientCase.father_name', array('label' => 'Father\'s name'));
        echo $this->Form->input('ClientCase.nationality_of_grandparents', array('type' => 'select', 'multiple' => 'checkbox','options' => array(
            'Maternal Grandmother' => 'My maternal grandmother is/was Polish', 'Maternal Grandfather' =>  'My maternal grandfather is/was Polish',
            'Paternal Grandmother' => 'My paternal grandmother is/was Polish', 'Paternal Grandfather' =>  'My paternal grandfather is/was Polish'), 'label' => 'Grandparents\' Nationality'));
        echo $this->Form->input('ClientCase.mat_grandmother_name', array('label' => 'Maternal grandmother\'s name'));
        echo $this->Form->input('ClientCase.mat_grandfather_name', array('label' => 'Maternal grandfather\'s name'));
        echo $this->Form->input('ClientCase.pat_grandmother_name', array('label' => 'Paternal grandmother\'s name'));
        echo $this->Form->input('ClientCase.pat_grandfather_name', array('label' => 'Paternal grandfather\'s name'));
        echo $this->Form->input('ClientCase.nationality_of_others', array('label' => 'Please specify any other family members of Polish decent here'));

            ?>
            <button type="button" id="btn1" onclick="panels('panel1');return false;">Next</button>
        </div>

        <div id="panel2" class="panel2">
            <?php
        echo $this->Form->input('ClientCase.serve_in_army', array('type' => 'radio', 'options' => array('Yes' => 'Yes', 'No' => 'No'), 'legend' => 'Did any of your ancestors serve in the Polish army?'));
        echo $this->Form->input('ClientCase.serve_in_army_info', array('label' => 'Please put any known information of this here'));
        echo $this->Form->input('ClientCase.when_left_poland', array('type' => 'select', 'multiple' => 'checkbox','options' => array(
            'Never left' => 'They never left Poland', 'Before WW1 (before 1918)' =>  'They left Poland before WW1 (before 1918)', 'Before WW2 (before 1939)' =>  'They left Poland before WW2 (before 1939)',
        'During WW2 (1939-1945)' =>  'They left Poland during WW2 (1939-1945)', 'After WW2 (after 1945)' =>  'They left Poland after WW2 (after 1945)'), 'label' => 'When did your ancestors leave Poland?'));
        echo $this->Form->input('ClientCase.where_left_poland', array('type' => 'select', 'multiple' => 'checkbox','options' => array(
            'Australia' => 'Australia', 'Germany' =>  'Germany', 'France' =>  'France', 'Austria' =>  'Austria', 'Italy' =>  'Italy', 'Middle East' =>  'Middle East', 'New Zealand' =>  'New Zealand',
            'USA' =>  'USA', 'UK' =>  'UK', 'Israel' =>  'Israel'), 'label' => 'Where did your ancestors go after leaving Poland? (please select all that apply)'));
        echo $this->Form->input('ClientCase.where_left_poland_other', array('label' => ' If other, please specify'));
        echo $this->Form->input('ClientCase.have_passport', array('type' => 'radio', 'options' => array('Yes' => 'Yes', 'No' => 'No'), 'legend' => 'I have/had a Polish passport and wish to renew it'));
        echo $this->Form->input('ClientCase.possess_documents', array('type' => 'radio', 'options' => array('Yes' => 'Yes', 'No' => 'No', 'Not sure' => 'Not Sure'), 'legend' => 'Do you have any Polish documents from your relatives/ancestors?'));
        echo $this->Form->input('ClientCase.possess_documents_types', array('type' => 'select', 'multiple' => 'checkbox','options' => array(
            'Polish passport(s)' => 'Polish passport(s)', 'Birth certificate(s)' =>  'Birth certificate(s)', 'Marriage certificate(s)' =>  'Marriage certificate(s)',
            'Baptism certificate(s)' =>  'Baptism certificate(s)', 'Army records' =>  'Army records', 'School records' =>  'School records', 'Naturalisation Certificates' =>  'Naturalisation Certificates',
            'International Refugee Organisation Certificate(s)' =>  'International Refugee Organisation Certificate(s)', 'Immigration Documents' =>  'Immigration Documents', 'Change of name Certificate(s)' =>  'Change of name Certificate(s)',
            'Not sure what they are' =>  'Not sure what they are'), 'label' => 'If yes, please select the following Polish documents you possess (select all that apply)'));
        echo $this->Form->input('ClientCase.possess_documents_other', array('label' => 'If other, please specify'));
        echo $this->Form->input('ClientCase.other_factors', array('type' => 'select', 'multiple' => 'checkbox','options' => array(
            'My family comes from an area that is no longer in Poland' => 'My family comes from an area that is no longer in Poland', 'One of my ancestors served in a foreign army' =>  'One of my ancestors served in a foreign army',
            'One of my ancestors held public office outside of Poland' =>  'One of my ancestors held public office outside of Poland', 'None of the above' =>  'None of the above'),'label' => 'Please select all that apply '));

        //echo $this->Form->input('enquiry_date', array('default' => $td));
        //echo $this->Form->input('Applicant.first_name');
		//echo $this->Form->input('Applicant.middle_name');
		//echo $this->Form->input('0.Applicant.surname');
	?>
        <button type="button" id="btn2" onclick="panels('panel2');return false;">Previous</button>
        </div>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
