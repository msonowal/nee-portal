<?php

namespace nee_portal\Models;

use Illuminate\Database\Eloquent\Model;

class CentreCapacity extends Model
{
    protected $table= 'centre_capacities';

    protected $fillable= ['centre_id', 'centre_location', 'centre_capacity'];

    public static $rules=['centre_id' => 'required|numeric',
    					  'centre_location' =>'required',
    					  'centre_capacity' =>'required|numeric'	
    						];
}
 