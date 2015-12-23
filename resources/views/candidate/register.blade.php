@extends('layouts.plane')
@section('body')
<div class="card-panel hoverable">
    <div class="col s6 offset-s3">
     <div class="row">
      <form class="col s12" action="{!! URL::route('candidate.register') !!}" method="post">
       <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="input-field col m6">
          <input id="first_name" name="first_name" autocomplete="off" required type="text" class="validate">
          <label for="first_name">First Name</label>
        </div>        
        <div class="input-field col m6">
          <input id="last_name" name="last_name" autocomplete="off" required type="text" class="validate">
          <label for="last_name">Last Name</label>
        </div>
        <div class="input-field col m6">
          <input id="password" name="password" autocomplete="off" required type="password" class="validate">
          <label for="password">Password</label>
        </div>
        <div class="input-field col m6">
          <input id="password_confirmation" name="password_confirmation" autocomplete="off" required type="password" class="validate">
          <label for="password_confirmation">Confirm Password</label>
        </div>
        <div class="input-field col m6">
          <input id="mobile_no" name="mobile_no" autocomplete="off" required type="text" class="validate">
          <label for="mobile_no">Mobile No</label>
        </div>
        <div class="input-field col m6">
          <input id="email" name="email" autocomplete="off" required type="email" class="validate">
          <label for="email">Email Address</label>
        </div>
        <div class="input-field col m6">
            <a class="btn waves-effect waves-light blue" href="{{ route('candidate.login') }}"><i class="fa fa-mail-reply"></i>&nbsp; Already Registered </a>
        </div>
        <div class="input-field col m6">
        <button class="btn waves-effect waves-light blue" style="float: right;" type="submit" name="action">Register
            <i class="material-icons right">send</i>
        </button>
        
        </div>
        </form>
      </div>
  </div>
    </div>  
@stop