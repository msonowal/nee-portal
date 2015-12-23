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
	          'attr' => ['required', 'placeholder'=> 'State Quota'],
	          'label' => 'State Quota',
	          'wrapper' => ['class' => 'form-group'] 
	      ]);

          $this->add('c_pref1', 'select', [
           	  'choices' => Centre::lists('centre_name', 'id')->all(), 	
	          'attr' => ['required', 'placeholder'=> 'Centre Preference 1'],
	          'label' => 'Centre Preference 1',
	          'wrapper' => ['class' => 'form-group'] 
	      ]);

	      $this->add('c_pref2', 'select', [
           	  'choices' => Centre::lists('centre_name', 'id')->all(), 	
	          'attr' => ['required', 'placeholder'=> 'Centre Preference 2'],
	          'label' => 'Centre Preference 2',
	          'wrapper' => ['class' => 'form-group'] 
	      ]);

	      $this->add('nerist_stud', 'select', [
           	  'choices' => ['YES' => 'YES', 'NO' => 'NO'], 	
	          'attr' => ['required', 'placeholder'=> 'Are you a NERIST Student'],
	          'label' => 'Are you a NERIST Student',
	          'wrapper' => ['class' => 'form-group'] 
	      ]); 

	      $this->add('status', 'select', [
           	  'choices' => ['1' => 'PASSED', '0' => 'APPEARED'], 	
	          'attr' => ['required', 'placeholder'=> 'Status'],
	          'label' => 'Status',
	          'wrapper' => ['class' => 'form-group'] 
	      ]);

	      $this->add('admission_in', 'select', [
           	  'choices' => ExamDetail::lists('eligible_for', 'id')->all(), 	
	          'attr' => ['required', 'placeholder'=> 'For Admission In'],
	          'label' => 'For Admission In',
	          'wrapper' => ['class' => 'form-group'] 
	      ]);


	      $this->add('voc_subject', 'select', [
           	  'choices' => ['' =>''], 	
	          'attr' => ['required', 'placeholder'=> 'Vocational Subject'],
	          'label' => 'Vocational Subject',
	          'wrapper' => ['class' => 'form-group'] 
	      ]);

	      $this->add('branch', 'select', [
           	  'choices' => Branch::lists('branch_name', 'id')->all(), 	
	          'attr' => ['required', 'placeholder'=> 'Admissable Branch'],
	          'label' => 'Admissable Branch',
	          'wrapper' => ['class' => 'form-group'] 
	      ]);

	      $this->add('allied_branch', 'select', [
           	  'choices' => AlliedBranch::lists('allied_branch', 'id')->all(), 	
	          'attr' => ['required', 'placeholder'=> 'Branch Subject'],
	          'label' => 'Branch Subject',
	          'wrapper' => ['class' => 'form-group'] 
	      ]);

	      $this->add('res_code', 'select', [
           	  'choices' => Reservation::lists('reservation_code', 'id')->all(), 	
	          'attr' => ['required', 'placeholder'=> 'Reservation Code'],
	          'label' => 'Reservation Code',
	          'wrapper' => ['class' => 'form-group'] 
	      ]);

	      $this->add('submit', 'submit', [
	          'attr' => ['class'=>'btn btn-lg btn-success col-md-12'],
	          'label' => 'Save & Continue'
	      ]);

	      $this->add('update', 'submit', [
	          'attr' => ['class'=>'btn btn-md btn-success col-md-12'],
	          'label' => 'Update'
	      ]);

	       
    }
}
