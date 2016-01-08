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
      					'name' => 'required|max:40',
      					'father_name' => 'required|max:40',
      					'guardian_name' => 'required|max:40',
      					'gender' => 'required|in:MALE,FEMALE,TRANSGENDER',
      					'nationality' => 'required|in:INDIAN',
      					'emp_status' => 'required|in:YES,NO',
      					'relationship' => 'required|max:20',
      					'state' => 'required|exists:states,id',
      					'district' => 'required|exists:districts,id',
      					'po' => 'required|max:20',
      					'pin' => 'required|digits:6',
      					'village' => 'required|max:20',
      					'address_line' => 'required|max:300'
      ];
  }

  public static function step3_save(){

      return $rules=[
              'photo' => 'required|mimes:jpeg,jpg,png|min:1|max:40',
              'signature' => 'required|mimes:jpeg,jpg,png|min:1|max:20',
              ];
  }

}
