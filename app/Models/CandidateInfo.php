<?php

namespace nee_portal\Models;

use Illuminate\Database\Eloquent\Model;

class CandidateInfo extends Model
{
    protected $table = 'candidate_info';

    protected $guarded = ['id'];

    //protected $fillable = [''];

    public static $rules = ['q_id' =>'required', 'exam_id' => 'required'];
}
