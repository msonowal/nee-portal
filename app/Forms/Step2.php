<?php

namespace nee_portal\Forms;

use Kris\LaravelFormBuilder\Form;
use nee_portal\Models\State;

class Step2 extends Form
{
    public function buildForm()
    {
          $this->add('name', 'text', [
	          'attr' => ['required', 'maxlength' => '40', 'title'=>'full name of the candidate is required'],
	          'wrapper'=>['class'=>'input-field col s12 m6 l4'],
	          'label' =>  'Full Name of the Candidate'
              //'label_attr' => ['data-error'=>"reqruied", 'data-success'=>"right"],
	      ]);

          $this->add('father_name', 'text', [
	          'attr' => ['required', 'maxlength' => '40', 'data-msg'=>"please specify Father's name"],
	          'wrapper'=>['class'=>'input-field col s12 m6 l4'],
            'label' =>  'Father\'s name'
	      ]);

          $this->add('guardian_name', 'text', [
	          'attr' => ['required', 'maxlength' => '40', 'data-msg'=>"please specify guardian's name"],
	          'wrapper'=>['class'=>'input-field col s12 m6 l4'],
            'label' =>  'Guardian\'s name'
	      ]);

	      $this->add('gender', 'select', [
	      	  'choices' => ['MALE' => 'MALE', 'FEMALE' => 'FEMALE', 'TRANSGENDER' => 'TRANSGENDER'],
	          'empty_value' => ' -- Select Gender -- ',
	          'attr' => ['required', 'data-msg'=>"please choose your gender from the list", 'id'=>'gender'],
	          'wrapper'=>['class'=>'input-field col s12 m6 l4'],
	      ]);

	      $this->add('nationality', 'select', [
	      	  'choices' => ['INDIAN' => 'INDIAN'],
	          'attr' => ['required'],
	          'wrapper'=>['class'=>'input-field col s12 m6 l4'],
	      ]);

	      $this->add('emp_status', 'select', [
	      	  'choices' => ['YES' => 'YES', 'NO' => 'NO'],
	      	  'empty_value' => ' -- Select -- ',
	          'attr' => ['required', 'data-msg'=>"select your employment status", 'id'=>'emp_status'],
	          'wrapper'=>['class'=>'input-field col s12 m6 l4'],
	          'label' => 'Are you Employed?'
	      ]);

	      $this->add('relationship', 'text', [
	          'attr' => ['required', 'data-msg'=>"specify your relationsip with guardian", 'maxlength'=>'20'],
	          'wrapper'=>['class'=>'input-field col s12 m6 l4'],
            'label' =>  'Relationship with guardian'
	      ]);

	      $this->add('state', 'select', [
	      	  'choices' => State::lists('name', 'id')->all(),
	      	  'empty_value' => ' -- Select State -- ',
	          'attr' => ['required','id'=>'state', 'data-msg'=>"please choose your state name from the list"],
	          'wrapper'=>['class'=>'input-field col s12 m6 l4'],
	          'label' => 'State'
	      ]);

	      $this->add('district', 'select', [
	      	  'choices' => ['' => ' -- Select District -- '],
	          'attr' => ['required','id'=>'district', 'data-msg'=>"please specify your district's name"],
	          'wrapper'=>['class'=>'input-field col s12 m6 l4'],
	      ]);

	      $this->add('po', 'text', [
	          'attr' => ['required', 'maxlength' => '20', 'data-msg'=>"please specify your POST OFFICE name"],
	          'wrapper'=>['class'=>'input-field col s12 m6 l4'],
            'label'=>'Post Office'
	      ]);


	      $this->add('pin', 'number', [
	          'attr' => ['required', 'maxlength' => '6', 'data-msg'=>"specify your's POSTAL CODE/ PIN NO ",
                      'data-rule-digits'=> 'true', 'data-rule-minlength'=> '6',
                      'data-msg-minlength'=>'Pin code must be {0} digits',
                      'data-msg-maxlength'=>'Pin code can not be more than {0} digits',
                    ],
	          'wrapper'=>['class'=>'input-field col s12 m6 l4'],
            'label'=>'Pin Code'
	      ]);

	      $this->add('village', 'text', [
	          'attr' => ['maxlength' => '20', 'data-msg'=>"please specify Village's name"],
	          'wrapper'=>['class'=>'input-field col s12 m6 l4'],
	      ]);

	      $this->add('address_line', 'textarea', [
	          'attr' => ['class'=>'materialize-textarea',
                    'required',
                    'maxlength' => '300',
                    'data-msg'=> "please specify your full address",
                    //'length' => '300',
            ],
	          'wrapper'=>['class'=>'input-field col s12 m12 l12'],
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
