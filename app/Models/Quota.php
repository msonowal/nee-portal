<?php

namespace nee_portal\Models;

use Illuminate\Database\Eloquent\Model;

class Quota extends Model
{
    protected $table='quotas';

    protected $fillable= ['name'];

    protected $guarded= ['id'];

    public static $rules=['name' => 'required'];
}
