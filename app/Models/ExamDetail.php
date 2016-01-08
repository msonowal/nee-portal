<?php

namespace nee_portal\Models;

use Illuminate\Database\Eloquent\Model;

class ExamDetail extends Model
{
    protected $table='exam_details';

    protected $guarded=['id'];

    protected $fillable=['eligible_for', 'paper_code'];

    public static $rules= [
    	'eligible_for' => 'required|max:255',
        'paper_code'     => 'required|numeric|unique:exam_details,paper_code, :id',
        ];
}
