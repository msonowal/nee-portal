<?php

namespace nee_portal\Http\Controllers\Admin;

use Illuminate\Http\Request;

use nee_portal\Http\Requests;
use nee_portal\Http\Controllers\Controller;
use nee_portal\Models\ChallanInfo;
use Session, URL, Validator, Basehelper, DB, Auth, Carbon;
use nee_portal\Models\CandidateInfo;
use nee_portal\Models\Candidate;
use nee_portal\Models\Step1;
use nee_portal\Models\Step2;
use nee_portal\Models\Step3;
use nee_portal\Models\Order;
use nee_portal\Models\Exam;
use nee_portal\Models\Centre;
use nee_portal\Models\CentreCapacity;
use nee_portal\Models\Quota;

class AdminController extends Controller
{
    private $content='admin.';

    public function dashboard()
    {
       $total_submitted =CandidateInfo::where('reg_status', 'completed')->get()->count();
       $nee_i_submitted =CandidateInfo::where('reg_status', 'completed')->where('exam_id', 1)->get()->count();
       $nee_ii_submitted =CandidateInfo::where('reg_status', 'completed')->where('exam_id', 2)->get()->count();
       $nee_iii_submitted =CandidateInfo::where('reg_status', 'completed')->where('exam_id', 3)->get()->count();

       $debit_card =CandidateInfo::join('orders', 'candidate_info.id', '=', 'orders.candidate_info_id')
                                ->where('orders.status', 'SUCCESS')
                                ->where('orders.trans_type', 'Debit Card')
                                ->where('reg_status', 'completed')->get()->count();

       $credit_card =CandidateInfo::join('orders', 'candidate_info.id', '=', 'orders.candidate_info_id')
                                ->where('orders.status', 'SUCCESS')
                                ->where('orders.trans_type', 'Credit Card')
                                ->where('reg_status', 'completed')->get()->count(); 

       $net_banking =CandidateInfo::join('orders', 'candidate_info.id', '=', 'orders.candidate_info_id')
                                ->where('orders.status', 'SUCCESS')
                                ->where('orders.trans_type', 'Net Banking')
                                ->where('reg_status', 'completed')->get()->count(); 

       $challan =CandidateInfo::join('orders', 'candidate_info.id', '=', 'orders.candidate_info_id')
                                ->where('orders.status', 'SUCCESS')
                                ->where('orders.trans_type', 'Challan')
                                ->where('reg_status', 'completed')->get()->count();                                                                           

       return view($this->content.'dashboard', compact('total_submitted', 'nee_i_submitted', 'nee_ii_submitted', 'nee_iii_submitted', 'debit_card', 'credit_card', 'net_banking', 'challan')); 
    }

    public function challan()
    {
        $result=ChallanInfo::paginate();
        //$result=DB::select(DB::raw("SELECT * FROM `nee_challan_info` WHERE transaction_id not in ( SELECT `tansaction_id` as transaction_id FROM `nee_orders` WHERE `trans_type` = 'challan') ORDER BY `transaction_id` ASC"));
        //$result=$result->paginate();
         $paginator=0;

        $paginator=$result->currentPage();
        //$result=$result;
        Session::put('url', URL::full());

        return view($this->content.'challan.import', compact('result', 'paginator'));
    }

    public function challan_pending()
    {
        //$result=ChallanInfo::paginate();
        $result=DB::select(DB::raw("SELECT * FROM `nee_challan_info` WHERE transaction_id not in ( SELECT `tansaction_id` as transaction_id FROM `nee_orders` WHERE `trans_type` = 'challan') ORDER BY `transaction_id` ASC"));
        //$result=$result->paginate();
         //$paginator=0;

        //$paginator=$result->currentPage();
        $result=$result;
        Session::put('url', URL::full());

        return view($this->content.'challan.pending', compact('result', 'paginator'));
    }

    public function submittedForm()
    {
        $result=CandidateInfo::join('exams', 'exams.id', '=', 'candidate_info.exam_id')
                                    ->join('candidates', 'candidates.id', '=', 'candidate_info.candidate_id')
                                    ->join('step2', 'candidate_info.id', '=', 'step2.candidate_info_id')
                                    ->join('orders', 'candidate_info.id', '=', 'orders.candidate_info_id')
                                    ->where('orders.status', 'SUCCESS')
                                    ->where('candidate_info.reg_status', 'completed')
                                    ->select('candidate_info.id' ,'exams.exam_name', 'step2.name', 'candidate_info.form_no','candidate_info.id as info_id', 'orders.trans_type', 'orders.order_info', 'candidate_info.created_at', 'candidates.mobile_no', 'candidates.email');
        if(count($result) > 0)                 
              Session::put('info_id', $result->lists('id'));
        $result=$result->paginate();                            
        $paginator=0;
        $paginator=$result->currentPage();
        Session::put('url', URL::full());

        return view($this->content.'candidates.submitted_forms', compact('result', 'paginator'));
    }

    public function nee_i_submitted()
    {
        $result=CandidateInfo::join('exams', 'exams.id', '=', 'candidate_info.exam_id')
                                    ->join('candidates', 'candidates.id', '=', 'candidate_info.candidate_id')
                                    ->join('step2', 'candidate_info.id', '=', 'step2.candidate_info_id')
                                    ->join('orders', 'candidate_info.id', '=', 'orders.candidate_info_id')
                                    ->where('orders.status', 'SUCCESS')
                                    ->where('reg_status', 'completed')
                                    ->where('exam_id', 1)
                                    ->select('candidate_info.id' ,'exams.exam_name', 'step2.name', 'candidate_info.form_no','candidate_info.id as info_id', 'orders.trans_type', 'orders.order_info', 'candidate_info.created_at', 'candidates.mobile_no', 'candidates.email');

        if(count($result) > 0)                 
              Session::put('info_id', $result->lists('id'));
        $result=$result->paginate();
        $paginator=0;
        $paginator=$result->currentPage();
        Session::put('url', URL::full());

        return view($this->content.'candidates.submitted_nee_i_forms', compact('result', 'paginator'));
    }

    public function nee_ii_submitted()
    {
        $result=CandidateInfo::join('exams', 'exams.id', '=', 'candidate_info.exam_id')
                                    ->join('candidates', 'candidates.id', '=', 'candidate_info.candidate_id')
                                    ->join('step2', 'candidate_info.id', '=', 'step2.candidate_info_id')
                                    ->join('orders', 'candidate_info.id', '=', 'orders.candidate_info_id')
                                    ->where('orders.status', 'SUCCESS')
                                    ->where('reg_status', 'completed')
                                    ->where('exam_id', 2)
                                    ->select('candidate_info.id' ,'exams.exam_name', 'step2.name', 'candidate_info.form_no','candidate_info.id as info_id', 'orders.trans_type', 'orders.order_info', 'candidate_info.created_at', 'candidates.mobile_no', 'candidates.email');
        if(count($result) > 0)                 
              Session::put('info_id', $result->lists('id'));
        $result=$result->paginate();                            
        $paginator=0;
        $paginator=$result->currentPage();
        Session::put('url', URL::full());

        return view($this->content.'candidates.submitted_nee_ii_forms', compact('result', 'paginator'));
    }

    public function nee_iii_submitted()
    {
        $result=CandidateInfo::join('exams', 'exams.id', '=', 'candidate_info.exam_id')
                                    ->join('candidates', 'candidates.id', '=', 'candidate_info.candidate_id')
                                    ->join('step2', 'candidate_info.id', '=', 'step2.candidate_info_id')
                                    ->join('orders', 'candidate_info.id', '=', 'orders.candidate_info_id')
                                    ->where('orders.status', 'SUCCESS')
                                    ->where('reg_status', 'completed')
                                    ->where('exam_id', 3)
                                    ->select('candidate_info.id' ,'exams.exam_name', 'step2.name', 'candidate_info.form_no','candidate_info.id as info_id', 'orders.trans_type', 'orders.order_info', 'candidate_info.created_at', 'candidates.mobile_no', 'candidates.email');
        if(count($result) > 0)                 
              Session::put('info_id', $result->lists('id'));
        $result=$result->paginate(); 
        $paginator=0;
        $paginator=$result->currentPage();
        Session::put('url', URL::full());

        return view($this->content.'candidates.submitted_nee_iii_forms', compact('result', 'paginator'));
    }

    public function viewConfirmation($info_id)
    {

            $step1  =   Step1::where('candidate_info_id', $info_id)->firstOrFail();
            $step2  =   Step2::where('candidate_info_id', $info_id)->firstOrFail();
            $step3  =   Step3::where('candidate_info_id', $info_id)->firstOrFail();
            $candidate_info    = CandidateInfo::where('id', $info_id)->firstOrFail();
            $candidate  = Candidate::where('id', $candidate_info->candidate_id)->firstOrFail();
            $order = Order::where('candidate_info_id', $info_id)->where('status', 'SUCCESS')->orderBy('id', 'desc')->first();
            
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
            $amount=Basehelper::getPayableAmount($info_id);

            $registration_no= Basehelper::getRegistrationNo($info_id);
            $step1->voc_subject= Basehelper::getVocSubject($step1->voc_subject);

            if($step1->branch == NULL)
                $step1->branch = 'NA';

            if($step1->allied_branch == NULL)
                $step1->allied_branch = 'NA';

            if($step1->voc_subject == NULL)
                $step1->voc_subject = 'NA';

            return view($this->content.'candidates.view_comfirmation', compact('step1', 'step2', 'step3', 'candidate', 'candidate_info', 'order', 'amount', 'registration_no'));

    }

    public function transactionSuccess()
    {
        $result=CandidateInfo::join('exams', 'exams.id', '=', 'candidate_info.exam_id')
                                    ->join('candidates', 'candidates.id', '=', 'candidate_info.candidate_id')
                                    ->join('step2', 'candidate_info.id', '=', 'step2.candidate_info_id')
                                    ->join('orders', 'candidate_info.id', '=', 'orders.candidate_info_id')
                                    ->where('orders.status', 'SUCCESS')
                                    ->where('candidate_info.reg_status', 'completed')
                                    ->select('candidate_info.id' ,'exams.exam_name', 'step2.name', 'candidate_info.form_no','candidate_info.id as info_id', 'orders.trans_type', 'orders.order_info', 'candidate_info.created_at', 'candidates.mobile_no');

        if(count($result) > 0)                 
              Session::put('info_id', $result->lists('id'));
        $result=$result->paginate();                             
        $paginator=0;
        $paginator=$result->currentPage();
        Session::put('url', URL::full());

        return view($this->content.'candidates.transaction_success', compact('result', 'paginator'));
    }

    public function transactionFailed()
    {
        $result=CandidateInfo::join('exams', 'exams.id', '=', 'candidate_info.exam_id')
                                    ->join('candidates', 'candidates.id', '=', 'candidate_info.candidate_id')
                                    ->join('step2', 'candidate_info.id', '=', 'step2.candidate_info_id')
                                    ->join('orders', 'candidate_info.id', '=', 'orders.candidate_info_id')
                                    ->where('orders.status', '!=', 'SUCCESS')
                                    ->where('candidate_info.reg_status', 'payment_pending')
                                    ->select('candidate_info.id', 'exams.exam_name', 'step2.name', 'candidate_info.form_no','candidate_info.id as info_id', 'orders.trans_type', 'orders.order_info', 'candidate_info.created_at', 'candidates.mobile_no');

        if(count($result) > 0)                 
              Session::put('info_id', $result->lists('id'));
        $result=$result->paginate();                             
        $paginator=0;
        $paginator=$result->currentPage();
        Session::put('url', URL::full());

        return view($this->content.'candidates.transaction_failed', compact('result', 'paginator'));
    }

    public function searchALL(Request $request)
    {
        if($request->type != "")
        {
            $results=CandidateInfo::join('exams', 'exams.id', '=', 'candidate_info.exam_id')
                                    ->join('candidates', 'candidates.id', '=', 'candidate_info.candidate_id')
                                    ->join('step2', 'candidate_info.id', '=', 'step2.candidate_info_id')
                                    ->join('orders', 'candidate_info.id', '=', 'orders.candidate_info_id')
                                    ->where('orders.status', 'SUCCESS')
                                    ->where('candidate_info.reg_status', 'completed');

            if($request->type =="form_no")
                $results->where('candidate_info.'.$request->type, $request->value);

            if($request->type =="mobile_no")
                $results->where('candidates.'.$request->type, $request->value);

            if($request->type =="name")
                $results->where('step2.'.$request->type, $request->value);

            if($request->type =="order_info")
                $results->where('orders.'.$request->type, $request->value);

            $results->select('candidate_info.id','exams.exam_name', 'step2.name', 'candidate_info.form_no','candidate_info.id as info_id', 'orders.trans_type', 'orders.order_info', 'candidate_info.created_at', 'candidates.mobile_no');
            if(count($results) > 0)                 
              Session::put('info_id', $results->lists('id'));
            $result=$results->paginate();
            $paginator=0;
            $paginator=$result->currentPage();
            Session::put('url', URL::full());
            return view($this->content.'candidates.submitted_forms', compact('result', 'paginator'));                        
        }
    }

    public function search_nee_i(Request $request)
    {
        if($request->type != "")
        {
            $results=CandidateInfo::join('exams', 'exams.id', '=', 'candidate_info.exam_id')
                                    ->join('candidates', 'candidates.id', '=', 'candidate_info.candidate_id')
                                    ->join('step2', 'candidate_info.id', '=', 'step2.candidate_info_id')
                                    ->join('orders', 'candidate_info.id', '=', 'orders.candidate_info_id')
                                    ->where('orders.status', 'SUCCESS')
                                    ->where('candidate_info.exam_id', 1)
                                    ->where('candidate_info.reg_status', 'completed');

            if($request->type =="form_no")
                $results->where('candidate_info.'.$request->type, $request->value);

            if($request->type =="mobile_no")
                $results->where('candidates.'.$request->type, $request->value);

            if($request->type =="name")
                $results->where('step2.'.$request->type, $request->value);

            if($request->type =="order_info")
                $results->where('orders.'.$request->type, $request->value);

            $results->select('exams.exam_name', 'step2.name', 'candidate_info.form_no','candidate_info.id as info_id', 'orders.trans_type', 'orders.order_info', 'candidate_info.created_at', 'candidates.mobile_no');
            if(count($results) > 0)                 
              Session::put('info_id', $results->lists('id'));
            $result=$results->paginate();
            $paginator=0;
            $paginator=$result->currentPage();
            Session::put('url', URL::full());
            return view($this->content.'candidates.submitted_nee_i_forms', compact('result', 'paginator'));                        
        }
    }

    public function search_nee_ii(Request $request)
    {
        if($request->type != "")
        {
            $results=CandidateInfo::join('exams', 'exams.id', '=', 'candidate_info.exam_id')
                                    ->join('candidates', 'candidates.id', '=', 'candidate_info.candidate_id')
                                    ->join('step2', 'candidate_info.id', '=', 'step2.candidate_info_id')
                                    ->join('orders', 'candidate_info.id', '=', 'orders.candidate_info_id')
                                    ->where('orders.status', 'SUCCESS')
                                    ->where('candidate_info.exam_id', 2)
                                    ->where('candidate_info.reg_status', 'completed');

            if($request->type =="form_no")
                $results->where('candidate_info.'.$request->type, $request->value);

            if($request->type =="mobile_no")
                $results->where('candidates.'.$request->type, $request->value);

            if($request->type =="name")
                $results->where('step2.'.$request->type, $request->value);

            if($request->type =="order_info")
                $results->where('orders.'.$request->type, $request->value);

            $results->select('candidate_info.id', 'exams.exam_name', 'step2.name', 'candidate_info.form_no','candidate_info.id as info_id', 'orders.trans_type', 'orders.order_info', 'candidate_info.created_at', 'candidates.mobile_no');
            if(count($results) > 0)                 
              Session::put('info_id', $results->lists('id'));
            $result=$results->paginate();
            $paginator=0;
            $paginator=$result->currentPage();
            Session::put('url', URL::full());
            return view($this->content.'candidates.submitted_nee_ii_forms', compact('result', 'paginator'));                        
        }
    }

    public function search_nee_iii(Request $request)
    {
        if($request->type != "")
        {
            $results=CandidateInfo::join('exams', 'exams.id', '=', 'candidate_info.exam_id')
                                    ->join('candidates', 'candidates.id', '=', 'candidate_info.candidate_id')
                                    ->join('step2', 'candidate_info.id', '=', 'step2.candidate_info_id')
                                    ->join('orders', 'candidate_info.id', '=', 'orders.candidate_info_id')
                                    ->where('orders.status', 'SUCCESS')
                                    ->where('candidate_info.exam_id', 3)
                                    ->where('candidate_info.reg_status', 'completed');

            if($request->type =="form_no")
                $results->where('candidate_info.'.$request->type, $request->value);

            if($request->type =="mobile_no")
                $results->where('candidates.'.$request->type, $request->value);

            if($request->type =="name")
                $results->where('step2.'.$request->type, $request->value);

            if($request->type =="order_info")
                $results->where('orders.'.$request->type, $request->value);

            $results->select('candidate_info.id', 'exams.exam_name', 'step2.name', 'candidate_info.form_no','candidate_info.id as info_id', 'orders.trans_type', 'orders.order_info', 'candidate_info.created_at', 'candidates.mobile_no');
            if(count($results) > 0)                 
              Session::put('info_id', $results->lists('id'));
            $result=$results->paginate();
            $paginator=0;
            $paginator=$result->currentPage();
            Session::put('url', URL::full());
            return view($this->content.'candidates.submitted_nee_iii_forms', compact('result', 'paginator'));                        
        }
    }

    public function transaction_success(Request $request)
    {
        if($request->type != "")
        {
            $results=CandidateInfo::join('exams', 'exams.id', '=', 'candidate_info.exam_id')
                                    ->join('candidates', 'candidates.id', '=', 'candidate_info.candidate_id')
                                    ->join('step2', 'candidate_info.id', '=', 'step2.candidate_info_id')
                                    ->join('orders', 'candidate_info.id', '=', 'orders.candidate_info_id')
                                    ->where('orders.status', 'SUCCESS')
                                    ->where('candidate_info.reg_status', 'completed');

            if($request->type =="form_no")
                $results->where('candidate_info.'.$request->type, $request->value);

            if($request->type =="mobile_no")
                $results->where('candidates.'.$request->type, $request->value);

            if($request->type =="name")
                $results->where('step2.'.$request->type, $request->value);

            if($request->type =="order_info")
                $results->where('orders.'.$request->type, $request->value);

            $results->select('candidate_info.id', 'exams.exam_name', 'step2.name', 'candidate_info.form_no','candidate_info.id as info_id', 'orders.trans_type', 'orders.order_info', 'candidate_info.created_at', 'candidates.mobile_no');
            if(count($results) > 0)                 
              Session::put('info_id', $results->lists('id'));
            $result=$results->paginate();
            $paginator=0;
            $paginator=$result->currentPage();
            Session::put('url', URL::full());
            return view($this->content.'candidates.transaction_success', compact('result', 'paginator'));                        
        }
    }

    public function transaction_failed(Request $request)
    {
        if($request->type != "")
        {
            $results=CandidateInfo::join('exams', 'exams.id', '=', 'candidate_info.exam_id')
                                    ->join('candidates', 'candidates.id', '=', 'candidate_info.candidate_id')
                                    ->join('step2', 'candidate_info.id', '=', 'step2.candidate_info_id')
                                    ->join('orders', 'candidate_info.id', '=', 'orders.candidate_info_id')
                                    ->where('orders.status', '!=', 'SUCCESS')
                                    ->where('candidate_info.reg_status', 'payment_pending');

            if($request->type =="form_no")
                $results->where('candidate_info.'.$request->type, $request->value);

            if($request->type =="mobile_no")
                $results->where('candidates.'.$request->type, $request->value);

            if($request->type =="email")
                $results->where('candidates.'.$request->type, $request->value);

            if($request->type =="name")
                $results->where('step2.'.$request->type, $request->value);

            if($request->type =="order_info")
                $results->where('orders.'.$request->type, $request->value);

            $results->select('candidate_info.id', 'exams.exam_name', 'step2.name', 'candidate_info.form_no','candidate_info.id as info_id', 'orders.trans_type', 'orders.order_info', 'candidate_info.created_at', 'candidates.mobile_no');
            if(count($results) > 0)                 
              Session::put('info_id', $results->lists('id'));
            $result=$results->paginate();
            $paginator=0;
            $paginator=$result->currentPage();
            Session::put('url', URL::full());
            return view($this->content.'candidates.transaction_failed', compact('result', 'paginator'));                        
        }
    }

    public function submitted(Request $request)
    {
        $results=CandidateInfo::join('exams', 'exams.id', '=', 'candidate_info.exam_id')
                                    ->join('candidates', 'candidates.id', '=', 'candidate_info.candidate_id')
                                    ->join('step1', 'candidate_info.id', '=', 'step1.candidate_info_id')
                                    ->join('step2', 'candidate_info.id', '=', 'step2.candidate_info_id')
                                    ->join('orders', 'candidate_info.id', '=', 'orders.candidate_info_id')
                                    ->where('orders.status', 'SUCCESS')
                                    ->where('candidate_info.reg_status', 'completed')
                                    ->select('candidate_info.id' ,'exams.exam_name', 'step2.name', 'candidate_info.form_no','candidate_info.id as info_id', 'orders.trans_type', 'orders.order_info', 'candidate_info.created_at', 'candidates.mobile_no', 'candidates.email', 'step1.c_pref1');
        $total=$results->get();
        if(count($results) > 0)                 
            Session::put('info_id', $results->lists('id'));
                                    
        $results=$results->paginate();        
        $centres=Centre::all();
        foreach ($results as $result => $res)
        {
          $item = $res['c_pref1'];
          if($item !=NULL)
              $results[$result]['c_pref1'] = $centres->filter(function($c_pref1) use ($item){if( $c_pref1->centre_code==$item ) return $c_pref1;})->first()->centre_name;
        } 

        $exams =['all_exams'=>'---All Exam---'] + Exam::lists('exam_name', 'id')->toArray(); 
        $centre=['all_centres'=>'---All Centre---'] + Centre::lists('centre_name', 'centre_code')->toArray();
        $centre_location=['all_locations'=>'---All Locations---'] + CentreCapacity::lists('centre_location', 'id')->toArray();
        $quota=['all_quotas'=>'---All Quota---'] + Quota::lists('name', 'id')->toArray();                           
        $paginator=0;
        $paginator=$results->currentPage();
        Session::put('url', URL::full());

        return view($this->content.'candidates.search_submitted', compact('results', 'paginator', 'exams', 'centre', 'centre_location', 'quota', 'total'));
    }

    public function search_submitted(Request $request)
    {
        if($request->exam_id != "" || $request->centre !='' || $request->centre_location !='' || $request->quota)
        {
            $results=CandidateInfo::join('exams', 'exams.id', '=', 'candidate_info.exam_id')
                                    ->join('candidates', 'candidates.id', '=', 'candidate_info.candidate_id')
                                    ->join('step1', 'candidate_info.id', '=', 'step1.candidate_info_id')
                                    ->join('step2', 'candidate_info.id', '=', 'step2.candidate_info_id')
                                    ->join('orders', 'candidate_info.id', '=', 'orders.candidate_info_id')
                                    ->where('orders.status', 'SUCCESS')
                                    ->where('candidate_info.reg_status', 'completed');

            if($request->exam_id !='all_exams')
                $results->where('candidate_info.exam_id', $request->exam_id);

            if($request->centre !="all_centres")
                $results->where('step1.c_pref1', $request->centre);

            if($request->quota !='all_quotas')
                $results->where('step1.quota', $request->quota);

            if($request->paper_code !='')
                $results->where('candidate_info.paper_code', $request->paper_code);

            if($request->centre_location !='' && $request->centre_location !='all_locations')
                $results->where('candidate_info.centre_capacities_id', $request->centre_location);

            $exams =['all_exams'=>'---All Exam---'] + Exam::lists('exam_name', 'id')->toArray(); 
            $centre=['all_centres'=>'---All Centre---'] + Centre::lists('centre_name', 'centre_code')->toArray();
            $centre_location=['all_locations'=>'---All Locations---'] + CentreCapacity::lists('centre_location', 'id')->toArray();
            $quota=['all_quotas'=>'---All Quota---'] + Quota::lists('name', 'id')->toArray();
            $results->select('candidate_info.id', 'exams.exam_name', 'step2.name', 'candidate_info.form_no','candidate_info.id as info_id', 'orders.trans_type', 'orders.order_info', 'candidate_info.created_at', 'candidates.mobile_no', 'step1.c_pref1', 'candidate_info.centre_capacities_id');
            $total=$results->get();
            if(count($results) > 0)                 
              Session::put('info_id', $results->lists('id'));
            $results=$results->paginate();
            $centres=Centre::all();
            foreach ($results as $result => $res)
            {
              $item = $res['c_pref1'];
              if($item !=NULL)
                  $results[$result]['c_pref1'] = $centres->filter(function($c_pref1) use ($item){if( $c_pref1->centre_code==$item ) return $c_pref1;})->first()->centre_name;
            }
            $paginator=0;
            $paginator=$results->currentPage();

            Session::put('url', URL::full());

            return view($this->content.'candidates.search_submitted', compact('results', 'paginator', 'exams', 'centre', 'centre_location', 'quota', 'total'));
        }
    }

    public function getCentre_location(Request $request)
    {
        $id = $request->centre_code;
            return CentreCapacity::where('centre_code', $id)->get();
    }

    public function listCandidates()
    {
        $exams =[''=>'-Exam Level-'] + Exam::lists('exam_name', 'id')->toArray(); 
        $centre_pref1=[''=>'-Centre Pref1-'] + Centre::lists('centre_name', 'centre_code')->toArray();
        $centre_pref2=[''=>'-Centre Pref2-'] + Centre::lists('centre_name', 'centre_code')->toArray();
        
        return view($this->content.'candidates.generate_roll', compact('exams', 'centre_pref1', 'centre_pref2', 'total'));
    }

    public function showCandidateList(Request $request)
    {
        if(empty($request->c_pref1 || $request->c_pref2))
           return redirect()->route('admin.generate.roll_no')->with(array('message'=>'Centre Pref1 or Centre Pref2 is required!'));

        if(empty($request->take))
           return redirect()->route('admin.generate.roll_no')->with(array('message'=>'No. of take is required!'));
   
            $results=CandidateInfo::join('exams', 'exams.id', '=', 'candidate_info.exam_id')
                                    ->join('candidates', 'candidates.id', '=', 'candidate_info.candidate_id')
                                    ->join('step1', 'candidate_info.id', '=', 'step1.candidate_info_id')
                                    ->join('step2', 'candidate_info.id', '=', 'step2.candidate_info_id')
                                    ->join('orders', 'candidate_info.id', '=', 'orders.candidate_info_id')
                                    ->where('orders.status', 'SUCCESS')
                                    ->where('candidate_info.rollno', '=', Null)
                                    //->take($request->take)
                                    ->where('candidate_info.reg_status', 'completed')
                                    ->orderBy('candidate_info.paper_code', 'asc');
            
            if($request->exam_id != "" || $request->c_pref1 !='' || $request->c_pref2 !='' || $request->pin !='')
            {
            if($request->exam_id !='')
                $results->where('candidate_info.exam_id', $request->exam_id);

            if($request->c_pref1 !='')
            {
                $results->where('step1.c_pref1', $request->c_pref1);
                $centre_code=$request->c_pref1;   
            }    

            if($request->c_pref2 !='')
            {
                $results->where('step1.c_pref2', $request->c_pref2);
                $centre_code=$request->c_pref2; 
            } 

            if($request->pin !='')
            {
                //$results->where('step2.pin', $request->pin);
                $results->whereNotIn('step2.pin', [791110,791113, 791111]);
            }

            if($request->paper_code !='')
            {
                if($request->paper_code =='voc')
                {
                      $results->whereNotIn('candidate_info.paper_code', [20, 29]); 
                } 

                if($request->paper_code !='voc')
                {
                   $results->where('candidate_info.paper_code', $request->paper_code);  
                }   
                
            }    
                
            }

            $centre =Centre::join('centre_capacities', 'centres.centre_code', '=', 'centre_capacities.centre_code')
                            ->where('centres.centre_code', $centre_code)->first();
            
            $centre_capacity=$centre->centre_capacity;    
            $nee_i=$centre->NEEI;
            $nee_ii=$centre->NEEII;
            $nee_iii=$centre->NEEIII;

            if($request->exam_id==1)
                $centre_capacity=$centre_capacity-$nee_i;

            if($request->exam_id==2 || $request->exam_id==3)
                $centre_capacity=$centre_capacity-($nee_ii+$nee_iii);

            $exams =[''=>'-Exam Level-'] + Exam::lists('exam_name', 'id')->toArray(); 
            $centre_pref1=[''=>'-Centre Pref1-'] + Centre::lists('centre_name', 'centre_code')->toArray();
            $centre_pref2=[''=>'-Centre Pref2-'] + Centre::lists('centre_name', 'centre_code')->toArray();
            $results->select('candidate_info.id', 'candidate_info.paper_code', 'exams.exam_name', 'step2.name', 'candidate_info.form_no','candidate_info.id as info_id', 'orders.trans_type', 'orders.order_info', 'candidate_info.created_at', 'candidates.mobile_no', 'step1.c_pref1', 'step1.c_pref2', 'candidate_info.centre_capacities_id', 'step2.pin');
            
            $total=$results->get();
            $results=$results->take($request->take); 
            $displayed=$results->get();

            $results=$results->get(); 

            //var_dump($results);
            $centres=Centre::all();
            foreach ($results as $result => $res)
            {
              $item = $res['c_pref1'];
              if($item !=NULL)
                  $results[$result]['c_pref1'] = $centres->filter(function($c_pref1) use ($item){if( $c_pref1->centre_code==$item ) return $c_pref1;})->first()->centre_name;
              $item = $res['c_pref2'];
              if($item !=NULL)
                  $results[$result]['c_pref2'] = $centres->filter(function($c_pref1) use ($item){if( $c_pref1->centre_code==$item ) return $c_pref1;})->first()->centre_name;
            }
            Session::put('url', URL::full());

            return view($this->content.'candidates.generate_roll', compact('results', 'paginator', 'exams', 'centre_pref1', 'centre_pref2', 'total', 'centre_capacity', 'displayed'));
    }

    public function generateRoll_no(Request $request)
    {
        if(empty($request->c_pref1 || $request->c_pref2))
           return redirect()->route('admin.generate.roll_no')->with(array('message'=>'Centre Pref1 or Centre Pref2 is required!'));
        
        if(empty($request->take))
           return redirect()->route('admin.generate.roll_no')->with(array('message'=>'No. of take is required!'));

        if($request->exam_id != "" || $request->c_pref1 !='' || $request->c_pref2 !='' || $request->pin !='')
        {
            if($request->c_pref1 !='')
            {
                $results=CandidateInfo::join('exams', 'exams.id', '=', 'candidate_info.exam_id')
                                    ->join('step1', 'candidate_info.id', '=', 'step1.candidate_info_id')
                                    ->join('step2', 'candidate_info.id', '=', 'step2.candidate_info_id')
                                    ->where('candidate_info.reg_status', 'completed')
                                    ->where('candidate_info.exam_id', $request->exam_id)
                                    ->orderBy('candidate_info.paper_code', 'asc');
                $results->where('step1.c_pref1', $request->c_pref1)
                        ->where('candidate_info.rollno', '=', Null);
                $centre_code=$request->c_pref1;

                if($request->pin !=''){

                    //$results->where('step2.pin', $request->pin);
                    $results->whereNotIn('step2.pin', [791110,791113, 791111]);
                }

                if($request->paper_code !='')
                {
                      // $results2->where('candidate_info.paper_code', $request->paper_code);                       
                    if($request->paper_code =='voc')
                    {
                          $results->whereNotIn('candidate_info.paper_code', [20, 29]); 
                    } 

                    if($request->paper_code !='voc')
                    {
                       $results->where('candidate_info.paper_code', $request->paper_code);  
                    }
                }

            }    

            if($request->c_pref2 !='')
            {
                $data=CandidateInfo::join('exams', 'exams.id', '=', 'candidate_info.exam_id')
                                    ->join('step1', 'candidate_info.id', '=', 'step1.candidate_info_id')
                                    ->join('step2', 'candidate_info.id', '=', 'step2.candidate_info_id')
                                    ->where('step1.c_pref1', $request->c_pref2)
                                    ->where('candidate_info.exam_id', '=', $request->exam_id)
                                    ->where('candidate_info.rollno', '=', Null)
                                    ->where('candidate_info.reg_status', 'completed')->first();

                if(count($data) > 0)
                       return redirect()->route('admin.generate.roll_no')->with(array('message'=>'Centre Pref1 is not completed!'));                     

                $results=CandidateInfo::join('exams', 'exams.id', '=', 'candidate_info.exam_id')
                                    ->join('step1', 'candidate_info.id', '=', 'step1.candidate_info_id')
                                    ->join('step2', 'candidate_info.id', '=', 'step2.candidate_info_id')
                                    ->where('candidate_info.reg_status', 'completed')
                                    ->where('candidate_info.exam_id', $request->exam_id)
                                    ->where('candidate_info.exam_centre', $request->c_pref2)
                                    ->where('candidate_info.rollno', '!=', '')
                                    ->orderBy('candidate_info.paper_code', 'asc');   
        
                $centre_code=$request->c_pref2;

                $results2=CandidateInfo::join('exams', 'exams.id', '=', 'candidate_info.exam_id')
                                    ->join('step1', 'candidate_info.id', '=', 'step1.candidate_info_id')
                                    ->join('step2', 'candidate_info.id', '=', 'step2.candidate_info_id')
                                    ->where('candidate_info.reg_status', 'completed')
                                    ->where('candidate_info.rollno', '=', Null)
                                    ->where('step1.c_pref2', $request->c_pref2)
                                    ->where('candidate_info.exam_id', $request->exam_id)
                                    ->orderBy('candidate_info.paper_code', 'asc');
                if($request->pin !='')
                    $results2->where('step2.pin', $request->pin); 

                if($request->paper_code !='')
                {
                      // $results2->where('candidate_info.paper_code', $request->paper_code);                       
                    if($request->paper_code =='voc')
                    {
                          $results->whereNotIn('candidate_info.paper_code', [20, 29]); 
                    } 

                    if($request->paper_code !='voc')
                    {
                       $results->where('candidate_info.paper_code', $request->paper_code);  
                    }
                }
            }    

            
        }
                                  
        $exam_id  =$request->exam_id;                            
        $centre =Centre::where('centre_code', $centre_code)->first();

        if($exam_id==1)
        {
            $roll=$centre->NEEI;
            $exam='NEEI';
        }    
            
        if($exam_id==2){
            $roll=$centre->NEEII;
            $exam='NEEII';
        }

        if($exam_id==3){
            $roll=$centre->NEEIII;
            $exam='NEEIII';
        }

        if($request->c_pref1 !='')
        {
            $results->select('candidate_info.id', 'candidate_info.rollno', 'candidate_info.exam_id', 'step1.c_pref1', 'step1.c_pref2', 'candidate_info.paper_code');
            $results->take($request->take);
            $result=$results->get();
        }    
              

        if($request->c_pref2 !='')
        {
            $results->select('candidate_info.id', 'candidate_info.rollno', 'candidate_info.exam_id', 'step1.c_pref1', 'step1.c_pref2', 'candidate_info.paper_code');
            $results2->select('candidate_info.id', 'candidate_info.rollno', 'candidate_info.exam_id', 'step1.c_pref1', 'step1.c_pref2', 'candidate_info.paper_code');
            $results->take($roll);
            $results2->take($request->take);  
            $roll=0;
            $results=$results->get();
            $results2=$results2->get();
           //dump($results2);
            $result = [];
            foreach($results as $k => $v) {
                $result[$k]['id'] = $v->id;
                $result[$k]['rollno'] = $v->rollno;
                $result[$k]['exam_id'] = $v->exam_id;
                $result[$k]['c_pref1'] = $v->c_pref1;
                $result[$k]['c_pref2'] = $v->c_pref2;
                $result[$k]['paper_code'] = $v->paper_code;
            }

            foreach($results2 as $k => $v) {
                $result[count($results)+$k]['id'] = $v->id;
                $result[count($results)+$k]['rollno'] = $v->rollno;
                $result[count($results)+$k]['exam_id'] = $v->exam_id;
                $result[count($results)+$k]['c_pref1'] = $v->c_pref1;
                $result[count($results)+$k]['c_pref2'] = $v->c_pref2;
                $result[count($results)+$k]['paper_code'] = $v->paper_code;
            }

            $sort_col=[];
            $col='id';
            foreach ($result as $key=> $row) {
              $sort_col[$key] = $row[$col];
            }

            $result=CandidateInfo::whereIn('id', $sort_col)->orderBy('paper_code', 'asc')->get();

        } 
        
        foreach ($result as $ress => $res) {
        $centres =new Centre();

        if($request->c_pref1!='')
        {
           $c_pref=$request->c_pref1;   
        } 

        if($request->c_pref2!='')
        {
           $c_pref=$request->c_pref2;
        } 

        if(strlen($c_pref) < 2)
        {
           $c_pref='0'.$c_pref;
        } 

        $roll=$roll+1;
        $centres->where('centre_code', $centre_code)
                    ->update([$exam => $roll]);

        if(strlen($roll)==1)
            $roll="000".$roll;

        if(strlen($roll)==2)
            $roll="00".$roll;

        if(strlen($roll)==3)
            $roll="0".$roll;

        if(strlen($roll)==4)
            $roll=$roll;

        $roll_no = $res->exam_id.$c_pref.$res->paper_code.$roll;

        $candidate_info = CandidateInfo::findOrFail($res->id);
        $candidate_info->rollno = $roll_no;
        $candidate_info->exam_centre = $centre_code;
        $candidate_info->save();
      }
      
      return redirect()->route('admin.generate.roll_no')->with(array('message'=>'Roll no. successfully generated!'));
    }

    public function roll_no_list()
    {
        
        $exams =[''=>'-Exam Level-'] + Exam::lists('exam_name', 'id')->toArray(); 
        $centre_pref1=[''=>'--Centre--'] + Centre::lists('centre_name', 'centre_code')->toArray();
        
        return view($this->content.'candidates.roll_no_list', compact('exams', 'centre_pref1', 'total'));
    }

    public function showRollList(Request $request)
    {
        if(empty($request->c_pref1))
           return redirect()->route('admin.candidate.roll_no_list')->with(array('message'=>'Centre Pref1 or Centre Pref2 is required!'));

            $results=CandidateInfo::join('exams', 'exams.id', '=', 'candidate_info.exam_id')
                                    ->join('candidates', 'candidates.id', '=', 'candidate_info.candidate_id')
                                    ->join('step1', 'candidate_info.id', '=', 'step1.candidate_info_id')
                                    ->join('step2', 'candidate_info.id', '=', 'step2.candidate_info_id')
                                    ->join('orders', 'candidate_info.id', '=', 'orders.candidate_info_id')
                                    ->where('orders.status', 'SUCCESS')
                                    ->where('candidate_info.rollno', '!=', '')
                                    ->where('candidate_info.reg_status', 'completed')
                                    ->orderBy('candidate_info.rollno', 'asc');
            if($request->exam_id != "" || $request->c_pref1 !='' || $request->pin !='')
            {
            if($request->exam_id !='')
                $results->where('candidate_info.exam_id', $request->exam_id);

            if($request->c_pref1 !='')
            {
                $centre_code=$request->c_pref1;
                // $results->where(function ($query) use($centre_code){
                //             $query->where('step1.c_pref1', $centre_code)
                //             ->orwhere('step1.c_pref2', $centre_code);
                //         })->get();
                $results->where('candidate_info.exam_centre', $centre_code);
            }    

            if($request->pin !='')
                $results->where('step2.pin', $request->pin);
            }

            $centre =Centre::join('centre_capacities', 'centres.centre_code', '=', 'centre_capacities.centre_code')
                            ->where('centres.centre_code', $centre_code)->first();
            
            $centre_capacity=$centre->centre_capacity;    
            $nee_i=$centre->NEEI;
            $nee_ii=$centre->NEEII;
            $nee_iii=$centre->NEEIII;

            if($request->exam_id==1)
                $centre_capacity=$centre_capacity-$nee_i;

            if($request->exam_id==2 || $request->exam_id==3)
                $centre_capacity=$centre_capacity-($nee_ii+$nee_iii);

            $exams =[''=>'-Exam Level-'] + Exam::lists('exam_name', 'id')->toArray(); 
            $centre_pref1=[''=>'--Centre--'] + Centre::lists('centre_name', 'centre_code')->toArray();
            //$centre_pref2=[''=>'-Centre Pref2-'] + Centre::lists('centre_name', 'centre_code')->toArray();
            $results->select('candidate_info.id', 'exams.exam_name', 'step2.name', 'candidate_info.form_no','candidate_info.id as info_id', 'orders.trans_type', 'orders.order_info', 'candidate_info.created_at', 'candidates.mobile_no', 'step1.c_pref1', 'step1.c_pref2', 'candidate_info.centre_capacities_id', 'candidate_info.rollno');
            
            $total=$results->get();
            $displayed=$results->get();

            $results=$results->get(); 
            $centres=Centre::all();

            return view($this->content.'candidates.roll_no_list', compact('results', 'paginator', 'exams', 'centre_pref1', 'centre_pref2', 'total', 'centre_capacity', 'displayed'));
    }

    public function showCentreAllocation()
    {
        
        $exams =[''=>'-Exam Level-'] + Exam::lists('exam_name', 'id')->toArray(); 
        $centre_pref1=[''=>'-Centre Pref1-'] + Centre::lists('centre_name', 'centre_code')->toArray();
        $centre_locations=[''=>'---Centre Location---'] + CentreCapacity::lists('centre_location', 'id')->toArray();
        return view($this->content.'candidates.allocate_centre', compact('exams', 'centre_pref1', 'total', 'centre_locations'));
    }

    public function searchCentre(Request $request)
    {

        if(empty($request->c_pref1))
           return redirect()->route('admin.candidate.allocate_centre')->with(array('message'=>'Centre Pref1 or Centre Pref2 is required!'));

        if(empty($request->take))
           return redirect()->route('admin.candidate.allocate_centre')->with(array('message'=>'No. of take is required!'));
        
            $results=CandidateInfo::join('exams', 'exams.id', '=', 'candidate_info.exam_id')
                                    ->join('candidates', 'candidates.id', '=', 'candidate_info.candidate_id')
                                    ->join('step1', 'candidate_info.id', '=', 'step1.candidate_info_id')
                                    ->join('step2', 'candidate_info.id', '=', 'step2.candidate_info_id')
                                    ->join('orders', 'candidate_info.id', '=', 'orders.candidate_info_id')
                                    ->where('orders.status', 'SUCCESS')
                                    ->where('candidate_info.rollno', '!=', '')
                                    ->where('candidate_info.centre_capacities_id', '=', Null)
                                    ->where('candidate_info.reg_status', 'completed')
                                    ->orderBy('candidate_info.rollno', 'asc');          
            if($request->exam_id != "" || $request->c_pref1 !='' || $request->pin !='')
            {
            if($request->exam_id !='')
                $results->where('candidate_info.exam_id', $request->exam_id);

            if($request->c_pref1 !='')
            {
                $centre_code=$request->c_pref1;
                // $results->where(function ($query) use($centre_code){
                //             $query->where('step1.c_pref1', $centre_code)
                //             ->orwhere('step1.c_pref2', $centre_code);
                //         });
                $results->where('candidate_info.exam_centre', $centre_code);
            }    

            if($request->pin !='')
            {
                $results->where('step2.pin', $request->pin);
                //$results->whereNotIn('step2.pin', [791110,791113, 791111]);
            }
                //$results->where('step2.pin', $request->pin);

                if($request->paper_code !='')
                {
                      // $results2->where('candidate_info.paper_code', $request->paper_code);                       
                    if($request->paper_code =='voc')
                    {
                          $results->whereNotIn('candidate_info.paper_code', [20, 29]); 
                    } 

                    if($request->paper_code !='voc')
                    {
                       $results->where('candidate_info.paper_code', $request->paper_code);  
                    }
                }
            }

            $centre =Centre::join('centre_capacities', 'centres.centre_code', '=', 'centre_capacities.centre_code')
                            ->where('centres.centre_code', $centre_code)->first();
            $centre_capacity=$centre->centre_capacity;    
            $nee_i=$centre->NEEI;
            $nee_ii=$centre->NEEII;
            $nee_iii=$centre->NEEIII;

            if($request->exam_id==1)
                $centre_capacity=$centre_capacity-$nee_i;

            if($request->exam_id==2 || $request->exam_id==3)
                $centre_capacity=$centre_capacity-($nee_ii+$nee_iii);                

            $location_capacities=CentreCapacity::join('centres', 'centres.centre_code', '=', 'centre_capacities.centre_code') 
                                    ->where('id', $request->centre_location)->first(); 

            $location_capacity=$location_capacities->centre_capacity;
            $neei=$location_capacities->NEEI;
            $neeii=$location_capacities->NEEII;
            $neeiii=$location_capacities->NEEIII;

            if($request->exam_id==1)
                $location_capacity=$location_capacity-$neei;

            if($request->exam_id==2 || $request->exam_id==3)
                $location_capacity=$location_capacity-($neeii+$neeiii);    

            $exams =[''=>'-Exam Level-'] + Exam::lists('exam_name', 'id')->toArray(); 
            $centre_pref1=[''=>'-Centre Pref1-'] + Centre::lists('centre_name', 'centre_code')->toArray();
            $centre_locations=[''=>'---Centre Location---'] + CentreCapacity::lists('centre_location', 'id')->toArray();
            $results->select('candidate_info.id', 'candidate_info.rollno', 'exams.exam_name', 'step2.name', 'candidate_info.form_no','candidate_info.id as info_id', 'orders.trans_type', 'orders.order_info', 'candidate_info.created_at', 'candidates.mobile_no', 'step1.c_pref1', 'step1.c_pref2', 'candidate_info.centre_capacities_id', 'candidate_info.paper_code', 'pin');
            
            $total=$results->get();
            $results=$results->take($request->take); 
            $displayed=$results->get();

            $results=$results->get(); 
            $centres=Centre::all();
            foreach ($results as $result => $res)
            {
              $item = $res['c_pref1'];
              if($item !=NULL)
                  $results[$result]['c_pref1'] = $centres->filter(function($c_pref1) use ($item){if( $c_pref1->centre_code==$item ) return $c_pref1;})->first()->centre_name;
            }
            Session::put('url', URL::full());

            return view($this->content.'candidates.allocate_centre', compact('results', 'paginator', 'exams', 'centre_pref1', 'centre_pref2', 'total', 'centre_capacity', 'displayed', 'centre_locations', 'location_capacity'));
    }


    public function doCentreAllocation(Request $request)
    {
        if(empty($request->c_pref1))
           return redirect()->route('admin.candidate.allocate_centre')->with(array('message'=>'Centre Pref1 or Centre Pref2 is required!'));
        
        if(empty($request->take))
           return redirect()->route('admin.candidate.allocate_centre')->with(array('message'=>'No. of take is required!'));

        $results=CandidateInfo::join('exams', 'exams.id', '=', 'candidate_info.exam_id')
                                    ->join('step1', 'candidate_info.id', '=', 'step1.candidate_info_id')
                                    ->join('step2', 'candidate_info.id', '=', 'step2.candidate_info_id')
                                    ->take($request->take)
                                    ->where('candidate_info.reg_status', 'completed')
                                    ->where('candidate_info.centre_capacities_id', '=', Null)
                                    ->where('candidate_info.rollno', '!=', '')
                                    ->orderBy('candidate_info.rollno', 'asc');

        if($request->exam_id != "" || $request->c_pref1 !='' || $request->centre_location !='' || $request->pin !='')
        {
            if($request->exam_id !='')
                $results->where('candidate_info.exam_id', $request->exam_id);

            if($request->c_pref1 !='')
            {
                $centre_code=$request->c_pref1;
                // $results->where(function ($query) use($centre_code){
                //             $query->where('step1.c_pref1', $centre_code)
                //             ->orwhere('step1.c_pref2', $centre_code);
                // });
                $results->where('candidate_info.exam_centre', $centre_code);
            }

            if($request->pin !=''){
                $results->where('step2.pin', $request->pin);
                //$results->whereNotIn('step2.pin', [791110,791113, 791111]);
            }

            if($request->paper_code !='')
                {
                      // $results2->where('candidate_info.paper_code', $request->paper_code);                       
                    if($request->paper_code =='voc')
                    {
                          $results->whereNotIn('candidate_info.paper_code', [20, 29]); 
                    } 

                    if($request->paper_code !='voc')
                    {
                       $results->where('candidate_info.paper_code', $request->paper_code);  
                    }
                }
        

        $results->select('candidate_info.id', 'candidate_info.rollno', 'candidate_info.exam_id', 'step1.c_pref1', 'step1.c_pref2', 'candidate_info.paper_code');
        $results=$results->get(); 

        $centre_location =CentreCapacity::where('centre_code', $centre_code)
                            ->where('id', $request->centre_location)->first();

        foreach ($results as $result => $res) {
        $candidate_info =new CandidateInfo();
        $candidate_info->where('id', $res->id)
                        ->update(['centre_capacities_id' => $centre_location->id]);
        }

        return redirect()->route('admin.candidate.allocate_centre')->with(array('message'=>'Centre is successfully allocated!'));
     }
      return redirect()->route('admin.candidate.allocate_centre')->with(array('message'=>'Error while allocating centre location!'));
    }

    public function admit_card_list()
    {
        
        $exams =[''=>'-Exam Level-'] + Exam::lists('exam_name', 'id')->toArray(); 
        $centre_pref1=[''=>'--Centre--'] + Centre::lists('centre_name', 'centre_code')->toArray();
        $centre_locations=[''=>'---Centre Location---'] + CentreCapacity::lists('centre_location', 'id')->toArray();        
        return view($this->content.'candidates.admit_card_list', compact('exams', 'centre_pref1', 'total', 'centre_locations'));
    }

    public function showAdmitCardList(Request $request)
    {
        if(empty($request->c_pref1))
           return redirect()->route('admin.candidate.admit_card_list')->with(array('message'=>'Centre Pref1 or Centre Pref2 is required!'));

            $results=CandidateInfo::join('exams', 'exams.id', '=', 'candidate_info.exam_id')
                                    ->join('candidates', 'candidates.id', '=', 'candidate_info.candidate_id')
                                    ->join('centre_capacities', 'centre_capacities.id', '=', 'candidate_info.centre_capacities_id')
                                    ->join('step1', 'candidate_info.id', '=', 'step1.candidate_info_id')
                                    ->join('step2', 'candidate_info.id', '=', 'step2.candidate_info_id')
                                    ->join('orders', 'candidate_info.id', '=', 'orders.candidate_info_id')
                                    ->where('orders.status', 'SUCCESS')
                                    ->where('candidate_info.rollno', '!=', '')
                                    ->where('candidate_info.centre_capacities_id', '!=', '')
                                    ->where('candidate_info.reg_status', 'completed')
                                    ->orderBy('candidate_info.rollno', 'asc');
            
            if($request->exam_id != "" || $request->c_pref1 !='' || $request->pin !='')
            {
            if($request->exam_id !='')
                $results->where('candidate_info.exam_id', $request->exam_id);

            if($request->c_pref1 !='')
            {
                $centre_code=$request->c_pref1;
                // $results->where(function ($query) use($centre_code){
                //             $query->where('step1.c_pref1', $centre_code)
                //             ->orwhere('step1.c_pref2', $centre_code);
                //         });
                $results->where('candidate_info.exam_centre', $centre_code);
            } 

            if($request->centre_location !='')
                $results->where('candidate_info.centre_capacities_id', $request->centre_location);   

            if($request->pin !='')
                $results->where('step2.pin', $request->pin);
            }

            $centre =Centre::join('centre_capacities', 'centres.centre_code', '=', 'centre_capacities.centre_code')
                            ->where('centres.centre_code', $centre_code)->first();
            
            $centre_capacity=$centre->centre_capacity;    
            $nee_i=$centre->NEEI;
            $nee_ii=$centre->NEEII;
            $nee_iii=$centre->NEEIII;

            if($request->exam_id==1)
                $centre_capacity=$centre_capacity-$nee_i;

            if($request->exam_id==2 || $request->exam_id==3)
                $centre_capacity=$centre_capacity-($nee_ii+$nee_iii);

            $exams =[''=>'-Exam Level-'] + Exam::lists('exam_name', 'id')->toArray(); 
            $centre_pref1=[''=>'-Centre Pref1-'] + Centre::lists('centre_name', 'centre_code')->toArray();
            $centre_locations=[''=>'---Centre Location---'] + CentreCapacity::lists('centre_location', 'id')->toArray();
            $results->select('candidate_info.id', 'exams.exam_name', 'step2.name', 'candidate_info.form_no','candidate_info.id as info_id', 'orders.trans_type', 'orders.order_info', 'candidate_info.created_at', 'candidates.mobile_no', 'step1.c_pref1', 'step1.c_pref2', 'candidate_info.centre_capacities_id', 'candidate_info.rollno');
            
            $total=$results->get();
            $displayed=$results->get();

            $results=$results->get(); 
            $centres=Centre::all();
            $centre_capacities=CentreCapacity::all();
            foreach ($results as $result => $res)
            {
              $item = $res['c_pref1'];
              if($item !=NULL)
                  $results[$result]['c_pref1'] = $centres->filter(function($c_pref1) use ($item){if( $c_pref1->centre_code==$item ) return $c_pref1;})->first()->centre_name;
              $item = $res['centre_capacities_id'];
              if($item !=NULL)
                  $results[$result]['centre_capacities_id'] = $centre_capacities->filter(function($centre_capacity) use ($item){if( $centre_capacity->id==$item ) return $centre_capacity;})->first()->centre_location;
            }

            return view($this->content.'candidates.admit_card_list', compact('results', 'paginator', 'exams', 'centre_pref1', 'total', 'centre_capacity', 'displayed', 'centre_locations'));
    }

    public function rollsheet()
    {
        $exams =[''=>'-Exam Level-'] + Exam::lists('exam_name', 'id')->toArray(); 
        $centre_pref1=[''=>'--Centre--'] + Centre::lists('centre_name', 'centre_code')->toArray();
        $centre_locations=[''=>'---Centre Location---'] + CentreCapacity::lists('centre_location', 'id')->toArray();        
        return view($this->content.'rollsheet.form', compact('exams', 'centre_pref1', 'total', 'centre_locations'));
    }

    public function showRollSheet(Request $request)
    {
        if(empty($request->c_pref1))
           return redirect()->route('admin.rollsheet')->with(array('message'=>'Centre Pref1 or Centre Pref2 is required!'));

            $results=CandidateInfo::join('exams', 'exams.id', '=', 'candidate_info.exam_id')
                                    ->join('candidates', 'candidates.id', '=', 'candidate_info.candidate_id')
                                    ->join('centre_capacities', 'centre_capacities.id', '=', 'candidate_info.centre_capacities_id')
                                    ->join('step1', 'candidate_info.id', '=', 'step1.candidate_info_id')
                                    ->join('step2', 'candidate_info.id', '=', 'step2.candidate_info_id')
                                    ->join('step3', 'candidate_info.id', '=', 'step3.candidate_info_id')
                                    ->join('orders', 'candidate_info.id', '=', 'orders.candidate_info_id')
                                    ->where('orders.status', 'SUCCESS')
                                    ->where('candidate_info.rollno', '!=', '')
                                    ->where('candidate_info.centre_capacities_id', '!=', '')
                                    ->where('candidate_info.reg_status', 'completed')
                                    ->orderBy('candidate_info.rollno', 'asc');
            
            if($request->exam_id != "" || $request->c_pref1 !='' || $request->pin !='')
            {
            if($request->exam_id !='')
                $results->where('candidate_info.exam_id', $request->exam_id);

            if($request->c_pref1 !='')
            {
                $centre_code=$request->c_pref1;
                // $results->where(function ($query) use($centre_code){
                //             $query->where('step1.c_pref1', $centre_code)
                //             ->orwhere('step1.c_pref2', $centre_code);
                //         });
                $results->where('candidate_info.exam_centre', $centre_code);
            } 

            if($request->centre_location !='')
                $results->where('candidate_info.centre_capacities_id', $request->centre_location);   

            if($request->pin !='')
                $results->where('step2.pin', $request->pin);
            }

            $centre =Centre::join('centre_capacities', 'centres.centre_code', '=', 'centre_capacities.centre_code')
                            ->where('centres.centre_code', $centre_code)->first();
            
            $centre_capacity=$centre->centre_capacity;    
            $nee_i=$centre->NEEI;
            $nee_ii=$centre->NEEII;
            $nee_iii=$centre->NEEIII;

            if($request->exam_id==1)
                $centre_capacity=$centre_capacity-$nee_i;

            if($request->exam_id==2 || $request->exam_id==3)
                $centre_capacity=$centre_capacity-($nee_ii+$nee_iii);

            $exams =[''=>'-Exam Level-'] + Exam::lists('exam_name', 'id')->toArray(); 
            $centre_pref1=[''=>'-Centre Pref1-'] + Centre::lists('centre_name', 'centre_code')->toArray();
            $centre_locations=[''=>'---Centre Location---'] + CentreCapacity::lists('centre_location', 'id')->toArray();
            $results->select('candidate_info.id', 'step3.photo', 'step3.signature', 'step1.dob', 'step1.reservation_code', 'exams.exam_name', 'step2.name', 'candidate_info.form_no','candidate_info.id as info_id', 'orders.trans_type', 'orders.order_info', 'candidate_info.created_at', 'candidates.mobile_no', 'step1.c_pref1', 'step1.c_pref2', 'candidate_info.centre_capacities_id', 'candidate_info.rollno', 'candidate_info.paper_code');
            
            $total=$results->get();
            $displayed=$results->get();

            $results=$results->get(); 
            $centres=Centre::all();
            $centre_capacities=CentreCapacity::all();
            foreach ($results as $result => $res)
            {
              $item = $res['c_pref1'];
              if($item !=NULL)
                  $results[$result]['c_pref1'] = $centres->filter(function($c_pref1) use ($item){if( $c_pref1->centre_code==$item ) return $c_pref1;})->first()->centre_name;
              $item = $res['centre_capacities_id'];
              if($item !=NULL)
                  $results[$result]['centre_capacities_id'] = $centre_capacities->filter(function($centre_capacity) use ($item){if( $centre_capacity->id==$item ) return $centre_capacity;})->first()->centre_location;
            }
            $center=CentreCapacity::where('id', $request->centre_location)->first();
            $exam=Exam::where('id', $request->exam_id)->first();


            return view($this->content.'rollsheet.generate', compact('results', 'paginator', 'exams', 'centre_pref1', 'total', 'centre_capacity', 'displayed', 'centre_locations', 'center', 'exam'));
    }

    public function seat_label()
    {
        $exams =[''=>'-Exam Level-'] + Exam::lists('exam_name', 'id')->toArray(); 
        $centre_pref1=[''=>'--Centre--'] + Centre::lists('centre_name', 'centre_code')->toArray();
        $centre_locations=[''=>'---Centre Location---'] + CentreCapacity::lists('centre_location', 'id')->toArray();        
        return view($this->content.'seatlabel.form', compact('exams', 'centre_pref1', 'total', 'centre_locations'));
    }

    public function showSeat_label(Request $request)
    {
        if(empty($request->c_pref1))
           return redirect()->route('admin.seat_label')->with(array('message'=>'Centre Pref1 or Centre Pref2 is required!'));

            $results=CandidateInfo::join('exams', 'exams.id', '=', 'candidate_info.exam_id')
                                    ->join('candidates', 'candidates.id', '=', 'candidate_info.candidate_id')
                                    ->join('centre_capacities', 'centre_capacities.id', '=', 'candidate_info.centre_capacities_id')
                                    ->join('step1', 'candidate_info.id', '=', 'step1.candidate_info_id')
                                    ->join('step2', 'candidate_info.id', '=', 'step2.candidate_info_id')
                                    ->join('step3', 'candidate_info.id', '=', 'step3.candidate_info_id')
                                    ->join('orders', 'candidate_info.id', '=', 'orders.candidate_info_id')
                                    ->where('orders.status', 'SUCCESS')
                                    ->where('candidate_info.rollno', '!=', '')
                                    ->where('candidate_info.centre_capacities_id', '!=', '')
                                    ->where('candidate_info.reg_status', 'completed')
                                    ->orderBy('candidate_info.rollno', 'asc');
            
            if($request->exam_id != "" || $request->c_pref1 !='' || $request->pin !='')
            {
            if($request->exam_id !='')
                $results->where('candidate_info.exam_id', $request->exam_id);

            if($request->c_pref1 !='')
            {
                $centre_code=$request->c_pref1;
                // $results->where(function ($query) use($centre_code){
                //             $query->where('step1.c_pref1', $centre_code)
                //             ->orwhere('step1.c_pref2', $centre_code);
                //         });
                $results->where('candidate_info.exam_centre', $centre_code);
            } 

            if($request->centre_location !='')
                $results->where('candidate_info.centre_capacities_id', $request->centre_location);   

            if($request->pin !='')
                $results->where('step2.pin', $request->pin);
            }

            $centre =Centre::join('centre_capacities', 'centres.centre_code', '=', 'centre_capacities.centre_code')
                            ->where('centres.centre_code', $centre_code)->first();
            
            $centre_capacity=$centre->centre_capacity;    
            $nee_i=$centre->NEEI;
            $nee_ii=$centre->NEEII;
            $nee_iii=$centre->NEEIII;

            if($request->exam_id==1)
                $centre_capacity=$centre_capacity-$nee_i;

            if($request->exam_id==2 || $request->exam_id==3)
                $centre_capacity=$centre_capacity-($nee_ii+$nee_iii);

            $exams =[''=>'-Exam Level-'] + Exam::lists('exam_name', 'id')->toArray(); 
            $centre_pref1=[''=>'-Centre Pref1-'] + Centre::lists('centre_name', 'centre_code')->toArray();
            $centre_locations=[''=>'---Centre Location---'] + CentreCapacity::lists('centre_location', 'id')->toArray();
            $results->select('candidate_info.id', 'step3.photo', 'step3.signature', 'step1.dob', 'step1.reservation_code', 'exams.exam_name', 'step2.name', 'candidate_info.form_no','candidate_info.id as info_id', 'orders.trans_type', 'orders.order_info', 'candidate_info.created_at', 'candidates.mobile_no', 'step1.c_pref1', 'step1.c_pref2', 'candidate_info.centre_capacities_id', 'candidate_info.rollno');
            
            $total=$results->get();
            $displayed=$results->get();

            $results=$results->get(); 
            $centres=Centre::all();
            $centre_capacities=CentreCapacity::all();
            foreach ($results as $result => $res)
            {
              $item = $res['c_pref1'];
              if($item !=NULL)
                  $results[$result]['c_pref1'] = $centres->filter(function($c_pref1) use ($item){if( $c_pref1->centre_code==$item ) return $c_pref1;})->first()->centre_name;
              $item = $res['centre_capacities_id'];
              if($item !=NULL)
                  $results[$result]['centre_capacities_id'] = $centre_capacities->filter(function($centre_capacity) use ($item){if( $centre_capacity->id==$item ) return $centre_capacity;})->first()->centre_location;
            }
            $center=CentreCapacity::where('id', $request->centre_location)->first();
            $exam=Exam::where('id', $request->exam_id)->first();
            return view($this->content.'seatlabel.generate', compact('results', 'paginator', 'exams', 'centre_pref1', 'total', 'centre_capacity', 'displayed', 'centre_locations', 'center', 'exam'));
    }

    public function admit_card($info_id)
    {
            $step1  =   Step1::where('candidate_info_id', $info_id)->firstOrFail();
            $step2  =   Step2::where('candidate_info_id', $info_id)->firstOrFail();
            $step3  =   Step3::where('candidate_info_id', $info_id)->firstOrFail();
            $candidate_info    = CandidateInfo::where('id', $info_id)->firstOrFail();
            $candidate  = Candidate::where('id', $candidate_info->candidate_id)->firstOrFail();
            $order = Order::where('candidate_info_id', $info_id)->where('status', 'SUCCESS')->orderBy('id', 'desc')->first();
            
            $exam_name= Basehelper::getExam($candidate_info->exam_id);
            $exam_date= Basehelper::getExamDate($candidate_info->exam_id);
            $step1->category= Basehelper::getCategory($step1->reservation_code);
            $step1->quota= Basehelper::getQuota($step1->quota);
            $candidate_info->q_id=Basehelper::getQualification($candidate_info->q_id);
            $step1->admission_in= Basehelper::getAdmissionIn($step1->admission_in);
            $step2->state= Basehelper::getState($step2->state);
            $step2->district= Basehelper::getDistrict($step2->district);
            $amount=Basehelper::getPayableAmount($info_id);
            $centre_locations=CentreCapacity::join('centres', 'centres.centre_code', '=', 'centre_capacities.centre_code')
                                        ->where('centre_capacities.id', $candidate_info->centre_capacities_id)->first();                                   
            $centre_code=$centre_locations->centre_code;
            $centre_name= Basehelper::getCentre($centre_code);
            $candidate_info->centre_capacities_id=$centre_locations->centre_location;

            if(strlen($centre_code) < 2)
                $centre_code="0".$centre_code;

            $registration_no= Basehelper::getRegistrationNo($info_id);
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
            return view($this->content.'candidates.admit_card', compact('step1', 'step2', 'step3', 'candidate', 'candidate_info', 'order', 'amount', 'registration_no', 'exam_date', 'exam_name', 'subject', 'sub_type', 'centre_code', 'centre_name'));
    }

    public function list_user()
    {
        $result=CandidateInfo::join('exams', 'exams.id', '=', 'candidate_info.exam_id')
                                    ->join('candidates', 'candidates.id', '=', 'candidate_info.candidate_id')
                                    ->join('step2', 'candidate_info.id', '=', 'step2.candidate_info_id')
                                    //->join('orders', 'candidate_info.id', '=', 'orders.candidate_info_id')
                                    //->where('orders.status', 'SUCCESS')
                                    ->where('candidate_info.reg_status', 'payment_pending')
                                    ->select('candidates.id','candidate_info.id' ,'exams.exam_name', 'step2.name', 'candidate_info.form_no','candidate_info.id as info_id', 'candidate_info.created_at', 'candidates.mobile_no', 'candidates.email');
        if(count($result) > 0)                 
              Session::put('info_id', $result->lists('id'));
        $result=$result->paginate();                            
        $paginator=0;
        $paginator=$result->currentPage();
        Session::put('url', URL::full());

        return view($this->content.'candidates.preview_user', compact('result', 'paginator'));
    }

    public function preview_confirmation($info_id)
    {
            $step1  =   Step1::where('candidate_info_id', $info_id)->firstOrFail();
            $step2  =   Step2::where('candidate_info_id', $info_id)->firstOrFail();
            $step3  =   Step3::where('candidate_info_id', $info_id)->firstOrFail();
            $candidate_info    = CandidateInfo::where('id', $info_id)->firstOrFail();
            $candidate  = Candidate::where('id', $candidate_info->candidate_id)->firstOrFail();
            //$order = Order::where('candidate_info_id', $info_id)->where('status', 'PENDING')->orderBy('id', 'desc')->first();

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
            $amount=Basehelper::getPayableAmount($info_id);

            $registration_no= Basehelper::getRegistrationNo($info_id);
            $step1->voc_subject= Basehelper::getVocSubject($step1->voc_subject);

            if($step1->branch == NULL)
                $step1->branch = 'NA';

            if($step1->allied_branch == NULL)
                $step1->allied_branch = 'NA';

            if($step1->voc_subject == NULL)
                $step1->voc_subject = 'NA';

            return view($this->content.'candidates.preview_comfirmation', compact('step1', 'step2', 'step3', 'candidate', 'candidate_info', 'order', 'amount', 'registration_no'));

    }


    public function searchCandidate(Request $request)
    {
        if($request->type != "")
        {
            $results=CandidateInfo::join('exams', 'exams.id', '=', 'candidate_info.exam_id')
                                    ->join('candidates', 'candidates.id', '=', 'candidate_info.candidate_id')
                                    ->join('step2', 'candidate_info.id', '=', 'step2.candidate_info_id')
                                    //->join('orders', 'candidate_info.id', '=', 'orders.candidate_info_id')
                                    //->where('orders.status', 'SUCCESS')
                                    ->where('candidate_info.reg_status', 'payment_pending');
            //dd($results);                        
            if($request->type =="form_no")
                $results->where('candidate_info.'.$request->type, $request->value);

            if($request->type =="mobile_no")
                $results->where('candidates.'.$request->type, $request->value);

            if($request->type =="name")
                $results->where('step2.'.$request->type, 'like', "%".$request->value."%");

            //if($request->type =="order_info")
                //$results->where('orders.'.$request->type, $request->value);

            $results->select('candidate_info.id','exams.exam_name', 'step2.name', 'candidate_info.form_no','candidate_info.id as info_id', 'candidate_info.created_at', 'candidates.mobile_no');
            if(count($results) > 0)                 
              Session::put('info_id', $results->lists('id'));
            //dd($results);
            $result=$results->paginate();
            $paginator=0;
            $paginator=$result->currentPage();
            Session::put('url', URL::full());
            return view($this->content.'candidates.preview_user', compact('result', 'paginator'));                        
        }
    }

    public function challan_verification($info_id){

        try{
            $candidate_info=CandidateInfo::where('id', $info_id)->firstOrFail();
            $step1 = Step1::where('candidate_info_id', $info_id)->firstOrFail();
            $step2 = Step2::where('candidate_info_id', $info_id)->firstOrFail();
            $step3 = Step3::where('candidate_info_id', $info_id)->firstOrFail();
        }catch(ModelNotFoundException $e){

            return redirect()->route('candidate.error')->withErrors('Record not found!');
        }

        if($candidate_info->reg_status=="payment_pending"){
            $info_id=$info_id;
            return view($this->content.'candidates.challan_verification', compact('info_id'));
       }

        //return $this->getStep();

    }

    public function verify_challan(Request $request){

            $validator =Validator::make($data = $request->all(), ChallanInfo::$rules);

            if($validator->fails())
                return back()->withErrors($validator)->withInput();

            $info_id = $request->info_id;
            $transaction_id=$data['transaction_id'];
            $date=$data['transaction_date'];
            $date=Carbon::createFromFormat('d-m-Y', $date);
            $transaction_date=$date->format('Y-m-d');
            $candidate_info    = CandidateInfo::where('id', $info_id)->firstOrFail();
            $candidate  = Candidate::where('id', $candidate_info->candidate_id)->firstOrFail();

            $exist=Order::where('tansaction_id', $transaction_id)->where('transaction_date', $transaction_date)->get();
            //$candidate=Candidate::where('id', Auth::candidate()->get()->id)->firstOrFail();

            if(count($exist)!=0)
            {
                return back()->withErrors('The transaction is already used in another registration.<br/>Please provide the different transaction no.');
            }
            $challan_info=ChallanInfo::where('transaction_id', $transaction_id)->where('transaction_date', $transaction_date)->get();

            if(count($challan_info) > 0){

                $order= new Order();
                $order->candidate_info_id = $info_id;
                $order->description = 'challan payment';
                $order->trans_type = 'Challan';
                $order->mobile_no=$candidate->mobile_no;
                $order->email=$candidate->email;
                $order->order_id=$info_id;
                $order->order_info=$transaction_id;
                $amount=(Basehelper::getPayableAmount($info_id))+35;
                $order->amount =$amount;
                $order->status = 'SUCCESS';
                $order->tansaction_id = $transaction_id;
                $order->transaction_date = $transaction_date;
                $order->save();
                
                $candidate_info=CandidateInfo::where('id', $info_id)->first();
                $candidate_info->reg_status='completed';
                $candidate_info->save();
                $form_no=$candidate_info->form_no;
                //$message = 'Hello, your NEE Online form submission has been successfully completed. Your Form NO is '.$candidate_info->form_no;
                //Basehelper::sendSMS(Auth::candidate()->get()->mobile_no, $message);
                return redirect()->route('admin.access.user_account')->with(array('message'=>'Successfully verified. Form no. '.$form_no.''));
                //return redirect()->action('Candidate\RegistrationController@getStep');
            }

            return redirect()->route('admin.access.user_account')->with(array('message'=>'The Transaction ID and Transaction Date provided by you does not match!'));
    }

}
