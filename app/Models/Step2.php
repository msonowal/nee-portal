<?php

namespace nee_portal\Models;

use Illuminate\Database\Eloquent\Model;

class Step2 extends Model
{
    protected $table='step2';

    protected $fillable= ['candidate_info_id', 'name'];

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
    					'post_office' => 'required',
    					'pin' => 'required|digits:6|numeric',
    					'village_town' => 'required|max:100',
    					'address_line' => 'required|max:100'
    					];
}
