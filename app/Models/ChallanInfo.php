<?php

namespace nee_portal\Models;

use Illuminate\Database\Eloquent\Model;

class ChallanInfo extends Model
{
   protected $table = 'challan_info';

   protected $fillable= ['candidate_info_id', 'transaction_id', 'transaction_date'];

   protected $guarded = ['id'];

   public static $rules =[
   			'transaction_id' => 'required',
   			'transaction_date' => 'required|date_format:d-m-Y'
   	];
}
