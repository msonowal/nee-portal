<?php

namespace nee_portal\Models;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    protected $table= 'districts';

    protected $fillable= ['state_id','name'];
    public $timestamps = false;
}
