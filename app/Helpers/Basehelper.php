<?php
namespace nee_portal\Helpers;

use nee_portal\Models\Centre;
use nee_portal\Models\Quota;
use nee_portal\Models\Exam;
use nee_portal\Models\Qualification;
use nee_portal\Models\Branch;
use nee_portal\Models\Candidate;
use nee_portal\Models\AlliedBranch;
use nee_portal\Models\Reservation;
use nee_portal\Models\State;
use nee_portal\Models\District;

class Basehelper{

	public static function getCentre($id, $return = 'centre_name')
    {
        return $return = Centre::where('id', $id)->pluck($return);
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
        return $return = Reservation::where('id', $id)->pluck($return);
    }

    public static function getState($id, $return = 'name')
    {
        return $return = State::where('id', $id)->pluck($return);
    }

    public static function getDistrict($id, $return = 'name')
    {
        return $return = District::where('id', $id)->pluck($return);
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