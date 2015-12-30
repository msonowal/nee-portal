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
	          //'empty_value' => 'Select Qualification',
            'label'=> false,
	          'attr' => ['required', 'id' => 'q_id'],
            'wrapper' => ['class' => 'input-field col l6'],
	      ]);

        $this->add('qualification_status', 'select', [
           	'choices' => ['PASSED' => 'PASSED', 'APPEARED' => 'APPEARED'],
           	'empty_value' => 'Select Status',
	          'attr' => ['required'],
            'wrapper'=>['class'=>'input-field col m6']
	      ]);

        $this->add('exam_id', 'select', [
           	  'choices' => ['' => 'Select Qualification first'],
              'label' => false,
	            'attr' => ['required', 'id'=>'exam_id', 'class'=>'browser-default'],
              'wrapper' => ['class' => 'input-field col l6'],
	      ]);


      	$this->add('submit', 'submit', [
          'attr' => ['class'=>'btn waves-effect waves-light blue col s12'],
          'label' => 'Apply'
      	]);
    }
}
