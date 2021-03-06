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
use nee_portal\Models\Reservation;
use nee_portal\Models\AlliedBranch;
use nee_portal\Models\Order;
use nee_portal\Models\CentreCapacity;

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
            }else{
                //return redirect()->route($this->content.'final');
                return $this->showFinal();
            }
        }
        else if($reg_status=="payment_pending"){

            if(count($step1)==0 || count($step2)==0 || count($step3)==0){
                Log::info('Data missing CODE: ##401## Info ID: =='.$this->info_id.'==');
                return redirect()->route('candidate.error')->with('message', 'DATA ERROR CODE 401');
            }

            return redirect()->route($this->content.'payment_options');

        }else if($reg_status=="completed"){

                return redirect()->route($this->content.'completed');

        }
    }

    public function showStep1()
    {
        if(!Basehelper::checkSession())
            return redirect()->route($this->content.'dashboard');

        $step1 = Step1::where('candidate_info_id', $this->info_id)->first();
        $info = CandidateInfo::find($this->info_id);

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

        }else
            return $this->getStep();
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
                      'allied_branches'  => $step1->branch,
                      'quota_selected'   =>  $step1->quota,
                      'reservation_code_selected'   =>  $step1->reservation_code,
                  ],
                  'model' => $step1,
        ])->remove('save');

        $reservation_code_details = Reservation::with('quota')->where('quota_id', $step1->quota)->get();
        return view($this->content.'step1_edit', compact('form', 'step1', 'reservation_code_details'));
    }

    public function saveStep1(Request $request)
    {

        $validator = Validator::make($data =$request->all(), ValidationRules::step1_save());
        if ($validator->fails())
            return back()->withErrors($validator)->withInput();

        //Age Validation as per restriction specified
        $age_allowed = Basehelper::checkAgeLimit($this->info_id, $data);
        if(!$age_allowed['status'])
            return back()->withErrors($age_allowed['error'])->withInput();

        $step1 = Step1::where('candidate_info_id', $this->info_id)->first();

        if(count($step1)!=0)
            return $this->getStep()->with('message', 'Data exists on Step1 ');

        $data = ['candidate_info_id' => $this->info_id] + $request->all();
        $step1_data = new Step1;
        $step1_data->fill($data);
        if (!$step1_data->save())
            return back()->withInput()->with('message', 'Error Storing your data, Please contact Technical Support');

        return $this->getStep();
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
                        return back()->withInput()->with('message', 'Error Storing your data, Please contact Technical Support');

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
            }else
              return back()->withErrors('message', ['Photo is invalid']);
        }

        if($request->hasFile('signature'))
        {
            if($request->file('signature')->isValid()){
                $extention = $request->file('signature')->getClientOriginalExtension();
                $fileName = 'signature.'.$extention;
                $request->file('signature')->move($destinationPath, $fileName);
                $data['signature'] = 'candidates/'.$this->info_id.'/'.$fileName;
            }else
              return back()->withErrors('message', ['Signature is invalid']);
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
        }else{

            $validator = Validator::make($data = $request->all(), ValidationRules::step1_save());
            if ($validator->fails())
                return back()->withErrors($validator)->withInput();

            //Age Validation as per restriction specified
            $age_allowed = Basehelper::checkAgeLimit($this->info_id, $data);
            if(!$age_allowed['status'])
                return back()->withErrors($age_allowed['error'])->withInput();

            $step1->fill($data);
            if (!$step1->save())
                return back()->withInput()->with('message', 'Error Storing your data, Please contact Technical Support');

            //return $this->getStep();
            return redirect()->route($this->content.'step')->with('message', 'Step1 data has been updated');
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

        $form = $this->formBuilder->create('nee_portal\Forms\Step2',[
                    'method' =>'POST',
                    'url'    => route($this->content.'editstep2'),
                    'model' => $step2,
                ])->remove('save');

        return view($this->content.'step2_edit', compact('form', 'step2'));

    }

    public function updateStep2(Request $request){

        try {

            $step2 = Step2::where('candidate_info_id', $this->info_id)->firstOrFail();

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
                    return back()->withInput()->with('message', 'Error Storing your data, Please contact Technical Support');

                //return $this->getStep();
                return redirect()->route($this->content.'step')->with('message', 'Step2 data has been updated');
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
            $step3 = Step3::where('candidate_info_id', $this->info_id)->firstOrFail();
        }catch(ModelNotFoundException $e){

            return $this->getStep();
        }

        $validator = Validator::make($data = $request->all(), ValidationRules::step3_update());
        if($validator ->fails())
            return back()->withErrors($validator);

        $destinationPath = storage_path('candidates/'.$this->info_id);
        //$data['candidate_info_id'] = $this->info_id;
        $message = '';
        if($request->hasFile('photo'))
        {
            if($request->file('photo')->isValid()){
                $extention = $request->file('photo')->getClientOriginalExtension();
                $fileName = 'photo.'.$extention;
                $request->file('photo')->move($destinationPath, $fileName);
                $data['photo'] = 'candidates/'.$this->info_id.'/'.$fileName;
                $message.= 'Photo has been updated<br/>';
            }else
              return back()->withErrors('message', ['Photo is invalid']);
        }

        if($request->hasFile('signature'))
        {
            if($request->file('signature')->isValid()){
                $extention = $request->file('signature')->getClientOriginalExtension();
                $fileName = 'signature.'.$extention;
                $request->file('signature')->move($destinationPath, $fileName);
                $data['signature'] = 'candidates/'.$this->info_id.'/'.$fileName;
                $message.= 'Signature has been updated';
            }else
                return back()->withErrors('message', ['Signature is invalid']);
        }
        if($message!='')
          Session::flash('message', $message);
        $step3->fill($data);
        if(!$step3->save())
          return back()->with('message', 'Error while uploading! contact support');
        //return $this->getStep();
      return redirect()->route($this->content.'step')->with('message', 'Step3 data has been updated');
    }

    public function finalSubmit(){

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

        $candidate_info = CandidateInfo::where('id', $this->info_id)->first();
        $candidate_info->reg_status =   'payment_pending';
        $candidate_info->paper_code = Basehelper::getPaperCodeByInfoID($this->info_id);
        $candidate_info->save();

        return $this->getStep();
    }


    public function paymentOptions(){

        if(!Basehelper::checkSession())
            return redirect()->route($this->content.'dashboard');

        try{
            $candidate_info=CandidateInfo::where('id', $this->info_id)->firstOrFail();
            $step1 = Step1::where('candidate_info_id', $this->info_id)->firstOrFail();
            $step2 = Step2::where('candidate_info_id', $this->info_id)->firstOrFail();
            $step3 = Step3::where('candidate_info_id', $this->info_id)->firstOrFail();
        }catch(ModelNotFoundException $e){

            return redirect()->route('candidate.error')->withErrors('Record not found!');
        }

        if($candidate_info->reg_status=="payment_pending"){

            $options = [''=>' -- Choose your option -- ',
                'debit_card'=>'Debit Card',
                'credit_card'=>'Credit Card',
                //'pay_u'   =>  'PayUMoney (E-Wallet)',
                'challan'=> 'Challan',
                'net_banking'=>'Net Banking',
            ];
            return view($this->content.'payment_options', compact('options'));
        }

        return $this->getStep();
    }

    public function paymentProceed(Request $request){

        if(!Basehelper::checkSession())
            return redirect()->route($this->content.'dashboard');

        try{
            $candidate_info=CandidateInfo::where('id', $this->info_id)->firstOrFail();
            $step1 = Step1::where('candidate_info_id', $this->info_id)->firstOrFail();
            $step2 = Step2::where('candidate_info_id', $this->info_id)->firstOrFail();
            $step3 = Step3::where('candidate_info_id', $this->info_id)->firstOrFail();
        }catch(ModelNotFoundException $e){

            return redirect()->route('candidate.error')->withErrors('Record not found!');
        }

        if($candidate_info->reg_status=="payment_pending"){

            $rules= ['payment_option' => 'required'];

            $validator= Validator::make($data= $request->all(), $rules);

            if($validator->fails()){

                return back()->withErrors(array('message' => 'Please select a Payment Option'));
            }
            $option = $request->payment_option;

            if($option == 'challan'){
                return redirect()->route($this->content.'challan');

            }else if($option == 'debit_card'){
                return redirect()->route('payment.debit_card');

            }else if($option == 'credit_card'){
                return redirect()->route('payment.credit_card');

            }else if($option == 'net_banking'){
                return redirect()->route('payment.net_banking');

            }elseif ($option == 'pay_u') {

                return redirect()->route('payment.pay_u');
            }

            return $this->getStep();
       }

       return $this->getStep();

   }


       public function challan(){

        if(!Basehelper::checkSession())
            return redirect()->route($this->content.'dashboard');

        try{
            $candidate_info=CandidateInfo::where('id', $this->info_id)->firstOrFail();
            $step1 = Step1::where('candidate_info_id', $this->info_id)->firstOrFail();
            $step2 = Step2::where('candidate_info_id', $this->info_id)->firstOrFail();
            $step3 = Step3::where('candidate_info_id', $this->info_id)->firstOrFail();
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

        if(Basehelper::Filter()==true)
            return redirect()->route('candidate.application.payment_options')->withErrors(array('message'=>'Process has been closed!'));  

        try{
            $id=Auth::candidate()->get()->id;
            $candidate=Candidate::where('id', $id)->first();
            $candidate_info=CandidateInfo::where('id', $this->info_id)->firstOrFail();
            $step1 = Step1::where('candidate_info_id', $this->info_id)->firstOrFail();
            $step2 = Step2::where('candidate_info_id', $this->info_id)->firstOrFail();
            $step3 = Step3::where('candidate_info_id', $this->info_id)->firstOrFail();
        }catch(ModelNotFoundException $e){

            return redirect()->route('candidate.error')->withErrors('Record not found!');
        }

        if($candidate_info->reg_status=="payment_pending"){

            $step1->reservation_code= Basehelper::getCategory($step1->reservation_code);
            $step2->state= Basehelper::getState($step2->state);
            $step2->district= Basehelper::getDistrict($step2->district);

            $amount =Basehelper::getPayableAmount($this->info_id);

            return view($this->content.'challan_format', compact('step1', 'step2', 'candidate', 'candidate_info', 'amount'));

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

            $step2  =   Step2::where('candidate_info_id', $this->info_id)->firstOrFail();
            $candidate_info = CandidateInfo::where('id', $this->info_id)->firstOrFail();
            $candidate_info->exam_id    = Basehelper::getExam($candidate_info->exam_id);
        }catch(ModelNotFoundException $e){

            return redirect()->route('candidate.error')->withErrors('Record not found!');
        }

        if($candidate_info->reg_status == "completed")
            return view($this->content.'completed', compact('step2', 'candidate_info'));

        return $this->getStep();
    }

    public function viewConfirmation(){

        if(!Basehelper::checkSession())
            return redirect()->route($this->content.'dashboard');

        try{
            $step1  =   Step1::where('candidate_info_id', $this->info_id)->firstOrFail();
            $step2  =   Step2::where('candidate_info_id', $this->info_id)->firstOrFail();
            $step3  =   Step3::where('candidate_info_id', $this->info_id)->firstOrFail();
            $candidate  = Candidate::where('id', Auth::candidate()->get()->id)->firstOrFail();
            $candidate_info    =    CandidateInfo::where('id', $this->info_id)->firstOrFail();
        }catch(ModelNotFoundException $e){
            return redirect()->route('candidate.error')->withErrors('Record not found!');
        }

        if($candidate_info->reg_status == "completed"){
            $order = Order::where('candidate_info_id', $this->info_id)
            ->where('status', 'SUCCESS')->orderBy('id', 'desc')->first();
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
            $amount=Basehelper::getPayableAmount($this->info_id);

            $registration_no= Basehelper::getRegistrationNo($this->info_id);
            $step1->voc_subject= Basehelper::getVocSubject($step1->voc_subject);

            if($step1->branch == NULL)
                $step1->branch = 'NA';

            if($step1->allied_branch == NULL)
                $step1->allied_branch = 'NA';

            if($step1->voc_subject == NULL)
                $step1->voc_subject = 'NA';

            return view($this->content.'view_confirmation', compact('step1', 'step2', 'step3', 'candidate', 'candidate_info', 'order', 'amount', 'registration_no'));

        }

        return $this->getStep();
    }


    public function admit_card()
    {
            if(!Basehelper::checkSession())
                return redirect()->route($this->content.'dashboard');

            try{
                $step1  = Step1::where('candidate_info_id', $this->info_id)->firstOrFail();
                $step2  = Step2::where('candidate_info_id', $this->info_id)->firstOrFail();
                $step3  = Step3::where('candidate_info_id', $this->info_id)->firstOrFail();
                $candidate  = Candidate::where('id', Auth::candidate()->get()->id)->firstOrFail();
                $candidate_info    =    CandidateInfo::where('id', $this->info_id)->firstOrFail();
                $centre_locations=CentreCapacity::join('centres', 'centres.centre_code', '=', 'centre_capacities.centre_code')
                                        ->where('centre_capacities.id', $candidate_info->centre_capacities_id)->firstOrFail();                                   
              }catch(ModelNotFoundException $e){
                return redirect()->route('candidate.error')->withErrors('Admit card is not generated yet!');
            }

            if($candidate_info->reg_status == "completed"){
            $order = Order::where('candidate_info_id', $this->info_id)->where('status', 'SUCCESS')->orderBy('id', 'desc')->first();
            
            $exam_name= Basehelper::getExam($candidate_info->exam_id);
            $exam_date= Basehelper::getExamDate($candidate_info->exam_id);
            $step1->category= Basehelper::getCategory($step1->reservation_code);
            $step1->quota= Basehelper::getQuota($step1->quota);
            $candidate_info->q_id=Basehelper::getQualification($candidate_info->q_id);
            $step1->admission_in= Basehelper::getAdmissionIn($step1->admission_in);
            $step2->state= Basehelper::getState($step2->state);
            $step2->district= Basehelper::getDistrict($step2->district);
            $amount=Basehelper::getPayableAmount($this->info_id);
            $centre_code=$centre_locations->centre_code;
            $centre_name= Basehelper::getCentre($centre_code);
            $candidate_info->centre_capacities_id=$centre_locations->centre_location;

            if(strlen($centre_code) < 2)
                $centre_code="0".$centre_code;

            $registration_no= Basehelper::getRegistrationNo($this->info_id);
            $sub_type="Voc./Branch Subject";
            $subject="NA";

            if($step1->allied_branch != Null)
            {
                $subject= Basehelper::getAlliedBranch($step1->allied_branch);
                $sub_type="Branch Subject";
            }

            if($step1->voc_subject != NULL)
            {
                $subject= Basehelper::getVocSubject($step1->voc_subject);
                $sub_type="Vocational Subject";
            }    
            return view('candidate.application.admit_card', compact('step1', 'step2', 'step3', 'candidate', 'candidate_info', 'order', 'amount', 'registration_no', 'exam_date', 'exam_name', 'subject', 'sub_type', 'centre_code', 'centre_name'));

            }
                  
            //$step1  =   Step1::where('candidate_info_id', $info_id)->firstOrFail();
            //$step2  =   Step2::where('candidate_info_id', $info_id)->firstOrFail();
            //$step3  =   Step3::where('candidate_info_id', $info_id)->firstOrFail();
            //$candidate_info    = CandidateInfo::where('id', $info_id)->firstOrFail();
            //$candidate  = Candidate::where('id', $candidate_info->candidate_id)->firstOrFail();
            
    }


}
