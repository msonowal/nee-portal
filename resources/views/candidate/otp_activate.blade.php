@extends('layouts.plane')
@section('body')
<div class="card-panel hoverable">
    <div class="col s6 offset-s3">
     <div class="row">
     {!! Form::open(array('route' => 'candidate.otp.activate', 'class'=>'col s12')) !!}
      <fieldset>
        <legend> Activate via OTP </legend>

        <div class="input-field col m6">
          {{ Form::text('mobile_no', '', ['maxlength' => '10', 'class' => 'validate', 'required' ]) }}
          <label for="mobile_no"> Mobile No</label>
        </div>

        <div class="input-field col m6">
          {{ Form::text('otp', '', ['class' => 'validate', 'required' ]) }}
          <label for="mobile_no"> Mobile No</label>
          {!! Form::label('otp', 'OTP/ One time Password') !!}
        </div>

        <div class="input-field col m6">
            <a class="btn waves-effect waves-light blue" href="{{ route('candidate.login') }}"><i class="fa fa-mail-reply"></i>&nbsp; Already Registered </a>
        </div>
        <div class="input-field col m6">
        <button type="submit" class="btn waves-effect waves-light blue" style="float: right;" type="submit" name="action">
          ACTIVATE
            <i class="material-icons right">send</i>
        </button>
        </div>

        <div class="input-field col m6">
            <a class="btn waves-effect waves-light blue" href="{{ route('candidate.opt.resend') }}">
            <i class="fa fa-mail-reply"></i>&nbsp; Resend OTP </a>
        </div>

        <div class="input-field col m6">
        <button type="submit" class="btn waves-effect waves-light blue" style="float: right;" type="submit" name="action">
          ACTIVATE
            <i class="material-icons right">send</i>
        </button>
        </div>
    </fieldset>
    {!! Form::close() !!}
  </div>
  </div>
</div>  
@stop