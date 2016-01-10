<?php
namespace nee_portal\Helpers;

use nee_portal\Models\CandidateInfo;
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
use nee_portal\Models\Step1;
use Carbon\Carbon;

class Basehelper{

    public static function checkAgeLimit($info_id, $data)
    {
        $candidateinfo = CandidateInfo::find($info_id);
        $format = 'd-m-Y';
        $dob = Carbon::createFromFormat($format, $data['dob']);
        $limit_date = '';
        $msg = 'Maximum Age limit Restriction ';
        //$category = Basehelper::getCategory($data['reservation_code']);

        if($candidateinfo->exam_id == 1){

            $msg.='<strong>NEE-I</strong><br/>';

            if($data['gender'] == 'FEMALE'){
                $limit_date = '01-08-1994';
                $msg .= 'For FEMALE candidates date of birth must be 1st August 1994 or more';
            }else{

                $category = Basehelper::getCategory($data['reservation_code']);
                if($category == 'GENERAL'){
                    $limit_date = '01-08-1997';
                    $msg .= 'For GENERAL category candidates date of birth must be 1st August <strong>1997</strong> or more';
                }elseif ($category == 'OBC'){
                    $limit_date = '01-08-1994';
                    $msg .= 'For OBC category candidates date of birth must be 1st August 1994 or more';
                }elseif ($category == 'ST' || $category == 'SC' || $category == 'PD'){
                    $limit_date = '01-08-1992';
                    $msg .= 'For ST/SC/PD category candidates date of birth must be 1st August 1992 or more';
                }else
                    Log::info('UNABLE to determine AGE LIMIT');
            }
            
        }elseif ($candidateinfo->exam_id == 2) {
            // NEE - II
            $msg.='<strong>NEE-II</strong><br/>';
            if($data['gender'] == 'FEMALE'){
                $limit_date = '01-08-1989';
                $msg .= 'For FEMALE candidates date of birth must be 1st August 1989 or more';
            }else{

                $category = Basehelper::getCategory($data['reservation_code']);
                if($category == 'GENERAL'){
                    $limit_date = '01-08-1993';
                    $msg .= 'For GENERAL category candidates date of birth must be 1st August <strong>1993</strong> or more';
                }elseif ($category == 'OBC'){
                    $limit_date = '01-08-1989';
                    $msg .= 'For OBC category candidates date of birth must be 1st August 1989 or more';
                }elseif ($category == 'ST' || $category == 'SC' || $category == 'PD'){
                    $limit_date = '01-08-1988';
                    $msg .= 'For ST/SC/PD category candidates date of birth must be 1st August 1988 or more';
                }else
                    Log::info('UNABLE to determine AGE LIMIT');
            }

        }elseif ($candidateinfo->exam_id == 3) {
            // NEE - III
            $msg.='<strong>NEE-III</strong><br/>';
            if($data['gender'] == 'FEMALE'){
                $limit_date = '01-08-1973';
                $msg .= 'For FEMALE candidates date of birth must be 1st August 1973 or more';
            }else{

                $category = Basehelper::getCategory($data['reservation_code']);
                if($category == 'GENERAL'){
                    $limit_date = '01-08-1976';
                    $msg .= 'For GENERAL category candidates date of birth must be 1st August <strong>1976</strong> or more';
                }elseif ($category == 'OBC'){
                    $limit_date = '01-08-1973';
                    $msg .= 'For OBC category candidates date of birth must be 1st August 1973 or more';
                }elseif ($category == 'ST' || $category == 'SC' || $category == 'PD'){
                    $limit_date = '01-08-1971';
                    $msg .= 'For ST/SC/PD category candidates date of birth must be 1st August 1971 or more';
                }else
                    Log::info('UNABLE to determine AGE LIMIT');
            }

        }

        $limit_date = Carbon::createFromFormat($format, $limit_date);
        
        return ['status' => $dob->gte($limit_date), 'error' => $msg];
    }

    public static function getPaperCodeByInfoID($info_id)
    {
        $paper_code = '';
        $candidateinfo = CandidateInfo::find($info_id);

        if($candidateinfo->exam_id == 1)
            $paper_code = 10;
        elseif ($candidateinfo->exam_id == 2) {

            if($candidateinfo->q_id == 2)
                $paper_code = 20;
            elseif ($candidateinfo->q_id == 3) {
                $step1 = Step1::where('candidate_info_id', $info_id)->first();
                $paper_code = $step1->voc_subject; //21-28
            }elseif ($candidateinfo->q_id == 4) {
                $paper_code = 29;
            }
        }elseif ($candidateinfo->exam_id == 3) {
            $step1 = Step1::where('candidate_info_id', $info_id)->first();
            $paper_code = Branch::find($step1->branch)->pluck('paper_code');
        }

        return $paper_code;
    }

  public static function getExamName($info_id)
  {
        $info_exam_id = CandidateInfo::find($info_id)->pluck('exam_id');
        return Exam::find($info_exam_id)->pluck('exam_name');
  }

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
			if($id == 1 || $id == 2 || $id == 4 || $id == 6 ){
					//Log::info('on case 1 2 4 6');
					return ExamDetail::where('id', 1)->lists('eligible_for', 'id')->all();
			}elseif ($id == 3 || $id == 5 ) {
					//Log::info('on case 3 5');
					return ExamDetail::where('id', 2)->lists('eligible_for', 'id')->all();
			}elseif ($id == 7) {
					//Log::info('on case 7');
					return ExamDetail::where('id', 3)->lists('eligible_for', 'id')->all();
			}elseif ($id == 8) {
				//Log::info('on case 8');
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

        $ID="nerist";
        $Password="nerist";
        $Sid="NERIST";
        $url = "http://t.onetouchsms.in/sendsms.jsp?user=".$ID."&password=".$Password."&mobiles=".$mobile."&sms=".$Text."&senderid=".$Sid;
        $ch=curl_init();
        //curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, 2);
        curl_exec($ch);
        curl_close($ch);
    }

    public static function getResponseDescription($responseCode) {

    switch ($responseCode) {
        case "0" : $result = "Transaction Successful"; break;
        case "?" : $result = "Transaction status is unknown"; break;
        case "1" : $result = "Unknown Error"; break;
        case "2" : $result = "Bank Declined Transaction"; break;
        case "3" : $result = "No Reply from Bank"; break;
        case "4" : $result = "Expired Card"; break;
        case "5" : $result = "Insufficient funds"; break;
        case "6" : $result = "Error Communicating with Bank"; break;
        case "7" : $result = "Payment Server System Error"; break;
        case "8" : $result = "Transaction Type Not Supported"; break;
        case "9" : $result = "Bank declined transaction (Do not contact Bank)"; break;
        case "A" : $result = "Transaction Aborted"; break;
        case "C" : $result = "Transaction Cancelled"; break;
        case "D" : $result = "Deferred transaction has been received and is awaiting processing"; break;
        case "F" : $result = "3D Secure Authentication failed"; break;
        case "I" : $result = "Card Security Code verification failed"; break;
        case "L" : $result = "Shopping Transaction Locked (Please try the transaction again later)"; break;
        case "N" : $result = "Cardholder is not enrolled in Authentication scheme"; break;
        case "P" : $result = "Transaction has been received by the Payment Adaptor and is being processed"; break;
        case "R" : $result = "Transaction was not processed - Reached limit of retry attempts allowed"; break;
        case "S" : $result = "Duplicate SessionID (OrderInfo)"; break;
        case "T" : $result = "Address Verification Failed"; break;
        case "U" : $result = "Card Security Code Failed"; break;
        case "V" : $result = "Address Verification and Card Security Code Failed"; break;
        default  : $result = "Unable to be determined";
        }
    return $result;
    }

    public static function getPayableAmount($info_id)
    {
        $candidate_info=CandidateInfo::where('id', $info_id)->first();
        $exam_id=$candidate_info->exam_id;
        $exam=Exam::where('id', $exam_id)->first();
        $step1=Step1::where('candidate_info_id', $info_id)->first();
        $reservation=Reservation::where('reservation_code', $step1->reservation_code)->first();
        $category= $reservation->category_name;

        if($category=="GENERAL" || $category=="OBC"){
            return $exam->n_price;
        }
        else if($category=="ST" || $category=="SC" || $category=='PD'){
            return $exam->scst_price;
        }
    }

    public static function getRegistrationNo($info_id)
    {
        $candidate_info =CandidateInfo::where('id', $info_id)->first();
        $step1=Step1::where('candidate_info_id', $info_id)->first();

        $exam_id =$candidate_info->exam_id;
        $paper_code =$candidate_info->paper_code;
        $form_no =$candidate_info->form_no;
        $centre_code=$step1->c_pref1;

        return $registration_no =$exam_id.$paper_code.$centre_code.$form_no;
    }

}
