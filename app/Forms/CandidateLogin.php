<?php

namespace nee_portal\Forms;

use Kris\LaravelFormBuilder\Form;

class CandidateLogin extends Form
{
    public function buildForm()
    {
        $this->add('email', 'email', [
	          'attr' => ['required', 'maxlength' => '100'],
	          'wrapper' => ['class' => 'form-group'] 
	      ]);

        $this->add('password', 'password', [
	          'attr' => ['required'],
	          'wrapper' => ['class' => 'form-group'] 
	      ]);

	      $this->add('submit', 'submit', [
	          'attr' => ['class'=>'btn waves-effect waves-light blue'],
	          'label' => 'Login'
	      ]);

    }
}
