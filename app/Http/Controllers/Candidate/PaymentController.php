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
            //$vpc_Amount=(Basehelper::getPayableAmount($info_id))*100+400;
            $vpc_Locale='en';

            //$vpc_ReturnURL='https://www.neeonline.ac.in/nee/candidate/vpc_php_serverhost_dr.php';
            $vpc_ReturnURL = route('payment.response.debit_card');

            return view($this->content.'debit_card')->with([
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

        return redirect()->route('candidate.application.step');
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

        $data['candidate_info_id']=$info_id;

        $data['mobile_no']=$candidate->mobile_no;

        $data['email']=$candidate->email;

        $data['trans_type']='debit';

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
                }else
                    $vpcURL .= '&' . urlencode($key) . "=" . urlencode($value);

                $md5HashData .= $value;
           }
        }

       if (strlen($SECURE_SECRET) > 0)
            $vpcURL .= "&vpc_SecureHash=" . strtoupper(md5($md5HashData));

       return Redirect::to($vpcURL);
    }

    return redirect()->route('candidate.application.step');

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
            //$vpc_Amount=(Basehelper::getPayableAmount($info_id))*100+600;
            $vpc_Locale='en';

            //$vpc_ReturnURL='https://www.neeonline.ac.in/nee/candidate/vpc_php_serverhost_dr.php';
            $vpc_ReturnURL = route('payment.response.credit_card');

            return view($this->content.'credit_card')->with([
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

        $data['trans_type']='credit';


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

           if (strlen($value) > 0){

                if ($appendAmp == 0){

                    $vpcURL .= urlencode($key) . '=' . urlencode($value);
                    $appendAmp = 1;
                }else
                    $vpcURL .= '&' . urlencode($key) . "=" . urlencode($value);

                $md5HashData .= $value;
           }
        }

       if (strlen($SECURE_SECRET) > 0)
            $vpcURL .= "&vpc_SecureHash=" . strtoupper(md5($md5HashData));

       return Redirect::to($vpcURL);
    }

    return redirect()->route('candidate.application.step');
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

  public function showNet_banking()
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
            require('MerchantDetails.php');
            $txtTranID=$info_id;
            $txtMarketCode='L2748';
            $txtAcctNo = '9085538844';
            $txtBankCode='NA';
            $amount=(Basehelper::getPayableAmount($info_id))*100+600;

            return view($this->content.'net_banking')->with([
                        'BillerId' => $BillerId,
                        'ResponseUrl' => $ResponseUrl,
                        'CRN' => $CRN,
                        'CheckSumKey' => $CheckSumKey,
                        'CheckSumGenUrl' => $CheckSumGenUrl,
                        'TPSLUrl' => $TPSLUrl,
                        'txtAcctNo' => $txtAcctNo,
                        'txtTranID' => $txtTranID,
                        'txtMarketCode' => $txtMarketCode,
                        'txtBankCode' => $txtBankCode,
                        'amount' => $amount                   
                    ]);
        }

        return redirect()->action('Candidate\RegistrationController@getStep');
  }

  public function doNet_banking(Request $request)
  {
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
            $data['trans_type']='net banking';
            $data['order_id'] =$request->txtTranID;
            $data['amount'] =$request->amount;
            $data['status'] ='PENDING';

            $order= new Order;
            $order->fill($data);

            if(!$order->save())
                return back()->withErrors('Unable to proceed!');    

        $TPSLUrl =$request->TPSLUrl;
        $CheckSumGenUrl = $request->CheckSumGenUrl;          
        $txtBillerIdStr = "txtBillerid=".$request->BillerId."&";
        $txtResponseUrl = "txtResponseUrl=".$request->ResponseUrl."&";
        $txtCRN ="txtCRN= ".$request->CRN."&";
        $txtCheckSumKey = "txtCheckSumKey=".$request->CheckSumKey;
        $transaction = $request->txtTranID;
        $market = $request->txtMarketCode;
        $account = $request->txtAcctNo;
        $transaction_amount = $request->txtTxnAmount;
        $bankcode = $request->txtBankCode;
                
        $string=$txtBillerIdStr.$txtResponseUrl.$txtCRN.$txtCheckSumKey;

        $txtVals = $transaction.$market.$account.$transaction_amount.$bankcode;
        $txt_encrypt = base64_encode($txtVals);
        $txt_encrypt = md5(base64_encode($txtVals));

        //$txtKey = $txtCheckSumKey;
        $txtForEncode = $txt_encrypt.$txtCheckSumKey;
        $txtPostid = md5($txtForEncode);
        $txtPostid="txtPostid=".$txtPostid;
        $input=$request->except('_token');
       
        foreach($input as $key => $value){

            if($value == '')
                return back()->withErrors('Invalid data provided'); 

            $v="$key=".$value;
            array_push($input,$v);
        }
        $UserDataString =implode("&",$input);
        $PostData =$UserDataString.'&'.$string.'&'.$txtPostid;

        define('POST', $CheckSumGenUrl);
        define('POSTVARS', $PostData);   

        if($_SERVER['REQUEST_METHOD']==='POST'){ 
         $ch = curl_init(POST);
         curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
         curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, False);
         curl_setopt($ch, CURLOPT_CAINFO, getcwd() . '/keystoretechp.pem');
         curl_setopt ($ch, CURLOPT_SSLCERTPASSWD, 'changeit');
         curl_setopt($ch, CURLOPT_POST      ,1);
         curl_setopt($ch, CURLOPT_REFERER  , route('payment.net_banking')); //Setting header URL: 
         curl_setopt($ch, CURLOPT_POSTFIELDS    ,POSTVARS);
         curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1); 
         curl_setopt($ch, CURLOPT_HEADER      ,0);  // DO NOT RETURN HTTP HEADERS 
         curl_setopt($ch, CURLOPT_RETURNTRANSFER  ,1); // RETURN THE CONTENTS OF THE CALL
         
        $Received_CheckSum_Data = curl_exec($ch);
        echo curl_error($ch);
        curl_close($ch);


        $txtBillerIdStr =$request->BillerId;
        $txtResponseUrl =$request->ResponseUrl;
        $txtCRN =$request->CRN;
        $txtCheckSumKey=$request->CheckSumKey;

        if(strlen($Received_CheckSum_Data)>0){
            $txtTranID=$request->txtTranID;
            $txtMarketCode=$request->txtMarketCode;
            $txtAcctNo=$request->txtAcctNo;
            $txtTxnAmount=$request->txtTxnAmount;
            $txtBankCode=$request->txtBankCode;

            $msg=$txtBillerIdStr."|".$txtTranID."|NA|NA|".$txtTxnAmount."|".$txtBankCode."|NA|NA|".$txtCRN."|NA|NA|NA|NA|NA|NA|NA|".$txtMarketCode."|".$txtAcctNo."|NA|NA|NA|NA|NA|".$txtResponseUrl;
            $msg=$msg."|".$Received_CheckSum_Data;

            return Redirect::to($TPSLUrl)->with('msg', $msg);
            
        }
      } 
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

        $data['key'] = $MERCHANT_KEY;
        $data['txnid'] = $txnid;
        $data['amount'] = $amount;
        $data['firstname']  = Auth::candidate()->get()->first_name;
        $data['email']  = Auth::candidate()->get()->email;
        $data['phone']  = Auth::candidate()->get()->mobile_no;
        $data['productinfo']  = json_encode(json_decode('[{"name":"'.$step2->name.'","description":"'.Basehelper::getExamName($info_id).'","value":"'.$amount.'","isRequired":"true"}]'));
        $data['lastname']  = Auth::candidate()->get()->last_name;
        $data['surl']  = route('payment.response.pay_u.sucess');
        $data['furl']  = route('payment.response.pay_u.fail');
        $data['service_provider'] = $SERVICE_PROVIDER;
        $data['curl']  = route('payment.response.pay_u.cancel');
        $data['address1'] = Str::limit($step2->address_line, 100);
        $data['state'] = Basehelper::getState($step2->state);
        $data['zipcode'] = $step2->pin;
        $data['udf1'] = $info_id; //saving info id on udf1
        $data['udf2'] = $step2->name; //saving applicant name id on udf2
        $data['udf3'] = $step1->reservation_code; //saving reservation code on udf3
        $data['udf4'] = $_SERVER['HTTP_USER_AGENT']; //saving user agent/browser on udf4
        $data['udf5'] = $_SERVER["REMOTE_ADDR"]; //saving remote address/ client address on udf5

        $hashSequence = "key|txnid|amount|firstname|email|phone|productinfo|surl|furl|service_provider|lastname|curl|address1|state|zipcode|udf1|udf2|udf3|udf4|udf5";
        $hashVarsSeq = explode('|', $hashSequence);
        $hash_string = '';
      	foreach($hashVarsSeq as $hash_var) {
            $hash_string .= $data[$hash_var];
            $hash_string .= '|';
        }
        $hash_string .= $SALT;
        $hash = strtolower(hash('sha512', $hash_string));
        //$hash = hash("sha512", $hash_string);
        $action = $PAYU_BASE_URL . '/_payment';
        //TODO to insert in the db for the order details or not to discuss
        return view($this->content.'pay_u_form', compact('data', 'action', 'hash'));
   }
    return redirect()->route('candidate.application.step');
  }

  public function payUResponseSuccess(Request $request)
  {
    Log::info('PayUMoney Sucess');
    return $request;
  }

  public function payUResponseFail(Request $request)
  {
    Log::info('PayUMoney Fail');
    return $request;
  }

  public function payUResponseCancel(Request $request)
  {
    Log::info('PayUMoney Cancelled');
    return $request;
  }
}
