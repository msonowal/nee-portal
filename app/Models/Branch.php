<?php

namespace nee_portal\Models;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    protected $table ='branches';

    protected $fillable =['branch_name'];

    public static $rules= ['branch_name' =>'required'];
}
