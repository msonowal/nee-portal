<?php
namespace nee_portal\Helpers;

use nee_portal\Models\Centre;
use nee_portal\Models\Quota;
use nee_portal\Models\Exam;
use nee_portal\Models\Qualification;
use nee_portal\Models\Branch;

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