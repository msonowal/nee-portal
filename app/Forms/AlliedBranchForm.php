<?php

namespace nee_portal\Forms;

use Kris\LaravelFormBuilder\Form;
use nee_portal\Models\Branch;

class AlliedBranchForm extends Form
{
    public function buildForm()
    {
          $this->add('branch_id', 'select', [
        	  'choices' => Branch::lists('branch_name', 'id')->all(),		
	          'attr' => ['required', 'class'=>'form-control'],
	          'label' => false,
	          'wrapper' => ['class' => 'form-group col-md-12'] 
	      ]);

	      $this->add('allied_branch', 'text', [
	          'attr' => ['required', 'placeholder'=> 'Allied Branch', 'class'=>'form-control'],
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
