<?php

namespace nee_portal\Http\Controllers\Candidate;

use Illuminate\Http\Request;

use nee_portal\Http\Requests;
use nee_portal\Http\Controllers\Controller;
use Kris\LaravelFormBuilder\FormBuilder;
use Validator, Basehelper, DB;
use nee_portal\Models\Step1;
use nee_portal\Models\Step2;
use nee_portal\Models\Step3;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Session, Auth;
use nee_portal\Models\CandidateInfo;

class RegistrationController extends Controller
{
    public function __construct(formBuilder $formBuilder) {

        $this->info_id = Session::get('candidate_info_id');
        $this->formBuilder = $formBuilder;
    }
    
    private $content = 'candidate.application.';

    public function getStep(){

        try {

            $candidate_info = CandidateInfo::where('id', $this->info_id)->firstOrFail();

        } catch(ModelNotFoundException $e) {

            return back()->with('message', 'Record Not Found!');
        }

        $reg_status = $candidate_info->reg_status;
        $step1 = Step1::where('candidate_info_id', $this->info_id)->get();
        $step2 = Step2::where('candidate_info_id', $this->info_id)->get();
        $step3 = Step3::where('candidate_info_id', $this->info_id)->get();

        if($reg_status=="not_submitted"){

            if($step1->count()==0){
                return redirect()->route($this->content.'step1');
            }        
            elseif($step2->count()==0){
                return redirect()->route($this->content.'step2');
            }
            elseif($step3->count()==0){
                return redirect()->route($this->content.'step3');
            }
            else{
                return redirect()->route($this->content.'final');
            }
        }
    }

    public function showStep1()
    {
        $form=$this->formBuilder->create('nee_portal\Forms\Step1',

            ['method' =>'POST',

             'url'    => route($this->content.'step1')

            ])->remove('update');

        return view($this->content.'step1', compact('form'));
    }

    public function saveStep1(Request $request)
    {

        $validator = Validator::make($data =$request->all(), Step1::$rules);

        if ($validator->fails())
        {
            return back()->withErrors($validator)->withInput();

        } else {

        DB::beginTransaction();

        $step1 = Step1::where('candidate_info_id', $this->info_id)->get();

            if($step1->count()!=0){

                return $this->getStep();               

            } else {
                    $data = ['candidate_info_id' => $this->info_id] + $request->all();
                    $step1_data = new Step1;
                    $step1_data->fill($data);

                    if (!$step1_data->save())
                    {
                        return back()->withInput()->with('message', 'Error Storing your data, Please contact Technical Support');
                    }

                    DB::commit();
                    return $this->getStep();
            }

        }

    }

    public function showStep2()
    {
        $form=$this->formBuilder->create('nee_portal\Forms\Step2',

            ['method' =>'POST',

             'url'    => route($this->content.'step2')

            ])->remove('update');

        return view($this->content.'step2', compact('form'));
    }


    public function saveStep2(Request $request)
    {
        $validator = Validator::make($data =$request->all(), Step2::$rules);

        if ($validator->fails())
        {
            return back()->withErrors($validator)->withInput();

        } else {

        DB::beginTransaction();

        $step2 = Step2::where('candidate_info_id', $this->info_id)->get();

            if($step2->count()!=0){

                return $this->getStep();               

            } else {
                    $data = ['candidate_info_id' => $this->info_id] + $request->all();
                    $step2_data = new Step2;
                    $step2_data->fill($data);

                    if (!$step2_data->save())
                    {
                        return back()->withInput()->with('message', 'Error Storing your data, Please contact Technical Support');
                    }

                    DB::commit();
                    return $this->getStep();
            }

        }

    }

    public function showStep3()
    {
        return view($this->content.'step3');
    }

    public function saveStep3(Request $request)
    {
        $validator = Validator::make($data = $request->all(), Step3::$rules);

        if($validator ->fails())
            return back()->withErrors($validator);

        $candidate_info = CandidateInfo::where('id', $this->info_id)->firstOrFail();

        $formNo= $candidate_info->form_no;

        $destinationPath = storage_path('candidates/'.$formNo);

        $data['candidate_info_id'] = $this->info_id;

        if($request->hasFile('photo'))
        {
            if($request->file('photo')->isValid()){
                $extention = $request->file('photo')->getClientOriginalExtension();
                $fileName = 'photo.'.$extention;
                $request->file('photo')->move($destinationPath, $fileName);                      
                $data['photo'] = 'candidates/'.$formNo.'/'.$fileName;


            }
        }

        if($request->hasFile('signature'))
        {
            if($request->file('signature')->isValid()){
                $extention = $request->file('signature')->getClientOriginalExtension();
                $fileName = 'signature.'.$extention;
                $request->file('signature')->move($destinationPath, $fileName);                      
                $data['signature'] = 'candidates/'.$formNo.'/'.$fileName;


            }
        }

        $insert=Step3::create($data);

        return $this->getStep();
    }

    public function showFinal()
    {
        try{

            $step1 = Step1::where('candidate_info_id', $this->info_id)->firstOrFail();
            $step2 = Step2::where('candidate_info_id', $this->info_id)->firstOrFail();
            $step3 = Step3::where('candidate_info_id', $this->info_id)->firstOrFail();
        }
        catch(ModelNotFoundException $e){

            return $this->getStep();

        }
        
        $step1->quota= Basehelper::getQuota($step1->quota);
        $step1->c_pref1= Basehelper::getCentre($step1->c_pref1);
        $step1->c_pref2= Basehelper::getCentre($step1->c_pref2);
        $step1->branch= Basehelper::getBranch($step1->branch);
        $step1->allied_branch= Basehelper::getAlliedBranch($step1->allied_branch);
        $step1->reservation_code= Basehelper::getReservationCode($step1->reservation_code);

        return view($this->content.'final', compact('step1', 'step2', 'step3'));
    }

    public function editStep1(){

        $step1 = Step1::where('candidate_info_id', $this->info_id)->first();

        if($step1->count()==0)
        {
            return $this->getStep();
        }        

        $form=$this->formBuilder->create('nee_portal\Forms\Step1',

            ['method' =>'POST',

             'url'    => route($this->content.'editstep1'),

             'model' => $step1,

            ])->remove('save');

        return view($this->content.'edit_step1', compact('form', 'step1'));    

    }  

    public function updateStep1(Request $request){

        try {

            $step1 = Step1::where('candidate_info_id', $this->info_id)->firstOrFail();

        }catch(ModelNotFoundException $e) {

            return back()->with('message', 'Record Not Found!');
        }

        if($step1->count()!=1) {

            return $this->getStep();               

        } else {

            $validator = Validator::make($data = $request->all(), Step1::$rules);

            if ($validator->fails())
            {
                return back()->withErrors($validator)->withInput();
                
            }else{

                $step1->fill($data);

                if (!$step1->save())
                {
                    return back()->withInput()->with('message', 'Error Storing your data, Please contact Technical Support');
                }
                
                return $this->getStep();           
            }
        }
    }   

}
