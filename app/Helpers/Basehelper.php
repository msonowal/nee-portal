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

    
}