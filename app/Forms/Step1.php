<?php

namespace nee_portal\Forms;

use Kris\LaravelFormBuilder\Form;
use nee_portal\Models\Quota;
use nee_portal\Models\Centre;
use nee_portal\Models\ExamDetail;
use nee_portal\Models\AlliedBranch;
use nee_portal\Models\Reservation;
use nee_portal\Models\Branch;
use nee_portal\Models\VocationalSubject;

class Step1 extends Form
{
    public function buildForm()
    {
        $this->add('quota', 'select', [
            'choices' => Quota::lists('name', 'id')->all(),
            'empty_value' => ' -- Select Quota -- ',
            'attr' => ['required','id'=>'quota', 'data-msg'=>"Please select a Quota"],
            'wrapper'=>['class'=>'input-field col m6'],
            'label' => 'Select Quota'
	      ]);

        $this->add('reservation_code', 'select', [
            'choices' => ['' => ' -- Select Quota First -- '],
            'attr' => ['required', 'id'=>'reservation_code', 'data-msg'=>"Please select a reservation code from the list"],
            'wrapper'=>['class'=>'input-field col m6']
        ]);

        $this->add('admission_in', 'select', [
            'choices' => $this->getData('eligible_for'),
            'attr' => ['required', 'id'=>'admission_in'],
            'wrapper'=>['class'=>'input-field col m6']
        ]);

        $this->add('nerist_stud', 'select', [
            'choices' => ['YES' => 'YES', 'NO' => 'NO'],
            'selected' => 'NO',
            'class' => '',
            'attr' => ['required', 'data-msg'=>"Please specify if you are a NERIST student", 'id'=>'nerist_stud'],
            'wrapper'=>['class'=>'input-field col m6'],
            'label' => 'Are you a Nerist Student?'
        ]);

        $centre_choices = Centre::lists('centre_name', 'centre_code')->all();
          $this->add('c_pref1', 'select', [
            'choices' => $centre_choices,
            'empty_value' => ' -- Select Exam Centre Preference 1 -- ',
            'attr' => ['required', 'data-msg'=>"Please select a Exam Centre Preference 1", 'id'=>'c_pref1', 'class'=>'pref'],
            'wrapper'=>['class'=>'input-field col m6'],
            'label' => 'Exam Centre Preference 1'
	      ]);

	      $this->add('c_pref2', 'select', [
           	'choices' => $centre_choices,
           	'empty_value' => ' -- Select Exam Centre Preference 2 -- ',
	          'attr' => ['required', 'data-msg'=>"Please select a Exam Centre Preference 2", 'id'=>'c_pref2', 'class'=>'pref'],
            'wrapper'=>['class'=>'input-field col m6'],
            'label' => 'Exam Centre Preference 2'
	      ]);

        if($this->getData('voc_subject')){

  	      $this->add('voc_subject', 'select', [
             	'choices' => VocationalSubject::lists('name', 'paper_code')->all(),
             	'empty_value' => ' -- Choose -- ',
  	          'attr' => ['required', 'data-msg'=>"Please choose your vocational subject", 'id'=>'voc_subject'],
              'wrapper'=>['class'=>'input-field col m6'],
              'label' =>  'Vocational Subject'
  	      ]);
        }

        if($this->getData('branch_status')){

    	      $this->add('branch', 'select', [
              'choices' => Branch::lists('branch_name', 'id')->all(),
              'empty_value' => ' -- Choose -- ',
    	        'attr' => ['required', 'id'=>'branch_id', 'data-msg'=>"Please choose your branch"],
              'wrapper'=>['class'=>'input-field col m6']
    	      ]);

            //AlliedBranch::lists('allied_branch', 'id')->all()
    	      $this->add('allied_branch', 'select', [
               	'choices' => [''=>' -- Select Branch Subject first -- '],
    	          'attr' => ['required', 'id'=>'allied_branch_id', 'data-msg'=>"Please choose your branch subject"],
                'wrapper'=>['class'=>'input-field col m6']
    	      ]);
        }

        $this->add('dob', 'date', [
            'attr' => ['required', 'class' => 'datepicker', 'data-msg'=>"Please select a Date of birth"],
            'wrapper'=>['class'=>'input-field col m6'],
            'label' => 'Date of Birth (dd-mm-yyyy)'
        ]);

	      $this->add('save', 'submit', [
	          'attr' => ['class'=>'btn btn-lg btn-success col-md-12'],
	          'label' => 'Save & Continue'
	      ]);

	      $this->add('update', 'submit', [
	          'attr' => ['class'=>'btn btn-md btn-success col-md-12'],
	      ]);

    }
}
