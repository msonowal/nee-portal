<?php

namespace nee_portal\Models;

use Illuminate\Database\Eloquent\Model;

class AlliedBranch extends Model
{
    protected $table='allied_branches';

    protected $quarded=['id'];

    protected $fillable=['branch_id', 'allied_branch'];

    public static $rules=['branch_id' => 'required|numeric',
    					  'allied_branch' =>'required',
    						];

}
