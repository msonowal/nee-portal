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
	          'attr' => ['required', 'class'=>'browser-default'],
	      ]);

          $this->add('c_pref1', 'select', [
           	  'choices' => Centre::lists('centre_name', 'id')->all(),
           	  'empty_value' => 'Select Centre Preference 1', 	
	          'attr' => ['required'],
	      ]);

	      $this->add('c_pref2', 'select', [
           	  'choices' => Centre::lists('centre_name', 'id')->all(),
           	  'empty_value' => 'Select Centre Preference 2',
	          'attr' => ['required'],
	      ]);

	      $this->add('dob', 'date', [
	          'attr' => ['required', 'class' => 'datepicker'],
	      ]);

	      $this->add('nerist_stud', 'select', [
           	  'choices' => ['YES' => 'YES', 'NO' => 'NO'],
           	  'empty_value' => 'Are you a Nerist Student', 	 	
	          'attr' => ['required'],
	      ]); 

	      $this->add('status', 'select', [
           	  'choices' => ['1' => 'PASSED', '0' => 'APPEARED'],
           	  'empty_value' => 'Select Status', 	 	
	          'attr' => ['required'],
	      ]);

	      $this->add('admission_in', 'select', [
           	  'choices' => ExamDetail::lists('eligible_for', 'id')->all(),
           	  'empty_value' => 'Select', 	 	
	          'attr' => ['required'],
	      ]);


	      $this->add('voc_subject', 'select', [
           	  'choices' => ['' =>''], 
           	  'empty_value' => 'Select', 	
	          'attr' => ['required'],
	      ]);

	      $this->add('branch', 'select', [
           	  'choices' => Branch::lists('branch_name', 'id')->all(), 
           	  'empty_value' => 'Select branch', 	
	          'attr' => ['required'],
	      ]);

	      $this->add('allied_branch', 'select', [
           	  'choices' => AlliedBranch::lists('allied_branch', 'id')->all(), 
           	  'empty_value' => 'Select Branch Subject', 	
	          'attr' => ['required'],
	      ]);

	      $this->add('reservation_code', 'select', [
           	  'choices' => ['' => 'Select Reservation Code'],
	          'attr' => ['required', 'class'=>'browser-default'],
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
