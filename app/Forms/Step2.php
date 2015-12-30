<?php

namespace nee_portal\Forms;

use Kris\LaravelFormBuilder\Form;
use nee_portal\Models\State;

class Step2 extends Form
{
    public function buildForm()
    {
          $this->add('name', 'text', [
	          'attr' => ['required', 'maxlength' => '150'],
	          'wrapper'=>['class'=>'input-field col s12 m6 l4'],
            'label' =>  'Full Name'
	      ]);

          $this->add('father_name', 'text', [
	          'attr' => ['required', 'maxlength' => '150'],
	          'wrapper'=>['class'=>'input-field col s12 m6 l4'],
            'label' =>  'Father\'s name'
	      ]);

          $this->add('guardian_name', 'text', [
	          'attr' => ['required', 'maxlength' => '150'],
	          'wrapper'=>['class'=>'input-field col s12 m6 l4'],
            'label' =>  'Guardian\'s name'
	      ]);

	      $this->add('gender', 'select', [
	      	  'choices' => ['MALE' => 'MALE', 'FEMALE' => 'FEMALE', 'TRANSGENDER' => 'TRANSGENDER'],
	          'empty_value' => 'Select Gender',
	          'attr' => ['required'],
	          'wrapper'=>['class'=>'input-field col s12 m6 l4'],
	      ]);

	      $this->add('nationality', 'select', [
	      	  'choices' => ['INDIA' => 'INDIA'],
	          'attr' => ['required'],
	          'wrapper'=>['class'=>'input-field col s12 m6 l4'],
	      ]);

	      $this->add('emp_status', 'select', [
	      	  'choices' => ['YES' => 'YES', 'NO' => 'NO'],
	      	  'empty_value' => '---Select---',
	          'attr' => ['required'],
	          'wrapper'=>['class'=>'input-field col s12 m6 l4'],
	          'label' => 'Are you Employed?'
	      ]);

	      $this->add('relationship', 'text', [
	          'attr' => ['required'],
	          'wrapper'=>['class'=>'input-field col s12 m6 l4'],
            'label' =>  'Relationship with guardian'
	      ]);

	      $this->add('state', 'select', [
	      	  'choices' => State::lists('name', 'id')->all(),
	      	  'empty_value' => '---Select State---',
	          'attr' => ['required','id'=>'state'],
	          'wrapper'=>['class'=>'input-field col s12 m6 l4'],
	          'label' => 'State'
	      ]);

	      $this->add('district', 'select', [
	      	  'choices' => ['' => '---Select District---'],
	          'attr' => ['required','id'=>'district'],
	          'wrapper'=>['class'=>'input-field col s12 m6 l4'],
	      ]);

	      $this->add('po', 'text', [
	          'attr' => ['required', 'maxlength' => '100'],
	          'wrapper'=>['class'=>'input-field col s12 m6 l4'],
	      ]);


	      $this->add('pin', 'number', [
	          'attr' => ['required', 'maxlength' => '6'],
	          'wrapper'=>['class'=>'input-field col s12 m6 l4'],
	      ]);

	      $this->add('village', 'text', [
	          'attr' => ['required', 'maxlength' => '100'],
	          'wrapper'=>['class'=>'input-field col s12 m6 l4'],
	      ]);

	      $this->add('address_line', 'text', [
	          'attr' => ['required', 'maxlength' => '100'],
	          'wrapper'=>['class'=>'input-field col s12 m6 l4'],
	      ]);

	      $this->add('save', 'submit', [
	          'attr' => ['class'=>'btn btn-lg btn-success col s12 m12 l12'],
	          'label' => 'Save & Continue'
	      ]);

	      $this->add('update', 'submit', [
	          'attr' => ['class'=>'btn btn-md btn-success col s12 m6 l4'],
	      ]);
    }
}
