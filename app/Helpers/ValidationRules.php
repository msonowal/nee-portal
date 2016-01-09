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
      				'quota'             =>  'required|exists:quotas,id',
              'reservation_code'  =>  'required|exists:reservations,reservation_code',
      				'c_pref1'           =>  'required|different:c_pref2|exists:centres,centre_code',
      				'c_pref2'           =>  'required|different:c_pref1|exists:centres,centre_code',
      				'nerist_stud'       =>  'required|in:YES,NO',
      				'admission_in'      =>  'required|exists:exam_details,id',
              'voc_subject'       =>  'sometimes|exists:vocational_subjects,paper_code',
              'branch'            =>  'sometimes|exists:branches,id',
              'allied_branch'     =>  'sometimes|exists:allied_branches,id',
              'dob'               =>  'required|date_format:d-m-Y',
              'gender'            =>  'required|in:MALE,FEMALE,TRANSGENDER',
              //'dob'               =>  'required|date_format:d-m-Y|before:"now -15 year"',
      ];
  }

  public static function step1_edit()
  {
      return $rules=[
              'quota'             =>  'required|exists:quotas,id',
              'reservation_code'  =>  'required|exists:reservations,reservation_code',
              'c_pref1'           =>  'required|different:c_pref2|exists:centres,centre_code',
              'c_pref2'           =>  'required|different:c_pref1|exists:centres,centre_code',
              'nerist_stud'       =>  'required|in:YES,NO',
              'admission_in'      =>  'required|exists:exam_details,id',
              'voc_subject'       =>  'sometimes|exists:vocational_subjects,paper_code',
              'branch'            =>  'sometimes|exists:branches,id',
              'allied_branch'     =>  'sometimes|exists:allied_branches,id',
              'dob'               =>  'required|date_format:d-m-Y',
              'gender'            =>  'required|in:MALE,FEMALE,TRANSGENDER',
              //'dob'               =>  'required|date_format:d-m-Y|before:"now -15 year"',
      ];
  }

  public static function step2_save(){

      return $rules=[
      					'name' => 'required|max:40',
      					'father_name' => 'required|max:40',
      					'guardian_name' => 'required|max:40',
      					'nationality' => 'required|in:INDIAN',
      					'emp_status' => 'required|in:YES,NO',
      					'relationship' => 'required|max:20',
      					'state' => 'required|exists:states,id',
      					'district' => 'required|exists:districts,id',
      					'po' => 'required|max:20',
      					'pin' => 'required|digits:6',
      					'village' => 'max:20',
      					'address_line' => 'required|max:300'
      ];
  }

  public static function step3_save(){
      return $rules=[
              'photo' => 'required|mimes:jpeg,jpg,png|min:1|max:60',
              'signature' => 'required|mimes:jpeg,jpg,png|min:1|max:30',
              ];
  }

  public static function step3_update(){
      return $rules=[
              'photo' => 'mimes:jpeg,jpg,png|min:1|max:60',
              'signature' => 'mimes:jpeg,jpg,png|min:1|max:30',
              ];
  }

}
