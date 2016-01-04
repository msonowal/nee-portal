<?php

namespace nee_portal\Forms;

use Kris\LaravelFormBuilder\Form;
use nee_portal\Models\Quota;
use nee_portal\Models\Centre;
use nee_portal\Models\ExamDetail;
use nee_portal\Models\AlliedBranch;
use nee_portal\Models\Reservation;
use nee_portal\Models\Branch;

class Step1 extends Form
{
    public function buildForm()
    {
           $this->add('quota', 'select', [
             'choices' => Quota::lists('name', 'id')->all(),
             'empty_value' => 'Select Quota',
             'attr' => ['required','id'=>'quota'],
             'wrapper'=>['class'=>'input-field col m6'],
             'label' => 'Select Quota'
	      ]);

        $centre_choices = Centre::lists('centre_name', 'centre_code')->all();
          $this->add('c_pref1', 'select', [
            'choices' => $centre_choices,
            'empty_value' => 'Select Centre Preference 1',
            'attr' => ['required'],
            'wrapper'=>['class'=>'input-field col m6'],
            'label' => 'Centre Preference 1'
	      ]);

	      $this->add('c_pref2', 'select', [
           	'choices' => $centre_choices,
           	'empty_value' => 'Select Centre Preference 2',
	          'attr' => ['required'],
            'wrapper'=>['class'=>'input-field col m6'],
            'label' => 'Centre Preference 2'
	      ]);

	      $this->add('dob', 'date', [
	          'attr' => ['required', 'class' => 'datepicker'],
            'wrapper'=>['class'=>'input-field col m6'],
            'label' => 'Date of Birth (dd-mm-yyyy)'
	      ]);

	      $this->add('nerist_stud', 'select', [
           	'choices' => ['YES' => 'YES', 'NO' => 'NO'],
           	'selected' => 'NO',
            'class' => '',
	          'attr' => ['required'],
            'wrapper'=>['class'=>'input-field col m6'],
            'label' => 'Are you a Nerist Student?'
	      ]);

	      $this->add('admission_in', 'select', [
           	  'choices' => $this->getData('eligible_for'),
	            'attr' => ['required'],
              'wrapper'=>['class'=>'input-field col m6']
	      ]);


        if($this->getData('voc_subject')){

  	      $this->add('voc_subject', 'select', [
             	'choices' => ['AE' =>'AE'],
             	'empty_value' => 'Select',
  	          'attr' => ['required'],
              'wrapper'=>['class'=>'input-field col m6'],
              'label' =>  'Vocational Subject'
  	      ]);
        }

        if($this->getData('branch_status')){

    	      $this->add('branch', 'select', [
              'choices' => Branch::lists('branch_name', 'id')->all(),
              'empty_value' => 'Select branch',
    	        'attr' => ['required'],
              'wrapper'=>['class'=>'input-field col m6']
    	      ]);

    	      $this->add('allied_branch', 'select', [
               	'choices' => AlliedBranch::lists('allied_branch', 'id')->all(),
               	'empty_value' => 'Select Branch Subject',
    	          'attr' => ['required'],
                'wrapper'=>['class'=>'input-field col m6']
    	      ]);
        }

	      $this->add('reservation_code', 'select', [
           	'choices' => ['' => 'Select Reservation Code'],
	          'attr' => ['required', 'id'=>'reservation_code'],
            'wrapper'=>['class'=>'input-field col m6']
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
