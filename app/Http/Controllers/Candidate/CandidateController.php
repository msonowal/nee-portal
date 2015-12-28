<?php

namespace nee_portal\Http\Controllers\Candidate;

use Illuminate\Http\Request;

use nee_portal\Http\Requests;
use nee_portal\Models\Candidate;
use nee_portal\Models\CandidateInfo;
use nee_portal\Http\Controllers\Controller;
use Auth, Redirect;
use Kris\LaravelFormBuilder\FormBuilder;
use Validator, Basehelper;
use nee_portal\Models\Step1;
use nee_portal\Models\Step2;
use Session;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CandidateController extends Controller
{
    public function __construct(formBuilder $formBuilder) {

        $this->formBuilder = $formBuilder;
    }

    private $content = 'candidate.application.';

    public function home()
    {
        $form=$this->formBuilder->create('nee_portal\Forms\Home',

            ['method' =>'POST',

             'url'    => route('candidate.home')

            ]);

        return view($this->content.'home', compact('form'));
    }


    public function storeExam(Request $request)
    {
        $id = Auth::candidate()->get()->id;

        $validator = Validator::make($data = $request->all(), CandidateInfo::$rules);

        if ($validator->fails())
            return Redirect::back()->withErrors($validator)
                            ->withInput();

        $count = CandidateInfo::where('exam_id', $request->exam_id)
                                ->where('candidate_id', $id)->get();
        if(!$count->count()) :

            $candidateinfo = new CandidateInfo();
            $candidateinfo->candidate_id = $id;
            $candidateinfo->q_id = $request->q_id;
            $candidateinfo->exam_id = $request->exam_id;
            $candidateinfo->form_no = Basehelper::getFormNo(CandidateInfo::max('id')+1);
            $candidateinfo->reg_date = date('Y-m-d');

            if(!$candidateinfo->save())
                return Redirect::back()->with('message', 'Unable to Save your Registration data <br> Contact Technical Support!');

            $msg = 'Dear '.Basehelper::getCandidate($id).', you have choosen '.Basehelper::getExam($request->exam_id).'<br> Please continue with the Form Submission Process by clicking on the listed exams!';
            return Redirect::route($this->content.'dashboard')->with('message', $msg);

        else :

            return Redirect::route('candidate.home')->withErrors(array('message'=>'Dear '.Basehelper::getCandidate($id).', you have already applied for '.Basehelper::getExam($request->exam_id).'. Click on Dashboard Link to Continue...'));

        endif;
    }

    public function dashboard()
    {
        $id = Auth::candidate()->get()->id;

        $exams = CandidateInfo::join('exams', 'exams.id', '=', 'candidate_info.exam_id')
                ->where('candidate_id', $id)
                ->select('candidate_info.id', 'exams.exam_name', 'exams.description')->get();

        return view($this->content.'dashboard', compact('exams'));
    }

    public function proceed(Request $request)
    {
        $id = Auth::candidate()->get()->id;
        if( $request->has('candidate_info_id') ){

          $infos = CandidateInfo::where('candidate_id', $id)->lists('id')->toArray();

          if(in_array($request->has('candidate_info_id'), $infos))
          {
            Session::put('candidate_info_id', $request->candidate_info_id);
            return redirect()->action('Candidate\RegistrationController@getStep');
          }else
            return redirect()->back()->with('message', 'Invalid Application Selection');
        }else
          return redirect()->back()->with('message', 'Please select an application form to continue');
    }
}
