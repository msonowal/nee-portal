<?php

namespace nee_portal\Models;

use Illuminate\Database\Eloquent\Model;

class Centre extends Model
{
    protected $table= 'centres';

    protected $fillable= ['centre_code', 'centre_name', 'centre_state', 'NEE I', 'NEE II', 'NEE III'];

    public static $rules=['centre_code' => 'required|numeric|unique:centres,centre_code, :id',
    					  'centre_name' => 'required|alpha',
    					  'centre_state'=> 'required|alpha'  		
    						];

    public static $edit_rules=['centre_name' => 'required|alpha',
    					  'centre_state'=> 'required|alpha'  		
    						];						
}
