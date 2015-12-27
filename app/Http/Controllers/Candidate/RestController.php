<?php

namespace nee_portal\Http\Controllers\Candidate;

use Illuminate\Http\Request;

use nee_portal\Http\Requests;
use nee_portal\Http\Controllers\Controller;
use nee_portal\Models\ExamQualification;
use nee_portal\Models\Reservation;
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

            return Reservation::where('quota_id', $id)->get();
    }

    public function getDistrictList(Request $request)
    {
            $id = $request->state_id;

            return DB::table('districts')->where('state_id', $id)->get();
    }

    

}
