@extends('candidate.plane')
@section('body')
<h5>Payment Options</h5>
<div class="card-panel hoverable">
    <div class="col s6 offset-s3">
      <div class="row">
        <div class="col s12">
          <div class="input-field col m12">
            <a target="_blank" href="{!! route('candidate.application.challan_format') !!}"><h5><u>Click here to view/print challan copy</u></a>
          </div>
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
          {!! Form::date('transaction_date', '', ['class'=>'datepicker', 'required']) !!}
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
