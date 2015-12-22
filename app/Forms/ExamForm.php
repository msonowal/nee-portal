<?php

namespace nee_portal\Forms;

use Kris\LaravelFormBuilder\Form;

class ExamForm extends Form
{
    public function buildForm()
    {
	      $this->add('exam_code', 'text', [
	          'attr' => ['required', 'maxlength' => '10', 'placeholder'=> 'Examination Code'],
	          'label' => 'Exam Code',
	          'wrapper' => ['class' => 'form-group'] 
	      ]);

	      $this->add('exam_name', 'select', [
	      	  'choices' => ['NEE I' => 'NEE I', 'NEE II' => 'NEE II', 'NEE III' => 'NEE III'],
	          'attr' => ['required', 'placeholder'=> 'Select Exam'],
	          'label' => 'Exam Name',
	          'wrapper' => ['class' => 'form-group'] 
	      ]);

	      $this->add('description', 'textarea', [
	          'attr' => ['maxlength' => '150', 'rows' => '2', 'placeholder'=> 'Description of Examination'],
	          'label' => 'Exam Description',
	          'wrapper' => ['class' => 'form-group'] 
	      ]);

	      $this->add('n_price', 'text', [
	          'attr' => ['required|numeric', 'placeholder'=> 'Normal Price'],
	          'label' => 'Normal Price',
	          'wrapper' => ['class' => 'form-group'] 
	      ]);

	      $this->add('scst_price', 'text', [
	          'attr' => ['required|numeric', 'placeholder'=> 'SC, ST Price'],
	          'label' => 'SC, ST Price',
	          'wrapper' => ['class' => 'form-group'] 
	      ]);

	      $this->add('start_date', 'text', [
	          'attr' => ['required', 'maxlength' => '55', 'placeholder'=> 'Exam Start Date'],
	          'label' => 'Exam Start Date',
	          'wrapper' => ['class' => 'form-group'] 
	      ]);

	      $this->add('active', 'choice', [
	      	  'choices' => ['YES' => 'YES', 'NO' => 'NO'],
	      	  'selected' => ['YES'],
	      	  'expanded' => true,		
	          'attr' => ['required'],
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
