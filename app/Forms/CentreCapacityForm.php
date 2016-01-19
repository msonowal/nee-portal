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
	          'attr' => ['required'],
	          'label' => 'Centre',
	          'wrapper' => ['class' => 'form-group'] 
	      ]);

          $this->add('centre_location', 'textarea', [
	          'attr' => ['required', 'maxlength' => '150', 'rows' =>'3', 'placeholder'=> 'Centre Location'],
	          'label' => 'Centre Location',
	          'wrapper' => ['class' => 'form-group'] 
	      ]);

	      $this->add('centre_capacity', 'text', [
	          'attr' => ['required', 'maxlength' => '4', 'placeholder'=> 'Centre Capacity'],
	          'label' => 'Centre Capacity',
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
