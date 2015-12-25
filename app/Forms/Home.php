<?php

namespace nee_portal\Forms;

use Kris\LaravelFormBuilder\Form;
use nee_portal\Models\Qualification;

class Home extends Form
{
    public function buildForm()
    {
        $this->add('q_id', 'select', [
           	  'choices' => ['' => 'Select Qualification'] + Qualification::lists('qualification', 'id')->all(),
	          'empty_value' => 'Select Qualification',
	          'attr' => ['required', 'id' => 'q_id'],
	      ]);

        $this->add('exam_id', 'select', [
           	  'choices' => ['' => 'Select Exam'],           	  
	            'attr' => ['required', 'id'=>'exam_id', 'class'=>'browser-default'],
	      ]);


      	$this->add('submit', 'submit', [
          'attr' => ['class'=>'btn waves-effect waves-light blue'],
          'label' => 'Apply'
      	]);
    }
}
