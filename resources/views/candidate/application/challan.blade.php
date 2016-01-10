@extends('candidate.plane')
@section('body')
<h5>Challan Payment</h5>
<div class="card-panel hoverable">
    <div class="col s6 offset-s3">
      <div class="row">
        <div class="col s12">
          <div class="input-field col m12">
            <a target="_blank" href="{!! route('candidate.application.challan_copy') !!}"><h5><u>Click here to view/print challan copy</u></a>
          </div>
        </div>
      </div>
    </div>
</div>
<div class="card-panel hoverable">
<div class="col s6 offset-s3">
    <div class="row">
        <div class="col m12">
            <h5><blockquote><strong><span class="red-text text-darken-1">After Print out of your challan copy, don't forget to logout.</span> After payment made in the bank, <span class="red-text text-darken-1">please wait for 48 hours and then login again</span>, come to this step/page and enter your <span class="red-text text-darken-1">Challan Transaction ID and Date of Transaction</span> in the following panel. You will get your registration confirmation page after <span class="red-text text-darken-1">challan verification</span>.</strong></blockquote></h5>
        </div>
      </div>
    </div>
</div>
<div class="card-panel hoverable">
    <div class="col s6 offset-s3">
      <div class="row">
      {!! Form::open(array('route' => 'candidate.application.challan', 'class'=>'col s12')) !!}
        <div class="input-field col m6">
          {!! Form::text('transaction_id', '', ['class'=>'validate', 'required']) !!}
          <label for="transaction_id">Transaction Id</label>
        </div>
        <div class="input-field col m6">
          {!! Form::date('transaction_date', '', ['class'=>'transaction_date', 'required']) !!}
          <label for="transaction_date">Date of Transaction</label>
        </div>        
        <div class="input-field col m12">
        <button class="btn waves-effect waves-light blue" style="float: right;" type="submit">Submit
            <i class="material-icons right"> send </i>
        </button>
        
        </div>
       {!! Form::close() !!}
      </div>
    </div>
</div>
@stop
@section('page_script')  
  $('.transaction_date').pickadate({
    format: 'dd-mm-yyyy',
    defaultDate: "+0",
    maxDate: new Date,
  });
@stop