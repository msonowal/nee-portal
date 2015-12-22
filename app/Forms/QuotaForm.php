<?php

namespace nee_portal\Forms;

use Kris\LaravelFormBuilder\Form;

class QuotaForm extends Form
{
    public function buildForm()
    {
          $this->add('name', 'text', [
	          'attr' => ['required', 'maxlength' => '55', 'placeholder'=> 'Quota Name'],
	          'label' => 'Quota Name',
	          'wrapper' => ['class' => 'form-group'] 
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
