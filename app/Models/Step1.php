<?php

namespace nee_portal\Models;

use Illuminate\Database\Eloquent\Model;

class Step1 extends Model
{
   	protected $table='step1';

    protected $fillable= ['candidate_info_id', 'quota', 'c_pref1', 'c_pref2', 'dob', 'nerist_stud', 'status', 'admission_in', 'voc_subject', 'branch', 'allied_branch', 'reservation_code', 'gender'];

    protected $guarded= ['id'];

    protected function setDobAttribute($value) {
        $this->attributes['dob'] = date('Y-m-d', strtotime($value));
    }

    protected function getDobAttribute($value) {
      return $this->attributes['dob'] = date('d-m-Y', strtotime($value) );
    }


}
