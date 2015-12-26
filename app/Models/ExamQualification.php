<?php

namespace nee_portal\Models;

use Illuminate\Database\Eloquent\Model;

class ExamQualification extends Model
{
    protected $table='exam_qualifications';

    protected $guarded=['id'];

    protected $fillable=['q_id','exam_id'];
}
