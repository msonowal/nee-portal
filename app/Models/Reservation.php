<?php

namespace nee_portal\Models;

use Illuminate\Database\Eloquent\Model;
use nee_portal\Models\Quota;

class Reservation extends Model
{
    protected $table= 'reservations';

    protected $fillable= ['quota_id', 'reservation_code', 'description'];

    protected $guarded= ['id'];

    public static $rules=['quota_id' => 'required|numeric',
    					  'reservation_code' => 'required|numeric|unique:reservations,reservation_code, :id',
    					  'description' => 'required'
    					 ];

    public static $edit_rules=['quota_id' => 'required|numeric',
    					  'description' => 'required'
    					 ];

     public function quota()
     {
         return $this->belongsTo('nee_portal\Models\Quota', 'quota_id');
     }

}
