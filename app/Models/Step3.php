<?php

namespace nee_portal\Models;

use Illuminate\Database\Eloquent\Model;

class Step3 extends Model
{
    protected $table='step3';

    protected $fillable= ['candidate_info_id', 'photo', 'signature'];

    protected $guarded= ['id'];

    public static $rules=[
    					'photo' => 'required|mimes:jpeg,jpg,png|min:1|max:40',
    					'signature' => 'required|mimes:jpeg,jpg,png|min:1|max:20',
    					];


   public function getPhoto()
	{
	    if(!empty($this->photo) && \File::exists(storage_path($this->photo)))
	    {
	        // Get the filename from the full path
	        $filename = $this->photo;

	        return 'images/image.php?photo_url='.$filename;
	    }

	    return 'images/missing.jpg';
	}

	public function getSignature()
	{
	    if(!empty($this->signature) && \File::exists(storage_path($this->signature)))
	    {
	        // Get the filename from the full path
	        $filename = $this->signature;

	        return 'images/image.php?photo_url='.$filename;
	    }

	    return 'images/missing.jpg';
	}
}
