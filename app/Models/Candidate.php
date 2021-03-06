<?php

namespace nee_portal\Models;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Kbwebs\MultiAuth\PasswordResets\CanResetPassword;
use Kbwebs\MultiAuth\PasswordResets\Contracts\CanResetPassword as CanResetPasswordContract;
class Candidate extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'candidates';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['first_name', 'last_name', 'mobile_no', 'email', 'password', 'confirm_code', 'status'];
    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', '_token'];

    protected $guarded =['id', '_token'];

    public static $rules=[
    	'first_name' => 'required',
    	'last_name' => 'required',
    	'mobile_no' => 'required|digits:10|numeric|unique:candidates,mobile_no',
    	'email' => 'required|max:100|unique:candidates,email',
    	'password' => 'confirmed|required|min:6'
     	];
}
