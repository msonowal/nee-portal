<?php

namespace nee_portal\Models;

use Illuminate\Database\Eloquent\Model;

class Step1 extends Model
{
   	protected $table='step1';

    protected $fillable= ['candidate_info_id', 'quota', 'c_pref1', 'c_pref2', 'dob', 'nerist_stud', 'status', 'admission_in', 'voc_subject', 'branch', 'allied_branch', 'reservation_code'];

    protected $guarded= ['id'];

    public static $rules=[
    				'quota' => 'required|numeric',
    				'c_pref1' => 'required|numeric',
    				'c_pref2' => 'required|numeric',
                    'dob' => 'required|date_format:d-m-Y',
    				'nerist_stud' => 'required',
    				'status' => 'required',
    				'admission_in' => 'required|numeric',
    				'reservation_code' => 'required|numeric'
    				];
}
