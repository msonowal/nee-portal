<?php

namespace nee_portal\Http\Controllers\Candidate;

use Illuminate\Http\Request;

use nee_portal\Http\Requests;
use nee_portal\Http\Controllers\Controller;
use Validator, Basehelper, Session, Carbon, Redirect, Auth, Log;
use Illuminate\Support\Str;
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

    public function showDebit_card(){

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

        //   return Basehelper::getPayableAmount($info_id);

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
            //$vpc_Amount=(Basehelper::getPayableAmount($info_id))*100+4;
            $vpc_Locale='en';

            //$vpc_ReturnURL='https://www.neeonline.ac.in/nee/candidate/vpc_php_serverhost_dr.php';
            $vpc_ReturnURL = route('payment.response.debit_card');

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

    public function doDebit_card(Request $request){

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
            return back()->withErrors('Unable to proceed!');

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

  public function debitResponse(Request $request){

        //$info_id = Session::get('candidate_info_id');
        $info_id = $request->vpc_MerchTxnRef;
        //Log::info('INFO ID: '.$info_id);
        //Log::info('merchTxnRef := '.$request->vpc_MerchTxnRef);

        require('pgconfig.php');

        $amount          = $request->vpc_Amount;
        $locale          = $request->vpc_Locale;
        $batchNo         = $request->vpc_BatchNo;
        $command         = $request->vpc_Command;
        $message         = $request->vpc_Message;
        $version         = $request->vpc_Version;
        $cardType        = $request->vpc_Card;
        $orderInfo       = $request->vpc_OrderInfo;
        $receiptNo       = $request->vpc_ReceiptNo;
        $merchantID      = $request->vpc_Merchant;
        $authorizeID     = $request->vpc_AuthorizeId;
        $merchTxnRef     = $request->vpc_MerchTxnRef;
        $transactionNo   = $request->vpc_TransactionNo;
        $acqResponseCode = $request->vpc_AcqResponseCode;
        $txnResponseCode = $request->vpc_TxnResponseCode;
        //$vpc_Txn_Secure_Hash = $request->vpc_SecureHash;
        //$input=$request->except('vpc_SecureHash');

        /*
        if (strlen($SECURE_SECRET) > 0 && $txnResponseCode != "7" && $txnResponseCode != "No Value Returned")
        {
            $md5HashData = $SECURE_SECRET;

            foreach($input as $key => $value)
            {
                if ($key != "vpc_SecureHash" or strlen($value) > 0) {
                    $md5HashData .= $value;
                }
            }
            if (strtoupper($vpc_Txn_Secure_Hash) == strtoupper(md5($md5HashData))) {
              $hashValidated = "<strong>CORRECT</strong>";
            }else{
              $hashValidated = "<strong>INVALID HASH</strong>";
            }
        }else{
            $hashValidated = "<strong>Not Calculated - No 'SECURE_SECRET' present.</strong>";
        }
        */
        //Log::info('on Line 236');
        $order = Order::where('order_info', $orderInfo)->orderBy('id', 'desc')->first();
        $data['description']=Basehelper::getResponseDescription($txnResponseCode);
        $data['response_code']=$txnResponseCode;
        $data['message']=$message;
        $data['receipt_no']=$receiptNo;
        $data['tansaction_id']=$transactionNo;
        $data['bank_id']=$authorizeID;
        $data['card_type']=$cardType;
        //$txnResponseCode="0";
        //Log::info('on Line 246 : response_code ='. $txnResponseCode);
        if($txnResponseCode=="0"){

          $data['status']='SUCCESS';
          $order->fill($data);
          if(!$order->save())
              return redirect()->route($this->content.'payment_options')->withErrors('Data lost while saving. Please contect NEE Tech Support Team.');

          //Log::info('On line 254');
          $candidate_info = CandidateInfo::where('id', $info_id)->first();
          $candidate_info->reg_status = 'completed';
          if(!$candidate_info->save())
              return redirect()->route($this->content.'payment_options')->withErrors('Data lost while saving. Please contect NEE Tech Support Team.');

          return redirect()->route($this->content.'completed')->with('message', 'Transaction is successfully completed!<br/> Your payment order id is <strong>'.$orderInfo.'</strong>');

       }else{
          Log::info('Transaction Failed: '.$transactionNo);
          $data['status']='FAILURE';
          $order->fill($data);
          $order->save();
          return redirect()->route($this->content.'payment_options')->withErrors('Transaction failed.<br/>Your order No is <strong>'.$orderInfo.'</strong>.<br/>Please try again.');
       }
  }

  public function showCredit_card(){

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

        //   return Basehelper::getPayableAmount($info_id);

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
            //$vpc_Amount=(Basehelper::getPayableAmount($info_id))*100+6;
            $vpc_Locale='en';

            //$vpc_ReturnURL='https://www.neeonline.ac.in/nee/candidate/vpc_php_serverhost_dr.php';
            $vpc_ReturnURL = route('payment.response.credit_card');

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

    public function doCredit_card(Request $request){

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
            return back()->withErrors('Unable to proceed!');

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

  public function creditResponse(Request $request){

        //$info_id = Session::get('candidate_info_id');
        $info_id = $request->vpc_MerchTxnRef;
        //Log::info('INFO ID: '.$info_id);
        //Log::info('merchTxnRef := '.$request->vpc_MerchTxnRef);

        require('pgconfig.php');

        $amount          = $request->vpc_Amount;
        $locale          = $request->vpc_Locale;
        $batchNo         = $request->vpc_BatchNo;
        $command         = $request->vpc_Command;
        $message         = $request->vpc_Message;
        $version         = $request->vpc_Version;
        $cardType        = $request->vpc_Card;
        $orderInfo       = $request->vpc_OrderInfo;
        $receiptNo       = $request->vpc_ReceiptNo;
        $merchantID      = $request->vpc_Merchant;
        $authorizeID     = $request->vpc_AuthorizeId;
        $merchTxnRef     = $request->vpc_MerchTxnRef;
        $transactionNo   = $request->vpc_TransactionNo;
        $acqResponseCode = $request->vpc_AcqResponseCode;
        $txnResponseCode = $request->vpc_TxnResponseCode;
        //$vpc_Txn_Secure_Hash = $request->vpc_SecureHash;
        //$input=$request->except('vpc_SecureHash');

        /*
        if (strlen($SECURE_SECRET) > 0 && $txnResponseCode != "7" && $txnResponseCode != "No Value Returned")
        {
            $md5HashData = $SECURE_SECRET;

            foreach($input as $key => $value)
            {
                if ($key != "vpc_SecureHash" or strlen($value) > 0) {
                    $md5HashData .= $value;
                }
            }
            if (strtoupper($vpc_Txn_Secure_Hash) == strtoupper(md5($md5HashData))) {
              $hashValidated = "<strong>CORRECT</strong>";
            }else{
              $hashValidated = "<strong>INVALID HASH</strong>";
            }
        }else{
            $hashValidated = "<strong>Not Calculated - No 'SECURE_SECRET' present.</strong>";
        }
        */
        //Log::info('on Line 236');
        $order = Order::where('order_info', $orderInfo)->orderBy('id', 'desc')->first();
        $data['description']=Basehelper::getResponseDescription($txnResponseCode);
        $data['response_code']=$txnResponseCode;
        $data['message']=$message;
        $data['receipt_no']=$receiptNo;
        $data['tansaction_id']=$transactionNo;
        $data['bank_id']=$authorizeID;
        $data['card_type']=$cardType;
        //$txnResponseCode="0";
        //Log::info('on Line 246 : response_code ='. $txnResponseCode);
        if($txnResponseCode=="0"){

          $data['status']='SUCCESS';
          $order->fill($data);
          if(!$order->save())
              return redirect()->route($this->content.'payment_options')->withErrors('Data lost while saving. Please contect NEE Tech Support Team.');

          //Log::info('On line 254');
          $candidate_info = CandidateInfo::where('id', $info_id)->first();
          $candidate_info->reg_status = 'completed';
          if(!$candidate_info->save())
              return redirect()->route($this->content.'payment_options')->withErrors('Data lost while saving. Please contect NEE Tech Support Team.');

          return redirect()->route($this->content.'completed')->with('message', 'Transaction is successfully completed!<br/> Your payment order id is <strong>'.$orderInfo.'</strong>');

       }else{
          Log::info('Transaction Failed: '.$transactionNo);
          $data['status']='FAILURE';
          $order->fill($data);
          $order->save();
          return redirect()->route($this->content.'payment_options')->withErrors('Transaction failed.<br/>Your order No is <strong>'.$orderInfo.'</strong>.<br/>Please try again.');
       }
  }


  public function showPayU()
  {
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

        $amount = 2; //CAll method to get amount payable
        require('payu_config.php');
        $txnid = Str::upper(substr(hash('sha256', mt_rand() . microtime()), 0, 20));
        //$productinfo = [];
        $payment_parts['paymentParts']['name'] = $step2->name;
        $payment_parts['paymentParts']['description'] = Basehelper::getExamName($info_id);
        $payment_parts['paymentParts']['value'] = $amount;
        $payment_parts['paymentParts']['isRequired'] = true;
        $payment_parts['paymentParts']['settlementEvent'] = 'EmailConfirmation';
        $payment_parts['paymentParts']['info_id'] = $info_id;
        $payment_parts['paymentParts']['transaction_date'] = date('d/m/Y');
        $productinfo = json_encode($payment_parts);
        // $productinfo, $payment_parts;
        // $productinfo['paymentIdentifiers']['field'] = 'TransactionDate';
        // $productinfo['paymentIdentifiers']['value'] = date('d/m/Y');
        // $productinfo['paymentIdentifiers']['info_id'] = 'info_id';
        // $productinfo['paymentIdentifiers']['value'] = $info_id;
        $string = $MERCHANT_KEY;
        $string .='|'.$txnid;
        $string .='|'.$amount;
        $string .='|'.$productinfo;
        $string .='|'.Auth::candidate()->get()->first_name;
        $string .='|'.Auth::candidate()->get()->email;
        $string .='|'.$info_id;
        $string .='|'.'sd';
        //$hashSequence = "key|txnid|amount|productinfo|firstname|email|udf1|udf2|udf3|udf4|udf5|udf6|udf7|udf8|udf9|udf10";
        $vpc_Amount='200';
        $vpc_Locale='en';

        //$vpc_ReturnURL='https://www.neeonline.ac.in/nee/candidate/vpc_php_serverhost_dr.php';
        $vpc_ReturnURL = route('payment.response.pay_u');

        return view($this->content.'pay_u_form')->with([

        ]);
   }

    //return redirect()->action('Candidate\RegistrationController@getStep');

  }
}
