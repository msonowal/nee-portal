@extends('layouts.plane')
@section('body')
<div class="card-panel hoverable">
    <div class="col s6 offset-s3">
     <div class="row">
     {!! Form::open(array('route' => 'candidate.otp.resend', 'class'=>'col s12')) !!}
      <fieldset>
        <legend> Resend OTP </legend>

        <div class="input-field col m6">
          <label for="mobile_no"> Mobile No</label>
          {!! Form::text('mobile_no', '', ['maxlength' => '10', 'class' => 'validate', 'required', 'placeholder'=>'your registered Mobile No' ]) !!}
        </div>
        <div class="input-field col m12">
        <button type="submit" class="btn waves-effect waves-light blue" type="submit" name="action">
          SUBMIT
            <i class="material-icons right">send</i>
        </button>
        </div>
        <div class="input-field col m6">
            <a class="btn waves-effect waves-light blue" href="{{ route('candidate.login') }}"><i class="fa fa-mail-reply"></i>&nbsp; Already Registered </a>
        </div>
    </fieldset>
    {!! Form::close() !!}
  </div>
  </div>
</div>
@stop
