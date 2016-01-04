<?php

namespace nee_portal\Http\Controllers\Candidate;

use Illuminate\Http\Request;

use nee_portal\Http\Requests;
use nee_portal\Http\Controllers\Controller;
use nee_portal\Models\ExamQualification;
use nee_portal\Models\Reservation;
use nee_portal\Models\AlliedBranch;
use nee_portal\Models\Quota;
use DB;

class RestController extends Controller
{
    public function getExamList(Request $request)
    {
            $id = $request->q_id;
            return ExamQualification::join('exams', 'exam_qualifications.exam_id', '=', 'exams.id')
            						->where('exam_qualifications.q_id', $id)->get();
    }

    public function getReservationCode(Request $request)
    {
            $id = $request->quota;
            return Reservation::with('quota')->where('quota_id', $id)->get();
    }

    public function getDistrictList(Request $request)
    {
        $id = $request->state_id;
        return DB::table('districts')->where('state_id', $id)->get();
    }

    public function getAlliedBranch(Request $request)
    {
      return AlliedBranch::where('branch_id', $request->branch_id)->get();
    }



}
