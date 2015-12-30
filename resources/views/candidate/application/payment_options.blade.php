@extends('candidate.plane')
@section('body')
<h5>Payment Options</h5>
<div class="card-panel hoverable">
    <div class="col s6 offset-s3">
      <div class="row">
      {!! Form::open(array('route' => 'candidate.application.payment_options', 'class'=>'col s12')) !!}
        <div class="col s12">
          <div class="input-field col m12">
            <select name="payment_option">
              <option value="#" disabled selected>Choose your option</option>
              <option value="challan">Challan</option>
              <option value="net_banking">Net Banking</option>
              <option value="debit_credit">Debit/Credit Card</option>
            </select>
            <label>Options</label>
          </div>
          <div class="col m12">
            <button class="btn waves-effect waves-light blue" style="float: right;" type="submit" name="action">Procced
                <i class="material-icons right"> send </i>
            </button>
        </div>
        </div>
        {!! Form::close() !!}
      </div>
    </div>
</div>
@stop
