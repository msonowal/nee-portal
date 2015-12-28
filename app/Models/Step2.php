<?php

namespace nee_portal\Models;

use Illuminate\Database\Eloquent\Model;

class Step2 extends Model
{
    protected $table='step2';

    protected $fillable= ['candidate_info_id', 'name', 'father_name', 'guardian_name', 'gender', 'nationality', 'emp_status', 'relationship', 'state', 'district', 'po', 'pin', 'village', 'address_line'];

    protected $guarded= ['id'];

    public static $rules=[
    					'name' => 'required',
    					'father_name' => 'required',
    					'guardian_name' => 'required',
    					'gender' =>'required',
    					'nationality' => 'required',
    					'emp_status' => 'required',
    					'relationship' => 'required',
    					'state' => 'required|numeric',
    					'district' => 'required',
    					'po' => 'required',
    					'pin' => 'required|digits:6|numeric',
    					'village' => 'required|max:100',
    					'address_line' => 'required|max:100'
    					];
}
