@extends('candidate.plane')
@section('body')
<h5>PyUMoney Payment</h5>
<div class="card-panel hoverable">
    <div class="col s6 offset-s3">
      <div class="row">
      {!! Form::open(['url' => $action, 'class'=>'col s12']) !!}
        {!! Form::hidden('key', $data['key']) !!}
        {!! Form::hidden('hash', $hash) !!}
        {!! Form::hidden('txnid', $data['txnid']) !!}
        {!! Form::hidden('amount', $data['amount']) !!}
        {!! Form::hidden('firstname', $data['firstname']) !!}
        {!! Form::hidden('email', $data['email']) !!}
        {!! Form::hidden('phone', $data['phone']) !!}
        {!! Form::hidden('productinfo', $data['productinfo']) !!}
        {!! Form::hidden('surl', $data['surl']) !!}
        {!! Form::hidden('furl', $data['furl']) !!}
        {!! Form::hidden('service_provider', $data['service_provider']) !!}
        {!! Form::hidden('lastname', $data['lastname']) !!}
        {!! Form::hidden('curl', $data['curl']) !!}
        {!! Form::hidden('address1', $data['address1']) !!}
        {!! Form::hidden('state', $data['state']) !!}
        {!! Form::hidden('zipcode', $data['zipcode']) !!}
        {!! Form::hidden('udf1', $data['udf1']) !!}
        {!! Form::hidden('udf2', $data['udf2']) !!}
        {!! Form::hidden('udf3', $data['udf3']) !!}
        {!! Form::hidden('udf4', $data['udf4']) !!}
        {!! Form::hidden('udf5', $data['udf5']) !!}
        <div class="col m6">
          <h6>Total amount to be paid : {!! ($data['amount']/100)  !!}/-</h6>
        </div>
      </div>

      <div class="row">
        <div class="input-field col m12">
            <button class="btn waves-effect waves-light blue col m12" style="float: right;" type="submit">
              Proceed to PayUMoney
            </button>
        </div>
       {!! Form::close() !!}
      </div>
    </div>
</div>
@stop
