<?php

namespace nee_portal\Forms;

use Kris\LaravelFormBuilder\Form;

class User extends Form
{
    public function buildForm()
    {
	      $this->add('username', 'text', [
	          'attr' => ['required', 'placeholder'=> 'User Name', 'class'=>'form-control'],
	          'label' => false,
	          'wrapper' => ['class' => 'form-group  col-md-12'] 
	      ]);

	      $this->add('fullname', 'text', [
	          'attr' => ['required', 'placeholder'=> 'Full Name', 'class'=>'form-control'],
	          'label' => false,
	          'wrapper' => ['class' => 'form-group  col-md-12'] 
	      ]);

	      $this->add('mobile_no', 'text', [
	          'attr' => ['required|numeric', 'maxlength'=>'10', 'placeholder'=> 'Mobile Number', 'class'=>'form-control'],
	          'label' => false,
	          'wrapper' => ['class' => 'form-group  col-md-12'] 
	      ]);

	      $this->add('email', 'email', [
	          'attr' => ['required', 'placeholder'=> 'Email Address', 'class'=>'form-control'],
	          'label' => false,
	          'wrapper' => ['class' => 'form-group  col-md-12'] 
	      ]);

	      $this->add('password', 'password', [
	          'attr' => ['required', 'placeholder'=> 'Password', 'class'=>'form-control'],
	          'label' => false,
	          'wrapper' => ['class' => 'form-group  col-md-12'] 
	      ]);

	      $this->add('active', 'choice', [
	      	  'choices' => ['YES' => 'YES', 'NO' => 'NO'],
	      	  'selected' => ['YES'],
	      	  'expanded' => true,		
	          'attr' => ['required', 'class'=>'form-control'],
	          'wrapper' => ['class' => 'form-group  col-md-12'] 
	      ]);

	      $this->add('submit', 'submit', [
	          'attr' => ['class'=>'btn btn-lg btn-success col-md-12'],
	          'label' => 'Submit'
	      ]);

	      $this->add('update', 'submit', [
	          'attr' => ['class'=>'btn btn-md btn-success col-md-12'],
	          'label' => 'Update'
	      ]);
    }
}
