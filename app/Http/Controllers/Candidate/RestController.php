<?php

namespace nee_portal\Http\Controllers\Candidate;

use Illuminate\Http\Request;

use nee_portal\Http\Requests;
use nee_portal\Http\Controllers\Controller;
use nee_portal\Models\Exam;

class RestController extends Controller
{
    public function getExamList(Request $request)
    {
            $id = $request->q_id;

            return Exam::where('q_id', $id)->get();
    }
}
