<?php
namespace nee_portal\Helpers;

use nee_portal\Models\Centre;
use nee_portal\Models\Quota;
use nee_portal\Models\Exam;
use nee_portal\Models\ExamDetail;
use nee_portal\Models\Qualification;
use nee_portal\Models\ExamQualification;
use nee_portal\Models\Branch;
use nee_portal\Models\Candidate;
use nee_portal\Models\AlliedBranch;
use nee_portal\Models\Reservation;
use nee_portal\Models\State;
use nee_portal\Models\District;
use Session, Log, Route;

class Basehelper{

  public static function isActiveRoute($route, $output = "active")
  {
    if (Route::currentRouteName() == $route) return $output;
  }

    public static function checkSession()
    {
        if(Session::get('candidate_info_id', 'not_set') == 'not_set')
            return false;
        else
            return true;
    }

    public static function getVocationalSubject($qualification_id, $exam_id)
    {
      $id = ExamQualification::where('q_id', $qualification_id)->where('exam_id', $exam_id)->first()->id;

      if($id == 5 ){
        return true;
      }else {
        return false;
      }
    }

    public static function getBranchFieldStatus($qualification_id, $exam_id)
    {
      if ($exam_id == 3) {
        return true;
      }else {
        return false;
      }
    }

	public static function getExamDetails($qualification_id, $exam_id)
	{
			$id = ExamQualification::where('q_id', $qualification_id)->where('exam_id', $exam_id)->first()->id;
			//Log::info('Case No of ExamQualification '.$id);
			if($id == 1 || $id == 2 || $id == 4 || $id == 6 || $id == 8){
					//Log::info('on case 1 2 4 6 8');
					return ExamDetail::where('id', 1)->lists('eligible_for', 'id')->all();
			}elseif ($id == 3 || $id == 5 || $id == 9) {
					//Log::info('on case 3 5 9');
					return ExamDetail::where('id', 2)->lists('eligible_for', 'id')->all();
			}elseif ($id == 7) {
					//Log::info('on case 7');
					return ExamDetail::where('id', 3)->lists('eligible_for', 'id')->all();
			}elseif ($id == 10) {
				//Log::info('on case 10');
				return ExamDetail::where('id', 4)->lists('eligible_for', 'id')->all();
			}
			//Log::info('Case Not Found on Basehelper:: 36 '.$id);
			return ['' => 'Not Found'];
	}

	public static function getCentre($id, $return = 'centre_name')
    {
        return $return = Centre::where('centre_code', $id)->pluck($return);
    }

    public static function getQuota($id, $return = 'name')
    {
        return $return = Quota::where('id', $id)->pluck($return);
    }

    public static function getExam($id, $return = 'exam_name')
    {
        return $return = Exam::where('id', $id)->pluck($return);
    }

    public static function getQualification($id, $return = 'qualification')
    {
        return $return = Qualification::where('id', $id)->pluck($return);
    }

    public static function getBranch($id, $return = 'branch_name')
    {
        return $return = Branch::where('id', $id)->pluck($return);
    }

    public static function getAlliedBranch($id, $return = 'allied_branch')
    {
        return $return = AlliedBranch::where('id', $id)->pluck($return);
    }

    public static function getReservationCode($id, $return = 'reservation_code')
    {
        //return $return = Reservation::where('id', $id)->pluck($return);
        return $id;
    }

    public static function getState($id, $return = 'name')
    {
        return $return = State::where('id', $id)->pluck($return);
    }

    public static function getDistrict($id, $return = 'name')
    {
        return $return = District::where('id', $id)->pluck($return);
    }

    public static function getAdmissionIn($id, $return = 'eligible_for')
    {
        return $return = ExamDetail::where('id', $id)->pluck($return);
    }

    public static function getCategory($id, $return = 'category_name')
    {
        return $return = Reservation::where('reservation_code', $id)->pluck($return);
    }

    public static function getNormalPrice($id, $return = 'n_price')
    {
        return $return = Exam::where('id', $id)->pluck($return);
    }

     public static function getOtherPrice($id, $return = 'scst_price')
    {
        return $return = Exam::where('id', $id)->pluck($return);
    }

    public static function getFormNo($id)
    {
        $prefix = '';

        if($id <= 9) {
            $form_no = $prefix.'0000'.$id;
        } elseif($id <= 99) {
            $form_no = $prefix.'000'.$id;
        } elseif($id <= 999) {
            $form_no = $prefix.'00'.$id;
        } elseif($id >= 1000){
            $form_no = $prefix.'0'.$id;
        } else {
            $form_no = $prefix.$id;
        }

        return $form_no;
    }

    public static function getCandidate($id, $return = 'first_name')
    {
        return Candidate::where('id', $id)->pluck($return);
    }

    public static function sendSMS($number, $message){

        $mobile = $number;
        $Text = str_replace(' ','+',$message);

        $ID="";
        $Password="";
        $Sid="";
        $url = "http://t.onetouchsms.in/sendsms.jsp?user=".$ID."&password=".$Password."&mobiles=".$mobile."&sms=".$Text."&senderid=".$Sid;
        $ch=curl_init();
        //curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, 2);
        curl_exec($ch);
        curl_close($ch);
    }


}
