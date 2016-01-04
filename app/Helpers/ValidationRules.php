<?php
namespace nee_portal\Helpers;

// use nee_portal\Models\Centre;
// use nee_portal\Models\Quota;
// use nee_portal\Models\Exam;
// use nee_portal\Models\ExamDetail;
// use nee_portal\Models\Qualification;
// use nee_portal\Models\ExamQualification;
// use nee_portal\Models\Branch;
// use nee_portal\Models\Candidate;
// use nee_portal\Models\AlliedBranch;
// use nee_portal\Models\Reservation;
// use nee_portal\Models\State;
// use nee_portal\Models\District;
// use Session, Log, Route;

class ValidationRules{

  public static function step1_save()
  {
      return $rules=[
      				'quota' => 'required|numeric',
      				'c_pref1' => 'required|exists:centres,centre_code',
      				'c_pref2' => 'required|exists:centres,centre_code',
              'dob' => 'required|date_format:d-m-Y',
      				'nerist_stud' => 'required',
      				'admission_in' => 'required|numeric',
      				'reservation_code' => 'required|numeric'
      ];
  }

  public static function step1_edit()
  {
      return $rules=[
      				'quota' => 'required|numeric',
      				'c_pref1' => 'required|exists:centres,centre_code',
      				'c_pref2' => 'required|exists:centres,centre_code',
              'dob' => 'required|date_format:d-m-Y',
      				'nerist_stud' => 'required',
      				'admission_in' => 'required|numeric',
      				'reservation_code' => 'required|numeric'
      ];
  }

  public static function step2_save(){

      return $rules=[
      					'name' => 'required',
      					'father_name' => 'required',
      					'guardian_name' => 'required',
      					'gender' =>'required',
      					'nationality' => 'required',
      					'emp_status' => 'required',
      					'relationship' => 'required',
      					'state' => 'required|numeric',
      					'district' => 'required',
      					'po' => 'required',
      					'pin' => 'required|digits:6|numeric',
      					'village' => 'required|max:100',
      					'address_line' => 'required|max:100'
      ];
  }

}
