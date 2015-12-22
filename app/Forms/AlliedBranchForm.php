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
	          'attr' => ['required'],
	          'label' => 'Branch Name',
	          'wrapper' => ['class' => 'form-group'] 
	      ]);

	      $this->add('allied_branch', 'text', [
	          'attr' => ['required', 'placeholder'=> 'Allied Branch'],
	          'label' => 'Allied Branch',
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
