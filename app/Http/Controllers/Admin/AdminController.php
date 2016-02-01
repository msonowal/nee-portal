<?php

namespace nee_portal\Http\Controllers\Admin;

use Illuminate\Http\Request;

use nee_portal\Http\Requests;
use nee_portal\Http\Controllers\Controller;
use nee_portal\Models\ChallanInfo;
use Session, URL, Validator, Basehelper;
use nee_portal\Models\CandidateInfo;
use nee_portal\Models\Candidate;
use nee_portal\Models\Step1;
use nee_portal\Models\Step2;
use nee_portal\Models\Step3;
use nee_portal\Models\Order;

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

        $paginator=0;

        $paginator=$result->currentPage();

        Session::put('url', URL::full());

        return view($this->content.'challan.import', compact('result', 'paginator'));
    }

    public function submittedForm()
    {
        $result=CandidateInfo::join('exams', 'exams.id', '=', 'candidate_info.exam_id')
                                    ->join('candidates', 'candidates.id', '=', 'candidate_info.candidate_id')
                                    ->join('step2', 'candidate_info.id', '=', 'step2.candidate_info_id')
                                    ->join('orders', 'candidate_info.id', '=', 'orders.candidate_info_id')
                                    ->where('orders.status', 'SUCCESS')
                                    ->where('candidate_info.reg_status', 'completed')
                                    ->select('exams.exam_name', 'step2.name', 'candidate_info.form_no','candidate_info.id as info_id', 'orders.trans_type', 'orders.order_info', 'candidate_info.created_at', 'candidates.mobile_no', 'candidates.email')
                                    ->paginate();

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
                                    ->select('exams.exam_name', 'step2.name', 'candidate_info.form_no','candidate_info.id as info_id', 'orders.trans_type', 'orders.order_info', 'candidate_info.created_at', 'candidates.mobile_no', 'candidates.email')
                                    ->paginate();

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
                                    ->select('exams.exam_name', 'step2.name', 'candidate_info.form_no','candidate_info.id as info_id', 'orders.trans_type', 'orders.order_info', 'candidate_info.created_at', 'candidates.mobile_no', 'candidates.email')
                                    ->paginate();

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
                                    ->select('exams.exam_name', 'step2.name', 'candidate_info.form_no','candidate_info.id as info_id', 'orders.trans_type', 'orders.order_info', 'candidate_info.created_at', 'candidates.mobile_no', 'candidates.email')
                                    ->paginate();

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
                                    ->select('exams.exam_name', 'step2.name', 'candidate_info.form_no','candidate_info.id as info_id', 'orders.trans_type', 'orders.order_info', 'candidate_info.created_at', 'candidates.mobile_no')
                                    ->paginate();

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
                                    ->where('orders.status', 'FAILURE')
                                    ->where('candidate_info.reg_status', 'payment_pending')
                                    ->select('exams.exam_name', 'step2.name', 'candidate_info.form_no','candidate_info.id as info_id', 'orders.trans_type', 'orders.order_info', 'candidate_info.created_at', 'candidates.mobile_no')
                                    ->paginate();

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

            $results->select('exams.exam_name', 'step2.name', 'candidate_info.form_no','candidate_info.id as info_id', 'orders.trans_type', 'orders.order_info', 'candidate_info.created_at', 'candidates.mobile_no');
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

            $results->select('exams.exam_name', 'step2.name', 'candidate_info.form_no','candidate_info.id as info_id', 'orders.trans_type', 'orders.order_info', 'candidate_info.created_at', 'candidates.mobile_no');
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

            $results->select('exams.exam_name', 'step2.name', 'candidate_info.form_no','candidate_info.id as info_id', 'orders.trans_type', 'orders.order_info', 'candidate_info.created_at', 'candidates.mobile_no');
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

            $results->select('exams.exam_name', 'step2.name', 'candidate_info.form_no','candidate_info.id as info_id', 'orders.trans_type', 'orders.order_info', 'candidate_info.created_at', 'candidates.mobile_no');
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
                                    ->where('orders.status', '!=' 'SUCCESS')
                                    ->where('candidate_info.reg_status', 'payment_pending');

            if($request->type =="form_no")
                $results->where('candidate_info.'.$request->type, $request->value);

            if($request->type =="mobile_no")
                $results->where('candidates.'.$request->type, $request->value);

            if($request->type =="name")
                $results->where('step2.'.$request->type, $request->value);

            if($request->type =="order_info")
                $results->where('orders.'.$request->type, $request->value);

            $results->select('exams.exam_name', 'step2.name', 'candidate_info.form_no','candidate_info.id as info_id', 'orders.trans_type', 'orders.order_info', 'candidate_info.created_at', 'candidates.mobile_no');
            $result=$results->paginate();
            $paginator=0;
            $paginator=$result->currentPage();
            Session::put('url', URL::full());
            return view($this->content.'candidates.transaction_failed', compact('result', 'paginator'));                        
        }
    }

}
