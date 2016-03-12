<?php

namespace nee_portal\Forms;

use Kris\LaravelFormBuilder\Form;

use nee_portal\Models\Quota;

class ReservationForm extends Form
{
    public function buildForm()
    {
        $this->add('quota_id', 'select', [
        	  'choices' => Quota::lists('name', 'id')->all(),		
	          'attr' => ['required', 'class'=>'form-control'],
	          'label' => false,
	          'wrapper' => ['class' => 'form-group col-md-12'] 
	      ]);

          $this->add('reservation_code', 'text', [
	          'attr' => ['required', 'placeholder'=> 'Reservation Code', 'class'=>'form-control'],
	          'label' => false,
	          'wrapper' => ['class' => 'form-group col-md-12'] 
	      ]);

	      $this->add('description', 'text', [
	          'attr' => ['required', 'maxlength' => '255', 'placeholder'=> 'Description', 'class'=>'form-control'],
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
