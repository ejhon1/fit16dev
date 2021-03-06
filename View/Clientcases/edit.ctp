<div class="clientcases form">
<?php echo $this->Form->create('Clientcase'); ?>
	<fieldset>
		<h2><?php echo __('Edit Eligibility Check'); ?></h2>
	<?php
		echo $this->Form->input('existing_family', array('label'=> 'Other Family Members That Have Used Polaron:'));
		echo $this->Form->input('born_in_poland', array('label' => 'Was The Main Applicant Born In Poland?'));
		echo $this->Form->input('nationality_of_parents', array('label'=> 'Which Parents Were Polish?'));
		echo $this->Form->input('mother_name', array('label'=> 'Mother\'s Name:'));
		echo $this->Form->input('father_name', array('label'=> 'Father\'s Name:'));
		echo $this->Form->input('nationality_of_grandparents', array('label'=> 'Which Grandparents Were Polish?'));
		echo $this->Form->input('mat_grandmother_name', array('label'=> 'Maternal Grandmother\'s Name:'));
		echo $this->Form->input('mat_grandfather_name', array('label'=> 'Maternal Grandfather\'s Name:'));
		echo $this->Form->input('pat_grandmother_name', array('label'=> 'Paternal Grandmother\'s Name:'));
		echo $this->Form->input('pat_grandfather_name', array('label'=> 'Paternal Grandfather\'s Name:'));
		echo $this->Form->input('nationality_of_others', array('label'=> 'Other Polish Ancestors:'));
		echo $this->Form->input('serve_in_army', array('label'=> 'Did Any Of Their Ancestors Serve In The Polish Army?'));
		echo $this->Form->input('serve_in_army_info', array('label'=> 'Information Of Army Service:'));
		echo $this->Form->input('when_left_poland', array('label'=> 'When Did Their Ancestors Leave Poland?'));
		echo $this->Form->input('where_left_poland', array('label'=> 'Where Did They Go?'));
		echo $this->Form->input('where_left_poland_other', array('label'=> 'Country If Other Than In List:'));
		echo $this->Form->input('have_passport', array('label'=> 'Do They Have An Available Passport?'));
		echo $this->Form->input('possess_documents', array('label'=> 'Do They Have Any Documents Available?'));
		echo $this->Form->input('possess_documents_types', array('label'=> 'Documents In Their Possession:'));
		echo $this->Form->input('possess_documents_other', array('label'=> 'Other Documents They Possess:'));
		echo $this->Form->input('other_factors', array('label'=> 'Other Factors Affecting Their Eligibility:'));
        	echo $this->Form->input('brief_history', array('label'=> 'Their Brief Family History:'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
