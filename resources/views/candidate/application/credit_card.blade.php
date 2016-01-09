@extends('candidate.plane')
@section('body')
<h5>Credit Card Payment</h5>
<div class="card-panel hoverable">
    <div class="col s6 offset-s3">
      <div class="row">
      {!! Form::open(array('route' => 'payment.debit_card', 'class'=>'col s12')) !!}
        <div class="col m6">
          <h6>Total amount to be paid : {!! ($vpc_Amount/100)  !!}/-</h6>
        </div>
      </div>

      <div class="row">
        <div class="input-field col m12">
          <button class="btn waves-effect waves-light blue col m12" style="float: right;" type="submit">
            Proceed to Payment Gateway
            </button>
        </div>
          {!! Form::hidden('Title', $Title) !!}
          {!! Form::hidden('virtualPaymentClientURL', $virtualPaymentClientURL) !!}
          {!! Form::hidden('vpc_Version', $vpc_Version) !!}
          {!! Form::hidden('vpc_Command', $vpc_Command) !!}
          {!! Form::hidden('vpc_AccessCode', $vpc_AccessCode) !!}
          {!! Form::hidden('vpc_MerchTxnRef', $vpc_MerchTxnRef) !!}
          {!! Form::hidden('vpc_Merchant', $vpc_Merchant) !!}
          {!! Form::hidden('vpc_OrderInfo', $vpc_OrderInfo) !!}
          {!! Form::hidden('vpc_Amount', $vpc_Amount) !!}
          {!! Form::hidden('vpc_Locale', $vpc_Locale) !!}
          {!! Form::hidden('vpc_ReturnURL', $vpc_ReturnURL) !!}
       {!! Form::close() !!}
      </div>
    </div>
</div>
@stop
