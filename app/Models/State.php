<?php

namespace nee_portal\Models;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    protected $table= 'states';

    protected $fillable= ['state_name'];
}
