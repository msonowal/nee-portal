@extends('candidate.plane')
@section('body')
<h5>Payment Options</h5>
<div class="card-panel hoverable">
    <div class="col s6 offset-s3">
      <div class="row">
      {!! Form::open(array('route' => 'candidate.application.payment_options', 'class'=>'col s12')) !!}
        <div class="col s12">
          <div class="input-field col m12">
            <select>
              <option value="#" disabled selected>Choose your option</option>
              <option value="1">Challan</option>
              <option value="2">Net Banking</option>
              <option value="3">Debit/Credit Card</option>
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
