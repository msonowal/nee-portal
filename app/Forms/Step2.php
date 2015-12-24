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
	      ]);

          $this->add('father_name', 'text', [
	          'attr' => ['required', 'maxlength' => '150'],
	      ]);

          $this->add('guardian_name', 'text', [
	          'attr' => ['required', 'maxlength' => '150'],
	      ]);

	      $this->add('gender', 'select', [
	      	  'choices' => ['MALE' => 'MALE', 'FEMALE' => 'FEMALE', 'TRANSGENDER' => 'TRANSGENDER'],
	          'attr' => ['required'],
	      ]);

	      $this->add('nationality', 'select', [
	      	  'choices' => ['INDIA' => 'INDIA'],
	          'attr' => ['required'],
	      ]);

	      $this->add('emp_status', 'choice', [
	      	  'choices' => ['YES' => 'YES', 'NO' => 'NO'],
	          'attr' => ['required'],
	      ]);

	      $this->add('relationship', 'text', [
	          'attr' => ['required'],
	      ]);

	      $this->add('state', 'select', [
	      	  'choices' => State::lists('state_name', 'id')->all(),
	          'attr' => ['required', 'maxlength' => '100'],
	      ]);

	      $this->add('district', 'select', [
	      	  'choices' => ['' => ''],
	          'attr' => ['required', 'maxlength' => '100'],
	      ]);

	      $this->add('post_office', 'text', [
	          'attr' => ['required', 'maxlength' => '100'],
	      ]);


	      $this->add('pin', 'number', [
	          'attr' => ['required', 'maxlength' => '6'],
	      ]);

	      $this->add('village_town', 'text', [
	          'attr' => ['required', 'maxlength' => '100'],
	      ]);

	      $this->add('address_line', 'text', [
	          'attr' => ['required', 'maxlength' => '100'],
	      ]);   

	      $this->add('submit', 'submit', [
	          'attr' => ['class'=>'btn btn-lg btn-success col-md-12'],
	      ]);

	      $this->add('update', 'submit', [
	          'attr' => ['class'=>'btn btn-md btn-success col-md-12'],
	      ]);
    }
}
