<div class="test">

    <?php echo $this->Form->create('User'); ?>
    <fieldset>
        <?php
            echo $this->Form->input('ClientCase.born_in_poland', array(
                //'id' => 'born_in_poland',
               // 'name' => 'born_in_poland',
                'type' => 'radio',
                'options' => array(
                    'Yes' => 'Yes',
                    'No' => 'No'),
                'legend' => 'I was born in Poland'));

            echo $this->Form->input('ClientCase.have_passport', array(
                'type' => 'radio',
                'options' => array(
                    'Yes' => 'Yes',
                    'No' => 'No'),
                'legend' => 'I have/had a Polish passport and wish to renew it'));

            echo $this->Form->input('ClientCase.spouse_nationality', array(
                'type' => 'radio',
                'options' => array(
                    'Yes' => 'Yes',
                    'No' => 'No'),
                'legend' => 'My Spouse is Polish'));
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
    </fieldset>
    <?php echo $this->Form->end(__('Submit')); ?>

</div>