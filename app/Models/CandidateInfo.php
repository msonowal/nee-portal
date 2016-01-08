<?php

namespace nee_portal\Models;

use Illuminate\Database\Eloquent\Model;

class CandidateInfo extends Model
{
    protected $table = 'candidate_info';

    protected $guarded = ['id'];

    //protected $fillable = [''];

    public static $rules = [
    					'q_id' =>'required',
    					'exam_id' => 'required',
    					'qualification_status' => 'required'
    				];

    public static $messages = [
		'q_id.required'			=>  'Qualification field is required',
		'qualification_status.required'      =>  'Qualification status is required',
		'exam_id.required'      =>  'Exam field is required',
    ];
}
