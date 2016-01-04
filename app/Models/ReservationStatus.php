<?php

namespace nee_portal\Models;

use Illuminate\Database\Eloquent\Model;

class ReservationStatus extends Model
{
    protected $table= 'reservation_status';

    protected $fillable= ['reservation_code', 'exam_id', 'examdetail_id'];

    protected $guarded= ['id'];

    public static $rules=[
    					  'reservation_code' => 'required|numeric',
                'exam_id' => 'required|numeric',
                //'qualification_id' => 'required|numeric',
                'examdetail_id' => 'required|numeric',
                //'status' => 'required'
    					 ];

}
