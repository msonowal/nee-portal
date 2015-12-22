<?php

namespace nee_portal\Models;

use Illuminate\Database\Eloquent\Model;

class Qualification extends Model
{
    protected $table='qualifications';

    protected $fillable=['qualification', 'NEE_I', 'NEE_II', 'NEE_III'];

    protected $guarded=['id'];
}
