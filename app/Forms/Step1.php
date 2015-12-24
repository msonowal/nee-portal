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
	          'attr' => ['required'],
	      ]);

          $this->add('c_pref1', 'select', [
           	  'choices' => Centre::lists('centre_name', 'id')->all(), 	
	          'attr' => ['required'],
	      ]);

	      $this->add('c_pref2', 'select', [
           	  'choices' => Centre::lists('centre_name', 'id')->all(), 	
	          'attr' => ['required'],
	      ]);

	      $this->add('dob', 'date', [
	          'attr' => ['required', 'class' => 'datepicker'],
	      ]);

	      $this->add('nerist_stud', 'select', [
           	  'choices' => ['YES' => 'YES', 'NO' => 'NO'], 	
	          'attr' => ['required'],
	      ]); 

	      $this->add('status', 'select', [
           	  'choices' => ['1' => 'PASSED', '0' => 'APPEARED'], 	
	          'attr' => ['required'],
	      ]);

	      $this->add('admission_in', 'select', [
           	  'choices' => ExamDetail::lists('eligible_for', 'id')->all(), 	
	          'attr' => ['required'],
	      ]);


	      $this->add('voc_subject', 'select', [
           	  'choices' => ['' =>''], 	
	          'attr' => ['required'],
	      ]);

	      $this->add('branch', 'select', [
           	  'choices' => Branch::lists('branch_name', 'id')->all(), 	
	          'attr' => ['required'],
	      ]);

	      $this->add('allied_branch', 'select', [
           	  'choices' => AlliedBranch::lists('allied_branch', 'id')->all(), 	
	          'attr' => ['required'],
	      ]);

	      $this->add('res_code', 'select', [
           	  'choices' => Reservation::lists('reservation_code', 'id')->all(), 	
	          'attr' => ['required'],
	      ]);

	      $this->add('save', 'submit', [
	          'attr' => ['class'=>'btn btn-lg btn-success col-md-12'],
	      ]);

	      $this->add('update', 'submit', [
	          'attr' => ['class'=>'btn btn-md btn-success col-md-12'],
	      ]);

	       
    }
}
