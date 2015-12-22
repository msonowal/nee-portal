<?php

namespace nee_portal\Http\Controllers\Auth;

use Validator;
use nee_portal\models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use nee_portal\Http\Controllers\Controller;
use Kris\LaravelFormBuilder\FormBuilder;
use Redirect, Hash;
class StudentAuthController extends Controller
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
    private $content ='student.';
    protected $email = 'email';
    //use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */

    protected $loginPath = 'student/login';
    protected $redirectPath = 'student/dashboard';

    public function __construct()
    {
        $this->middleware('guest.student', ['except' => 'getLogout']);
    }

    public function getRegister(){
        return view('student.register');
    }

    public function postRegister(Request $request){

        $this->validate($request, Student::$rules);

        $data=[ 'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'password'  => Hash::make($request->password),
                'mobile_no' => $request->mobile_no,
                'email' => $request->email];

        Student::create($data);

        return Redirect::route($this->content.'register')->with('message', 'Registered Successfully. Please Activate your A/C by OTP Activation link');
    } 

    public function getLogin(formBuilder $formBuilder)
    {
        $form=$formBuilder->create('nee_portal\Forms\StudentLoginForm',

            ['method' =>'POST',

             'url'    => route($this->content.'login')

            ]);

        return view($this->content.'login', compact('form'));
    }

    //PostLogin
    public function postLogin(Request $request){

        $this->validate($request, ['email' => 'required', 'password' => 'required']);

        $auth = Auth::student()->attempt(['email' => $request->get('email'),'password' => $request->get('password'), 'status' => '1']);

        if(!$auth){
            return redirect($this->loginPath);
        }

        $first_name = Auth::student()->get()->first_name;

        Session::put('first_name', $first_name);

        return redirect()->route($this->content.'dashboard');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */

    public function getLogout(){
        Auth::student()->logout();
        return Redirect::route('student.login');
    }
}
