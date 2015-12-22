<?php

namespace nee_portal\Forms;

use Kris\LaravelFormBuilder\Form;

use nee_portal\Models\Exam;

use nee_portal\Models\Qualification;

class ExamDetailForm extends Form
{
    public function buildForm()
    {
	      $this->add('exam_id', 'select', [
        	  'choices' => Exam::lists('exam_name', 'id')->all(),		
	          'attr' => ['required'],
	          'label' => 'Exam Name',
	          'wrapper' => ['class' => 'form-group'] 
	      ]);

	      $this->add('qualification_id', 'select', [
        	  'choices' => Qualification::lists('qualification', 'id')->all(),		
	          'attr' => ['required'],
	          'label' => 'Academic Qualification',
	          'wrapper' => ['class' => 'form-group'] 
	      ]);

	      $this->add('eligible_for', 'text', [
	          'attr' => ['required', 'maxlength' => '10', 'placeholder'=> 'Eligible for Admission to'],
	          'label' => 'Eligible for Admission to',
	          'wrapper' => ['class' => 'form-group'] 
	      ]);

	      $this->add('paper_code', 'text', [
	          'attr' => ['required|numeric', 'placeholder'=> 'Paper Code'],
	          'label' => 'Paper Code',
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
