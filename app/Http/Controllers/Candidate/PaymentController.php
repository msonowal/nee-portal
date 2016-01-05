<?php

namespace nee_portal\Http\Controllers\Candidate;

use Illuminate\Http\Request;

use nee_portal\Http\Requests;
use nee_portal\Http\Controllers\Controller;
use Validator, Basehelper, Session, Carbon, Redirect;
use nee_portal\Models\ChallanInfo;
use nee_portal\Models\Step1;
use nee_portal\Models\Step2;
use nee_portal\Models\Step3;
use nee_portal\Models\CandidateInfo;
use nee_portal\Models\Candidate;

class PaymentController extends Controller
{
    private $content = 'candidate.application.';

    public function challanDetail(Request $request){

            $validator =Validator::make($data = $request->all(), ChallanInfo::$rules);

            if($validator->fails()){
                return back()->withErrors($validator)->withInput();
            }

            $transaction_id=$data['transaction_id'];
            $date=$data['transaction_date'];
            $date=Carbon::createFromFormat('d-m-Y', $date);
            $transaction_date=$date->format('Y-m-d');

            $challan_info=ChallanInfo::where('transaction_id', $transaction_id)->where('transaction_date', $transaction_date)->first();

            if(count($challan_info)){

                $candidate_info=CandidateInfo::where('id', $this->info_id)->first();
                $candidate_info->reg_status='completed';

                $candidate_info->save();

                return redirect()->action('Candidate\RegistrationController@getStep');
            }

            return redirect()->route($this->content.'challan')->withErrors('Dear Candidate the Transaction ID and Transaction Date provided by you does not match!');
    }

    public function debit_credit(){

        $info_id = Session::get('candidate_info_id');

        if(!Basehelper::checkSession())
            return redirect()->route($this->content.'dashboard');

        try{
            $candidate_info=CandidateInfo::where('id', $info_id)->first();
            $step1 = Step1::where('candidate_info_id', $info_id)->first();
            $step2 = Step2::where('candidate_info_id', $info_id)->first();
            $step3 = Step3::where('candidate_info_id', $info_id)->first();
        }catch(ModelNotFoundException $e){

            return redirect()->route('candidate.error')->withErrors('Record not found!');
        }

        if($candidate_info->reg_status=="payment_pending"){

            $Title='NEE Online Payment';
            $virtualPaymentClientURL='https://migs.mastercard.com.au/vpcpay';
            $vpc_Version=1;
            $vpc_Command='pay';
            $vpc_AccessCode='DCD4312A';
            $vpc_MerchTxnRef=$info_id;
            $vpc_Merchant='NERIST';
            $vpc_OrderInfo='NEE CreditDebit Pay';
            $vpc_Amount='200';
            $vpc_Locale='en';
            $vpc_ReturnURL='http://www.neeonline.ac.in/nee/candidate/vpc_php_serverhost_dr.php';

            return view($this->content.'debit_credit')->with([
                    'Title' =>$Title,
                    'virtualPaymentClientURL' =>$virtualPaymentClientURL,
                    'vpc_Version' =>$vpc_Version,
                    'vpc_Command' =>$vpc_Command,
                    'vpc_AccessCode' =>$vpc_AccessCode,
                    'vpc_MerchTxnRef' =>$vpc_MerchTxnRef,
                    'vpc_Merchant' =>$vpc_Merchant,
                    'vpc_OrderInfo' =>$vpc_OrderInfo,
                    'vpc_Amount' =>$vpc_Amount,
                    'vpc_Locale' =>$vpc_Locale,
                    'vpc_ReturnURL' =>$vpc_ReturnURL
                    ]);
       }

        return redirect()->action('Candidate\RegistrationController@getStep');
    }

    public function doServerhost(Request $request){

        $info_id = Session::get('candidate_info_id');

        if(!Basehelper::checkSession())
            return redirect()->route($this->content.'dashboard');

        try{
            $candidate=Candidate::where('id', Auth::candidate()->get()->id)->first();
            $candidate_info=CandidateInfo::where('id', $info_id)->first();
            $step1 = Step1::where('candidate_info_id', $info_id)->first();
            $step2 = Step2::where('candidate_info_id', $info_id)->first();
            $step3 = Step3::where('candidate_info_id', $info_id)->first();
        }catch(ModelNotFoundException $e){

            return redirect()->route('candidate.error')->withErrors('Record not found!');
        }

        if($candidate_info->reg_status=="payment_pending"){


        $data['candidate_info']=$info_id;
        $data['mobile_no']=$candidate->mobile_no;    
        $data['email']=$candidate->email;  
        $data['trans_type']='debit_credit';

        require('pgconfig.php');

        $md5HashData = $SECURE_SECRET;

        $vpcURL=$request->virtualPaymentClientURL.'?';

        $data=$request->except('virtualPaymentClientURL', '_token');

        ksort($data);

        $appendAmp = 0;

        foreach($data as $key => $value)
        {

           if (strlen($value) > 0)
           {
                if ($appendAmp == 0)
                {
                    $vpcURL .= urlencode($key) . '=' . urlencode($value);
                    $appendAmp = 1;
                }
                else
                {
                    $vpcURL .= '&' . urlencode($key) . "=" . urlencode($value);
                }

                $md5HashData .= $value;
           }
        }

       if (strlen($SECURE_SECRET) > 0) 
       {
            $vpcURL .= "&vpc_SecureHash=" . strtoupper(md5($md5HashData));
       }  

       return Redirect::to($vpcURL);

    }

    return redirect()->action('Candidate\RegistrationController@getStep');

  }

}
