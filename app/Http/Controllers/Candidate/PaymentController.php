<?php

namespace nee_portal\Http\Controllers\Candidate;

use Illuminate\Http\Request;

use nee_portal\Http\Requests;
use nee_portal\Http\Controllers\Controller;
use Validator, Basehelper, Session, Carbon, Redirect, Auth, Basehelper;
use nee_portal\Models\ChallanInfo;
use nee_portal\Models\Step1;
use nee_portal\Models\Step2;
use nee_portal\Models\Step3;
use nee_portal\Models\CandidateInfo;
use nee_portal\Models\Candidate;
use nee_portal\Models\Order;

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
            //$vpc_OrderInfo='NEE CreditDebit Pay';
            $vpc_OrderInfo=strtoupper($info_id.'_'.uniqid());
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


        $data['candidate_info_id']=$info_id;

        $data['mobile_no']=$candidate->mobile_no; 

        $data['email']=$candidate->email;  

        $data['trans_type']='debit_credit';

        $data['order_id'] =$request->vpc_MerchTxnRef;

        $data['order_info']=$request->vpc_OrderInfo;

        $data['amount'] =$request->vpc_Amount;

        $data['status'] ='PENDING';

        $order= new Order;

        $order->fill($data);

        if(!$order->save())
            return back()->withErrors('message', 'Unable to proceed!');

        //payment gateway dibit_credit
        require('pgconfig.php');

        $md5HashData = $SECURE_SECRET;

        $vpcURL=$request->virtualPaymentClientURL.'?';

        $input=$request->except('virtualPaymentClientURL', '_token');

        ksort($input);

        $appendAmp = 0;

        foreach($input as $key => $value)
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

  public function drServerhost(Request $request){

        require('pgconfig.php');

        $vpc_Txn_Secure_Hash = $request->vpc_SecureHash;

        $data=$request->except('vpc_SecureHash');

        if (strlen($SECURE_SECRET) > 0 && $_GET["vpc_TxnResponseCode"] != "7" && $_GET["vpc_TxnResponseCode"] != "No Value Returned") 
        {
            $md5HashData = $SECURE_SECRET;

            foreach($_GET as $key => $value) 
            {
                if ($key != "vpc_SecureHash" or strlen($value) > 0) {
                    $md5HashData .= $value;
                }
            }

        if (strtoupper($vpc_Txn_Secure_Hash) == strtoupper(md5($md5HashData))) {

            $hashValidated = "<FONT color='#00AA00'><strong>CORRECT</strong></FONT>";
        }

        else
        {
            $hashValidated = "<strong>INVALID HASH</strong>";
            $errorExists = true;
        }

        }
        else
        {
            $hashValidated = "<strong>Not Calculated - No 'SECURE_SECRET' present.</strong>";
        }


        $amount          = $_GET["vpc_Amount"];
        $locale          = $_GET["vpc_Locale"];
        $batchNo         = $_GET["vpc_BatchNo"];
        $command         = $_GET["vpc_Command"];
        $message         = $_GET["vpc_Message"];
        $version         = $_GET["vpc_Version"];
        $cardType        = $_GET["vpc_Card"];
        $orderInfo       = $_GET["vpc_OrderInfo"];
        $receiptNo       = $_GET["vpc_ReceiptNo"];
        $merchantID      = $_GET["vpc_Merchant"];
        $authorizeID     = $_GET["vpc_AuthorizeId"];
        $merchTxnRef     = $_GET["vpc_MerchTxnRef"];
        $transactionNo   = $_GET["vpc_TransactionNo"];
        $acqResponseCode = $_GET["vpc_AcqResponseCode"];
        $txnResponseCode = $_GET["vpc_TxnResponseCode"];

        if($txnResponseCode=="0")
       {

        $data['description']=Basehelper::getResponseDescription($txnResponseCode);
        $data['response_code']=$txnResponseCode;
        $data['message']=$message;
        $data['receipt_no']=$receiptNo;
        $data['tansaction_id']=$tansaction_id;
        $data['bank_id']=$authorizeID;



                        
       }     


  }

}
