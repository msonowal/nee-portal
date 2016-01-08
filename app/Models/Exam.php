<?php

namespace nee_portal\Models;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    protected $table = 'exams';

    protected $guarded = ['id', '_token', '_method'];

    protected $fillable = ['exam_name', 'description', 'n_price', 'scst_price', 'start_date', 'active'];

    public static $rules= [
  		//'exam_code'   => 'required|unique:exams,exam_code, :id',  
    	'exam_name'   => 'required|max:55',
    	'description' => 'required|max:255',
        'n_price'     => 'required|numeric',
        'scst_price'  => 'required|numeric',
        'start_date'  => 'required',
        'active'      => 'required|in:YES,NO',       
        ];

    public static $edit_rules= [
        'exam_name'   => 'required|max:55',
        'description' => 'required|max:255',
        'n_price'     => 'required|numeric',
        'scst_price'  => 'required|numeric',
        'start_date'  => 'required',
        'active'      => 'required|in:YES,NO',       
        ];    

}
