<?php

namespace nee_portal\Http\Controllers\Auth;

use nee_portal\models\Candidate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use nee_portal\Http\Controllers\Controller;
use Kris\LaravelFormBuilder\FormBuilder;
use Validator, Redirect, Hash, Mail, Basehelper;
use nee_portal\Models\CandidateInfo;
class CandidateAuthController extends Controller
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

    private $content ='candidate.';
    protected $email = 'email';
    //use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */

    protected $loginPath = 'candidate/login';
    protected $redirectPath = 'candidate/home';

    public function __construct()
    {
        $this->middleware('guest.candidate', ['except' => 'getLogout']);
    }

    public function getRegister(){
        return view('candidate.register');
    }

    public function postRegister(Request $request){

        $validator = Validator::make($request->all(), Candidate::$rules);

        if ($validator->fails()) {

            return Redirect::back()
                        ->withInput()->withErrors($validator);
        }

        $confirmation_code = rand(200000 , 900000);

        $data=[ 'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'password'  => Hash::make($request->password),
                'mobile_no' => $request->mobile_no,
                'email' => $request->email,
                'confirm_code' => $confirmation_code
        ];

        $candidate = Candidate::create($data);
        $message = 'Hello '.$request->first_name.', you have registered for NEE Online. Your OTP is '.$confirmation_code.' .Your email is '.$request->email.' and password is '.$request->password;
        $data['password'] = $request->password;

        Mail::send('emails.verify', $data, function($message) use ($candidate, $data){
                $message->from('neeonline@neeonline.ac.in', 'NEE Online Application Portal');
                $message->to($candidate->email, $candidate->first_name)
                    ->subject('NEE Online Account Created');
        });

        $message = 'Hello '.$request->first_name.', you have registered for NEE Online. Your OTP is '.$confirmation_code.' .Your email is '.$request->email.' and password is '.$request->password;

        Basehelper::sendSMS($request->mobile_no, $message);
        //return Redirect::route($this->content.'register')->with('message', 'Registered Successfully. Please Activate your A/C by OTP Activation link');
        return Redirect::route($this->content.'otp.activate')
                ->withInput()
                ->with('message', 'Your account has been Registered Successfully,<br/> however you must activate your A/C by providing the OTP that you have recieved via SMS after that only you can login ');
    }

    public function getLogin(formBuilder $formBuilder)
    {
        $form = $formBuilder->create('nee_portal\Forms\CandidateLogin', [
                'method' =>'POST',
                'url'    => route($this->content.'login'),
                'class' =>  'col s12'
                ]);

        return view($this->content.'login', compact('form'));
    }

    //PostLogin
    public function postLogin(Request $request){

        $this->validate($request, ['email' => 'required', 'password' => 'required']);

        $auth = Auth::candidate()->attempt(['email' => $request->get('email'),'password' => $request->get('password'), 'status' => '0']);

        if(!$auth){
            return Redirect::back()->withInput()->withErrors(['Either Email or Password is Incorrect!']);
        }

        $first_name = Auth::candidate()->get()->first_name;

        Session::put('first_name', $first_name);

        $id = Auth::candidate()->get()->id;

        $applied = CandidateInfo::where('candidate_id', $id)->get()->count();

        if($applied==0)
            return redirect()->route($this->content.'home')->with('message', 'Please Select an Exam to Apply');
        else
            return redirect()->route($this->content.'application.dashboard')->with('message', 'Click on the exam to continue Online Application Process');

    }

    public function showOTP()
    {
        return view('candidate.otp_activate');
    }

    public function activateOTP(Request $request)
    {
        if($request->has('mobile_no') || $request->has('otp')){

          $messages = ['mobile_no.exists' => 'Mobile No Does not exists in our System'];
          $validator = Validator::make($data = $request->all(), ['mobile_no'=>'exists:candidates,mobile_no'], $messages);

          if ($validator->fails())
            return redirect::back()->withErrors($validator)->withInput();

          $candidate = Candidate::where('mobile_no', $request->mobile_no)->first();

          if( $candidate->status == 1)
            return redirect('candidate.login')->with('message', 'Your account is already activated. <br>You can Login with your email and password');

          if($request->otp == $candidate->confirm_code){
              $candidate->status = 1;
              $candidate->confirm_code = NULL;
              $candidate->save();
              return redirect()->route('candidate.login')->with('message', 'Your account is activated <br>Now Login with your email and password');
          }else
            return redirect::back()->withInput()->with('message', 'The OTP Doesnot match!.');
        }

        return View::make('layouts.student.otp_activate');
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

        Auth::candidate()->logout();
        return Redirect::route('candidate.login');
    }
}
