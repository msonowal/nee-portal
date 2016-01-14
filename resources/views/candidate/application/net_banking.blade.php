@extends('candidate.plane')
@section('body')
<h5>Net Banking Payment</h5>
<div class="card-panel hoverable">
    <div class="col s6 offset-s3">
      <div class="row">
      {!! Form::open(array('route' => 'payment.net_banking.getcheck', 'class'=>'col s12')) !!}
        <div class="col m6">
          <h6>Total amount to be paid : {!! $amount  !!}/-</h6>
        </div>
      </div>

      <div class="row">
        <div class="input-field col m12">
          <button class="btn waves-effect waves-light blue col m12" style="float: right;" type="submit">
            Proceed to Payment Gateway
            </button>
        </div>
          {!! Form::hidden('action', $action) !!}
          {!! Form::hidden('proceed', $proceed) !!}
          {!! Form::hidden('BillerId', $BillerId) !!}
          {!! Form::hidden('ResponseUrl', $ResponseUrl) !!}
          {!! Form::hidden('CRN', $CRN) !!}
          {!! Form::hidden('CheckSumKey', $CheckSumKey) !!}
          {!! Form::hidden('CheckSumGenUrl', $CheckSumGenUrl) !!}
          {!! Form::hidden('txtAcctNo', $txtAcctNo) !!}          
          {!! Form::hidden('txtTranID', $txtTranID) !!}
          {!! Form::hidden('txtMarketCode', $txtMarketCode) !!}
          {!! Form::hidden('txtBankCode', $txtBankCode) !!}
       {!! Form::close() !!}
      </div>
    </div>
</div>
@stop
