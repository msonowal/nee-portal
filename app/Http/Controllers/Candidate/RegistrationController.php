<?php

namespace nee_portal\Http\Controllers\Candidate;

use Illuminate\Http\Request;

use nee_portal\Http\Requests;
use nee_portal\Http\Controllers\Controller;
use Kris\LaravelFormBuilder\FormBuilder;
use Validator, Basehelper, DB, ValidationRules, Session, Auth, Storage, Log;
use nee_portal\Models\Step1;
use nee_portal\Models\Step2;
use nee_portal\Models\Step3;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use nee_portal\Models\CandidateInfo;
use nee_portal\Models\Candidate;
use nee_portal\Models\ChallanInfo;

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
        $step1 = Step1::where('candidate_info_id', $this->info_id)->first();
        $step2 = Step2::where('candidate_info_id', $this->info_id)->first();
        $step3 = Step3::where('candidate_info_id', $this->info_id)->first();

        if($reg_status=="not_submitted"){

            if(count($step1)==0){
                return redirect()->route($this->content.'step1');
            }
            elseif(count($step2)==0){
                return redirect()->route($this->content.'step2');
            }
            elseif(count($step3)==0){
                return redirect()->route($this->content.'step3');
            }
            else{
                return redirect()->route($this->content.'final');
            }
        }
        else if($reg_status=="payment_pending"){

                return redirect()->route($this->content.'payment_options');

        }
        else if($reg_status=="completed"){

                return redirect()->route($this->content.'completed');

        }
    }

    public function showStep1()
    {
        if(!Basehelper::checkSession())
            return redirect()->route($this->content.'dashboard');

        $step1 = Step1::where('candidate_info_id', $this->info_id)->first();
        $info = CandidateInfo::find($this->info_id);
        //Log::info('showstep1');

        if(count($step1)==0){

            $form=$this->formBuilder->create('nee_portal\Forms\Step1',[
              'method' =>'POST',
              'url'    => route($this->content.'step1'),
              'data'   => [
                    'eligible_for' => Basehelper::getExamDetails($info->q_id, $info->exam_id),
                    'voc_subject'  => Basehelper::getVocationalSubject($info->q_id, $info->exam_id),
                    'branch_status'  => Basehelper::getBranchFieldStatus($info->q_id, $info->exam_id),
              ]
            ])->remove('update');

            return view($this->content.'step1', compact('form'));

        }else{

            return $this->getStep();
        }


    }

    public function editStep1(){

        if(!Basehelper::checkSession())
            return redirect()->route($this->content.'dashboard');

        try {

            $info = CandidateInfo::find($this->info_id);
            $step1 = Step1::where('candidate_info_id', $this->info_id)->firstOrFail();

        }catch(ModelNotFoundException $e) {
            return $this->getStep();
        }

        $form = $this->formBuilder->create('nee_portal\Forms\Step1',[
          'method' =>'POST',
          'url'    => route($this->content.'editstep1'),
          'data'   => [
              'eligible_for' => Basehelper::getExamDetails($info->q_id, $info->exam_id),
              'voc_subject'  => Basehelper::getVocationalSubject($info->q_id, $info->exam_id),
              'branch_status'  => Basehelper::getBranchFieldStatus($info->q_id, $info->exam_id),
          ],
          'model' => $step1,
        ])->remove('save');

        return view($this->content.'step1_edit', compact('form', 'step1'));

    }

    public function saveStep1(Request $request)
    {

        $validator = Validator::make($data =$request->all(), ValidationRules::step1_save());

        if ($validator->fails())
            return back()->withErrors($validator)->withInput();

        $step1 = Step1::where('candidate_info_id', $this->info_id)->first();

            if(count($step1)!=0){

                return $this->getStep();

            } else {
                    $data = ['candidate_info_id' => $this->info_id] + $request->all();
                    $step1_data = new Step1;
                    $step1_data->fill($data);

                    if (!$step1_data->save())
                    {
                        return back()->withInput()->with('message', 'Error Storing your data, Please contact Technical Support');
                    }

                    return $this->getStep();
            }
    }

    public function showStep2()
    {
        if(!Basehelper::checkSession())
            return redirect()->route($this->content.'dashboard');

        $step1 = Step1::where('candidate_info_id', $this->info_id)->first();
        $step2 = Step2::where('candidate_info_id', $this->info_id)->first();

        if(count($step1)!=0 && count($step2)==0){

            $form=$this->formBuilder->create('nee_portal\Forms\Step2',[
                'method' =>'POST',
                'url'    => route($this->content.'step2')
            ])->remove('update');

            return view($this->content.'step2', compact('form'));

        }else
            return $this->getStep();
    }


    public function saveStep2(Request $request)
    {
        $validator = Validator::make($data =$request->all(), ValidationRules::step2_save());

        if ($validator->fails())
        {
            return back()->withErrors($validator)->withInput();

        } else {

        $step2 = Step2::where('candidate_info_id', $this->info_id)->first();

            if(count($step2)!=0){

                return $this->getStep();

            } else {
                    $data = ['candidate_info_id' => $this->info_id] + $request->all();
                    $step2_data = new Step2;
                    $step2_data->fill($data);

                    if (!$step2_data->save())
                    {
                        return back()->withInput()->with('message', 'Error Storing your data, Please contact Technical Support');
                    }

                    return $this->getStep();
            }

        }

    }

    public function showStep3()
    {
        if(!Basehelper::checkSession())
            return redirect()->route($this->content.'dashboard');

        $step1 = Step1::where('candidate_info_id', $this->info_id)->first();
        $step2 = Step2::where('candidate_info_id', $this->info_id)->first();
        $step3 = Step3::where('candidate_info_id', $this->info_id)->first();

        if(count($step1)!=0 && count($step2)!=0 && count($step3)==0){

            return view($this->content.'step3');

        }else{

            return $this->getStep();
        }


    }

    public function saveStep3(Request $request)
    {
        $step3 = Step3::where('candidate_info_id', $this->info_id)->first();

        if(count($step3)!=0){

            return $this->getStep();
        }

        $validator = Validator::make($data = $request->all(), ValidationRules::step3_save());

        if($validator ->fails())
            return back()->withErrors($validator);

        $destinationPath = storage_path('candidates/'.$this->info_id);

        $data['candidate_info_id'] = $this->info_id;

        if($request->hasFile('photo'))
        {
            if($request->file('photo')->isValid()){
                $extention = $request->file('photo')->getClientOriginalExtension();
                $fileName = 'photo.'.$extention;
                $request->file('photo')->move($destinationPath, $fileName);
                $data['photo'] = 'candidates/'.$this->info_id.'/'.$fileName;


            }
        }

        if($request->hasFile('signature'))
        {
            if($request->file('signature')->isValid()){
                $extention = $request->file('signature')->getClientOriginalExtension();
                $fileName = 'signature.'.$extention;
                $request->file('signature')->move($destinationPath, $fileName);
                $data['signature'] = 'candidates/'.$this->info_id.'/'.$fileName;


            }
        }

        $insert=Step3::create($data);

        return $this->getStep();
    }

    public function showFinal()
    {
        if(!Basehelper::checkSession())
            return redirect()->route($this->content.'dashboard');

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
        $step1->admission_in= Basehelper::getAdmissionIn($step1->admission_in);
        $step1->branch= Basehelper::getBranch($step1->branch);
        $step1->allied_branch= Basehelper::getAlliedBranch($step1->allied_branch);
        //$step1->reservation_code= Basehelper::getReservationCode($step1->reservation_code);

        $step2->state= Basehelper::getState($step2->state);
        $step2->district= Basehelper::getDistrict($step2->district);
        $candidate_info=CandidateInfo::where('id', $this->info_id)->first();
        $candidate_info->exam_id= Basehelper::getExam($candidate_info->exam_id);

        if($step1->branch == NULL)
            $step1->branch = 'NA';

        if($step1->allied_branch == NULL)
            $step1->allied_branch = 'NA';

        if($step1->voc_subject == NULL)
            $step1->voc_subject = 'NA';

        return view($this->content.'final', compact('step1', 'step2', 'step3', 'candidate_info'));
    }

    public function updateStep1(Request $request){

        try {

            $step1 = Step1::where('candidate_info_id', $this->info_id)->firstOrFail();

        }catch(ModelNotFoundException $e) {

            return back()->with('message', 'Record Not Found!');
        }

        if(count($step1)!=1) {

            return $this->getStep();

        } else {

            $validator = Validator::make($data = $request->all(), ValidationRules::step1_save());

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

    public function editStep2(){

        if(!Basehelper::checkSession())
            return redirect()->route($this->content.'dashboard');

        try {

            $step2 = Step2::where('candidate_info_id', $this->info_id)->firstOrFail();

        }catch(ModelNotFoundException $e) {

            return $this->getStep();
        }

        $form=$this->formBuilder->create('nee_portal\Forms\Step2',

            ['method' =>'POST',

             'url'    => route($this->content.'editstep2'),

             'model' => $step2,

            ])->remove('save');

        return view($this->content.'step2_edit', compact('form', 'step2'));

    }

    public function updateStep2(Request $request){

        try {

            $step2 = Step2::where('candidate_info_id', $this->info_id)->first();

        }catch(ModelNotFoundException $e) {

            return back()->with('message', 'Record Not Found!');
        }

        if(count($step2)!=1) {

            return $this->getStep();

        } else {

            $validator = Validator::make($data = $request->all(), ValidationRules::step2_save());

            if ($validator->fails())
            {
                return back()->withErrors($validator)->withInput();

            }else{

                $step2->fill($data);

                if (!$step2->save())
                {
                    return back()->withInput()->with('message', 'Error Storing your data, Please contact Technical Support');
                }

                return $this->getStep();
            }
        }
    }

    public function editStep3()
    {
        if(!Basehelper::checkSession())
            return redirect()->route($this->content.'dashboard');

        try {

            $step3 = Step3::where('candidate_info_id', $this->info_id)->firstOrFail();

        }catch(ModelNotFoundException $e) {
            return $this->getStep();
        }

        return view($this->content.'step3_edit', compact('step3'));
    }

    public function updateStep3(Request $request)
    {
        try{
                $step3 = Step3::where('candidate_info_id', $this->info_id)->first();
        }catch(ModelNotFoundException $e){

            return $this->getStep();
        }

        $destinationPath = storage_path('candidates/'.$this->info_id);

        $data['candidate_info_id'] = $this->info_id;

        if($request->hasFile('photo'))
        {
            if($request->file('photo')->isValid()){
                $extention = $request->file('photo')->getClientOriginalExtension();
                $fileName = 'photo.'.$extention;
                $request->file('photo')->move($destinationPath, $fileName);
                $data['photo'] = 'candidates/'.$this->info_id.'/'.$fileName;
            }
        }

        if($request->hasFile('signature'))
        {
            if($request->file('signature')->isValid()){
                $extention = $request->file('signature')->getClientOriginalExtension();
                $fileName = 'signature.'.$extention;
                $request->file('signature')->move($destinationPath, $fileName);
                $data['signature'] = 'candidates/'.$this->info_id.'/'.$fileName;
            }
        }

        $update= $step3->fill($data);

        return $this->getStep();
    }

    public function finalSubmit(){

        if(!Basehelper::checkSession())
            return redirect()->route($this->content.'dashboard');

        try{

            $step1 = Step1::where('candidate_info_id', $this->info_id)->first();
            $step2 = Step2::where('candidate_info_id', $this->info_id)->first();
            $step3 = Step3::where('candidate_info_id', $this->info_id)->first();
        }
        catch(ModelNotFoundException $e){

            return $this->getStep();

        }

        $candidate_info=CandidateInfo::where('id', $this->info_id)->first();

        $candidate_info->reg_status='payment_pending';

        $candidate_info->save();

        return $this->getStep();

    }


    public function paymentOptions(){

        if(!Basehelper::checkSession())
            return redirect()->route($this->content.'dashboard');

        try{
            $candidate_info=CandidateInfo::where('id', $this->info_id)->first();
            $step1 = Step1::where('candidate_info_id', $this->info_id)->first();
            $step2 = Step2::where('candidate_info_id', $this->info_id)->first();
            $step3 = Step3::where('candidate_info_id', $this->info_id)->first();
        }catch(ModelNotFoundException $e){

            return redirect()->route('candidate.error')->withErrors('Record not found!');
        }

        if($candidate_info->reg_status=="payment_pending"){

            return view($this->content.'payment_options');
        }

        return $this->getStep();

    }

    public function paymentProceed(Request $request){

        if(!Basehelper::checkSession())
            return redirect()->route($this->content.'dashboard');

        try{
            $candidate_info=CandidateInfo::where('id', $this->info_id)->first();
            $step1 = Step1::where('candidate_info_id', $this->info_id)->first();
            $step2 = Step2::where('candidate_info_id', $this->info_id)->first();
            $step3 = Step3::where('candidate_info_id', $this->info_id)->first();
        }catch(ModelNotFoundException $e){

            return redirect()->route('candidate.error')->withErrors('Record not found!');
        }

        if($candidate_info->reg_status=="payment_pending"){

            $rules= ['payment_option' => 'required'];

            $validator= Validator::make($data= $request->all(), $rules);

            if($validator->fails()){

                return back()->withErrors(array('message' => 'Please select a Payment Option'));
            }

            if($request->payment_option == "challan"){

                return redirect()->route($this->content.'challan');

            }else if($request->payment_option == "netbanking"){

                return redirect()->route($this->content.'netbanking');

            }

            return $this->getStep();

       }

       return $this->getStep();

   }


       public function challan(){

        if(!Basehelper::checkSession())
            return redirect()->route($this->content.'dashboard');

        try{
            $candidate_info=CandidateInfo::where('id', $this->info_id)->first();
            $step1 = Step1::where('candidate_info_id', $this->info_id)->first();
            $step2 = Step2::where('candidate_info_id', $this->info_id)->first();
            $step3 = Step3::where('candidate_info_id', $this->info_id)->first();
        }catch(ModelNotFoundException $e){

            return redirect()->route('candidate.error')->withErrors('Record not found!');
        }

        if($candidate_info->reg_status=="payment_pending"){

            return view($this->content.'challan');
       }

        return $this->getStep();

    }

    public function challanCopy(){

        if(!Basehelper::checkSession())
            return redirect()->route($this->content.'dashboard');

        try{
            $id=Auth::candidate()->get()->id;
            $candidate=Candidate::where('id', $id)->first();
            $candidate_info=CandidateInfo::where('id', $this->info_id)->first();
            $step1 = Step1::where('candidate_info_id', $this->info_id)->first();
            $step2 = Step2::where('candidate_info_id', $this->info_id)->first();
            $step3 = Step3::where('candidate_info_id', $this->info_id)->first();
        }catch(ModelNotFoundException $e){

            return redirect()->route('candidate.error')->withErrors('Record not found!');
        }

        if($candidate_info->reg_status=="payment_pending"){

            $step1->reservation_code= Basehelper::getCategory($step1->reservation_code);
            $step2->state= Basehelper::getState($step2->state);
            $step2->district= Basehelper::getDistrict($step2->district);

            if($step1->reservation_code == "GENERAL" || $step1->reservation_code == "OBC"){
                $candidate_info->exam_id= Basehelper::getNormalPrice($candidate_info->exam_id);
                $candidate_info->exam_id=($candidate_info->exam_id + 35.00);
            }

            if($step1->reservation_code == "ST" || $step1->reservation_code == "SC" || $step1->reservation_code == "PD"){
                $candidate_info->exam_id= Basehelper::getOtherPrice($candidate_info->exam_id);
                $candidate_info->exam_id=($candidate_info->exam_id + 35.00);
            }


            return view($this->content.'challan_format', compact('step1', 'step2', 'candidate', 'candidate_info', ''));

        }

        return $this->getStep();


    }


    public function showError(){

        if(!Basehelper::checkSession())
            return redirect()->route($this->content.'dashboard');

        return view($this->content.'error');
    }

    public function completed(){

        if(!Basehelper::checkSession())
            return redirect()->route($this->content.'dashboard');

        try{

            $step2=Step2::where('candidate_info_id', $this->info_id)->first();
            $candidate_info=CandidateInfo::where('id', $this->info_id)->first();
            $candidate_info->exam_id= Basehelper::getExam($candidate_info->exam_id);
        }catch(ModelNotFoundException $e){

            return redirect()->route('candidate.error')->withErrors('Record not found!');
        }

        if($candidate_info->reg_status == "completed"){

            return view($this->content.'completed', compact('step2', 'candidate_info'));

        }

        return $this->getStep();

    }

    public function e_application(){

        if(!Basehelper::checkSession())
            return redirect()->route($this->content.'dashboard');

        try{
            $step1=Step1::where('candidate_info_id', $this->info_id)->first();
            $step2=Step2::where('candidate_info_id', $this->info_id)->first();
            $step3=Step3::where('candidate_info_id', $this->info_id)->first();
            $candidate=Candidate::where('id', Auth::candidate()->get()->id)->first();
            $candidate_info=CandidateInfo::where('id', $this->info_id)->first();
        }catch(ModelNotFoundException $e){
            return redirect()->route('candidate.error')->withErrors('Record not found!');
        }

        if($candidate_info->reg_status == "completed"){

            $candidate_info->exam_id= Basehelper::getExam($candidate_info->exam_id);
            $step1->category= Basehelper::getCategory($step1->reservation_code);
            $step1->quota= Basehelper::getQuota($step1->quota);
            $candidate_info->q_id=Basehelper::getQualification($candidate_info->q_id);
            $step1->admission_in= Basehelper::getAdmissionIn($step1->admission_in);
            $step2->state= Basehelper::getState($step2->state);
            $step2->district= Basehelper::getDistrict($step2->district);
            $step1->branch= Basehelper::getBranch($step1->branch);
            $step1->allied_branch= Basehelper::getAlliedBranch($step1->allied_branch);
            $step1->c_pref1= Basehelper::getCentre($step1->c_pref1);
            $step1->c_pref2= Basehelper::getCentre($step1->c_pref2);

            return view($this->content.'e_application', compact('step1', 'step2', 'step3', 'candidate', 'candidate_info'));

        }

        return $this->getStep();
    }

}
