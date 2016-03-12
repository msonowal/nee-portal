<?php

namespace nee_portal\Forms;

use Kris\LaravelFormBuilder\Form;

use nee_portal\Models\Centre;

class CentreCapacityForm extends Form
{
    public function buildForm()
    {
        $this->add('centre_code', 'select', [
        	  'choices' => Centre::lists('centre_name', 'centre_code')->all(),		
	          'attr' => ['required', 'class'=>'form-control'],
	          'label' => false,
	          'wrapper' => ['class' => 'form-group col-md-12'] 
	      ]);

          $this->add('centre_location', 'textarea', [
	          'attr' => ['required', 'maxlength' => '150', 'rows' =>'3', 'placeholder'=> 'Centre Location', 'class'=>'form-control'],
	          'label' => false,
	          'wrapper' => ['class' => 'form-group col-md-12'] 
	      ]);

	      $this->add('centre_capacity', 'text', [
	          'attr' => ['required', 'maxlength' => '4', 'placeholder'=> 'Centre Capacity', 'class'=>'form-control'],
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
