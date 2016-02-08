<?php

namespace nee_portal\Http\Controllers\Auth;

use Validator;
use nee_portal\models\AdminUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use nee_portal\Http\Controllers\Controller;

class AdminAuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */
    private $content ='admin.layouts.';
    protected $username = 'username';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */

    protected $loginPath = 'admin/login';
    protected $redirectPath = 'admin/dashboard';

    public function __construct()
    {
        $this->middleware('guest.admin', ['except' => 'getLogout']);
    }

    public function getLogin(){

        return view($this->content.'login');
    }

    //PostLogin
    public function postLogin(Request $request){

        $this->validate($request, ['username' => 'required', 'password' => 'required']);

        $auth = Auth::admin()->attempt(['username' => $request->get('username'),'password' => $request->get('password'), 'active' => 'YES']);

        if(!$auth){
            return redirect($this->loginPath)->withErrors('Either user name or password is incorrect!');
            
        }

        $first_name = Auth::admin()->get()->first_name;

        Session::put('first_name', $first_name);

        return redirect()->route('admin.dashboard');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'email|max:255|unique:users',
            'username' => 'required|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */

    public function getLogout(){

        Auth::admin()->logout();
        return redirect()->route('admin.login');
    }
}
