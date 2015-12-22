<?php

namespace nee_portal\Forms;

use Kris\LaravelFormBuilder\Form;

class CentreForm extends Form
{
    public function buildForm()
    {
          $this->add('centre_code', 'text', [
	          'attr' => ['required', 'maxlength' => '55', 'placeholder'=> 'Centre Code'],
	          'label' => 'Centre Code',
	          'wrapper' => ['class' => 'form-group'] 
	      ]);

          $this->add('centre_name', 'text', [
	          'attr' => ['required', 'maxlength' => '55', 'placeholder'=> 'Centre Name'],
	          'label' => 'Centre Name',
	          'wrapper' => ['class' => 'form-group'] 
	      ]);

	      $this->add('centre_state', 'text', [
	          'attr' => ['required', 'maxlength' => '55', 'placeholder'=> 'Centre State'],
	          'label' => 'Centre State',
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
