<?php

namespace nee_portal\Forms;

use Kris\LaravelFormBuilder\Form;

class ExamForm extends Form
{
    public function buildForm()
    {
	      $this->add('exam_name', 'select', [
	      	  'choices' => ['NEE I' => 'NEE I', 'NEE II' => 'NEE II', 'NEE III' => 'NEE III'],
	          'attr' => ['required', 'placeholder'=> 'Select Exam', 'class'=>'form-control'],
	          'label' => false,
	          'wrapper' => ['class' => 'form-group  col-md-12'] 
	      ]);

	      $this->add('description', 'textarea', [
	          'attr' => ['maxlength' => '150', 'rows' => '2', 'placeholder'=> 'Description of Examination', 'class'=>'form-control'],
	          'label' => false,
	          'wrapper' => ['class' => 'form-group  col-md-12'] 
	      ]);

	      $this->add('n_price', 'text', [
	          'attr' => ['required|numeric', 'placeholder'=> 'Normal Price', 'class'=>'form-control'],
	          'label' => false,
	          'wrapper' => ['class' => 'form-group  col-md-12'] 
	      ]);

	      $this->add('scst_price', 'text', [
	          'attr' => ['required|numeric', 'placeholder'=> 'SC, ST Price', 'class'=>'form-control'],
	          'label' => false,
	          'wrapper' => ['class' => 'form-group  col-md-12'] 
	      ]);

	      $this->add('start_date', 'text', [
	          'attr' => ['required', 'maxlength' => '55', 'placeholder'=> 'Exam Start Date', 'class'=>'form-control'],
	          'label' => false,
	          'wrapper' => ['class' => 'form-group  col-md-12'] 
	      ]);

	      $this->add('active', 'choice', [
	      	  'choices' => ['YES' => 'YES', 'NO' => 'NO'],
	      	  'selected' => ['YES'],
	      	  'expanded' => true,		
	          'attr' => ['required'],
	          'wrapper' => ['class' => 'form-group  col-md-12'] 
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
