<?php

namespace nee_portal\Models;

use Illuminate\Database\Eloquent\Model;

class Step3 extends Model
{
    protected $table='step3';

    protected $fillable= ['candidate_info_id', 'photo', 'signature'];

    protected $guarded= ['id'];

    public static $rules=[
    					'photo' => 'required|mimes:jpeg,jpg|max:20000',
    					'signature' => 'required|mimes:jpeg,jpg|max:20000',
    					];
}
