<?php

namespace nee_portal\Forms;

use Kris\LaravelFormBuilder\Form;

class CentreForm extends Form
{
    public function buildForm()
    {
          $this->add('centre_code', 'text', [
	          'attr' => ['required', 'maxlength' => '55', 'placeholder'=> 'Centre Code', 'class'=>'form-control'],
	          'label' => false,
	          'wrapper' => ['class' => 'form-group col-md-12'] 
	      ]);

          $this->add('centre_name', 'text', [
	          'attr' => ['required', 'maxlength' => '55', 'placeholder'=> 'Centre Name', 'class'=>'form-control'],
	          'label' => false,
	          'wrapper' => ['class' => 'form-group col-md-12'] 
	      ]);

	      $this->add('centre_state', 'text', [
	          'attr' => ['required', 'maxlength' => '55', 'placeholder'=> 'Centre State', 'class'=>'form-control'],
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
