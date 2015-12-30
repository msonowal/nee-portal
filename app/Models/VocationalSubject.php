<?php

namespace nee_portal\Models;

use Illuminate\Database\Eloquent\Model;

class VocationalSubject extends Model
{
    protected $table ='vocational_subjects';

    protected $fillable =['name', 'paper_code'];

    public static $rules= ['name' =>'required', 'paper_code' => 'required'];
}
