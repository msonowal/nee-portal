<?php

namespace nee_portal\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table='orders';
    protected $guarded=['id'];
    
    protected $fillable=['candidate_info_id', 'mobile_no', 'email', 'trans_type', 'order_id', 'order_info', 'amount', 'response_code', 'description', 'message', 'receipt_no', 'tansaction_id', 'bank_id', 'card_type', 'status'];
}
