<?php

namespace nee_portal\Forms;

use Kris\LaravelFormBuilder\Form;

class BranchForm extends Form
{
    public function buildForm()
    {
          $this->add('branch_name', 'text', [
	          'attr' => ['required', 'maxlength' => '150', 'placeholder'=> 'Branch Name', 'class'=>'form-control'],
	          'label' => false,
	          'wrapper' => ['class' => 'form-group col-md-12'] 
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
