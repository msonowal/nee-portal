<?php

namespace nee_portal\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Step2 extends Model
{
    protected $table='step2';

    protected $fillable= ['candidate_info_id', 'name', 'father_name', 'guardian_name', 'gender', 'nationality', 'emp_status', 'relationship', 'state', 'district', 'po', 'pin', 'village', 'address_line'];

    protected $guarded= ['id'];

    protected function setNameAttribute($value){
        $this->attributes['name'] = Str::upper($value);
    }

    protected function setFatherNameAttribute($value){
        $this->attributes['father_name'] = Str::upper($value);
    }

    protected function setGuardianNameAttribute($value){
        $this->attributes['guardian_name'] = Str::upper($value);
    }

    protected function setPoAttribute($value){
        $this->attributes['po'] = Str::upper($value);
    }
    protected function setVillageAttribute($value){
        $this->attributes['village'] = Str::upper($value);
    }



}
