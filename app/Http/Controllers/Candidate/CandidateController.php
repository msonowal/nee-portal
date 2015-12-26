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

            $msg = 'Dear '.Basehelper::getCandidate($id).', you have choosen '.Basehelper::getExam($request->exam_id).'<br> Please continue with the Form Submission Process by clicking on the right side of the listed exams!';
            return Redirect::route($this->content.'dashboard')->with('message', $msg);

        else :

            return Redirect::route('candidate.home')->withErrors(array('message'=>'Dear '.Basehelper::getCandidate($id).', you have already applied for '.Basehelper::getExam($request->exam_id)));

        endif;                        
    }

    public function dashboard()
    {
        $id = Auth::candidate()->get()->id;

        $exams = CandidateInfo::join('exams', 'exams.id', '=', 'candidate_info.id')->where('candidate_id', $id)->get();

        return view($this->content.'dashboard', compact('exams'));
    }

    public function step()
    {
        $id = Auth::candidate()->get()->id;
    }


    public function showStep1()
    {
        $form=$this->formBuilder->create('nee_portal\Forms\Step1',

            ['method' =>'POST',

             'url'    => route($this->content.'step1')

            ])->remove('update');

        return view($this->content.'step1', compact('form'));
    }

    public function showStep2()
    {
        $form=$this->formBuilder->create('nee_portal\Forms\Step2',

            ['method' =>'POST',

             'url'    => route($this->content.'step2')

            ])->remove('update');

        return view($this->content.'step2', compact('form'));
    }

}
