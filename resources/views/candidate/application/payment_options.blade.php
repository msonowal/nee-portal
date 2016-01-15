@extends('candidate.plane')
@section('body')
<h5>Payment Options</h5>
<marquee><h5><font color="red">Already paid (thorough challan only) candidates are requested to wait till Tuesday to get their confirmation page!</font></h5></marquee>
<div class="card-panel hoverable">
    <div class="col s6 offset-s3">
      <div class="row">
      {!! Form::open(array('route' => 'candidate.application.payment_options', 'class'=>'col s12')) !!}
        <div class="col s12">
          <div class="input-field col m12">
            {!! Form::select('payment_option', $options) !!}
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
