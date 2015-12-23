<?php

namespace nee_portal\Forms;

use Kris\LaravelFormBuilder\Form;
use nee_portal\Models\State;

class Step2 extends Form
{
    public function buildForm()
    {
          $this->add('name', 'text', [
	          'attr' => ['required', 'maxlength' => '150', 'placeholder'=> 'Name of Candidate'],
	          'label' => 'Name of Candidate',
	          'wrapper' => ['class' => 'form-group'] 
	      ]);

          $this->add('father_name', 'text', [
	          'attr' => ['required', 'maxlength' => '150', 'placeholder'=> 'Father Name'],
	          'label' => 'Father Name',
	          'wrapper' => ['class' => 'form-group'] 
	      ]);

          $this->add('guardian_name', 'text', [
	          'attr' => ['required', 'maxlength' => '150', 'placeholder'=> 'Guardian Name'],
	          'label' => 'Guardian Name',
	          'wrapper' => ['class' => 'form-group'] 
	      ]);

	      $this->add('gender', 'select', [
	      	  'choices' => ['MALE' => 'MALE', 'FEMALE' => 'FEMALE', 'TRANSGENDER' => 'TRANSGENDER'],
	          'attr' => ['required', 'placeholder'=> 'Select Gender'],
	          'label' => 'Gender',
	          'wrapper' => ['class' => 'form-group'] 
	      ]);

	      $this->add('nationality', 'select', [
	      	  'choices' => ['INDIA' => 'INDIA'],
	          'attr' => ['required', 'placeholder'=> 'Select Nationality'],
	          'label' => 'Nationality',
	          'wrapper' => ['class' => 'form-group'] 
	      ]);

	      $this->add('dob', 'text', [
	          'attr' => ['required', 'placeholder'=> 'Date Of Birth'],
	          'label' => 'Date Of Birth',
	          'wrapper' => ['class' => 'form-group'] 
	      ]);

	      $this->add('emp_status', 'choice', [
	      	  'choices' => ['YES' => 'YES', 'NO' => 'NO'],
	          'attr' => ['required'],
	          'wrapper' => ['class' => 'form-group'] 
	      ]);

	      $this->add('relationship', 'text', [
	          'attr' => ['required', 'placeholder'=> 'Relationship with Guardian'],
	          'wrapper' => ['class' => 'form-group'] 
	      ]);

	      $this->add('state', 'select', [
	      	  'choices' => State::lists('state_name', 'id')->all(),
	          'attr' => ['required', 'maxlength' => '100', 'placeholder'=> 'Select State'],
	          'wrapper' => ['class' => 'form-group'] 
	      ]);

	      $this->add('district', 'select', [
	      	  'choices' => ['' => ''],
	          'attr' => ['required', 'maxlength' => '100', 'placeholder'=> 'Select District'],
	          'wrapper' => ['class' => 'form-group'] 
	      ]);

	      $this->add('po', 'text', [
	          'attr' => ['required', 'maxlength' => '100', 'placeholder'=> 'Post Office'],
	          'wrapper' => ['class' => 'form-group'] 
	      ]);


	      $this->add('pin', 'number', [
	          'attr' => ['required', 'maxlength' => '6', 'placeholder'=> 'Pin Code'],
	          'wrapper' => ['class' => 'form-group'] 
	      ]);

	      $this->add('village_town', 'text', [
	          'attr' => ['required', 'maxlength' => '100', 'placeholder'=> 'Village/Town'],
	          'wrapper' => ['class' => 'form-group'] 
	      ]);

	      $this->add('address_line', 'text', [
	          'attr' => ['required', 'maxlength' => '100', 'placeholder'=> 'Address Line 1'],
	          'wrapper' => ['class' => 'form-group'] 
	      ]);   

	      $this->add('submit', 'submit', [
	          'attr' => ['class'=>'btn btn-lg btn-success col-md-12'],
	          'label' => 'Save & Continue'
	      ]);

	      $this->add('update', 'submit', [
	          'attr' => ['class'=>'btn btn-md btn-success col-md-12'],
	          'label' => 'Update'
	      ]);
    }
}
