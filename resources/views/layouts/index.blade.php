@extends('layouts.public_layout')
@section('body')
	<div class="center">
      <a href="{!! URL::route('candidate.register') !!}" class="waves-effect waves-light btn blue tooltipped" data-position="top" data-delay="50" data-tooltip="For new Registration click here"><i class="large material-icons">mode_edit</i>Register</a> &nbsp;
      <a href="{!! URL::route('candidate.login') !!}" class="waves-effect waves-light btn blue tooltipped" data-position="top" data-delay="50" data-tooltip="If already Registered click here">Login</a>
    </div>
    <br/>
    <div class="row">
      <div class="col s12" id="contact">
        <div class="card-panel blue hoverable">
          <span class="white-text">
          	For any  assistance please feel free to contact our HELPLINE NO: 09707309326.
			For any query, a candidate can also send email in the following  Email ID :- support@neeonline.ac.in
          </span>
        </div>
      </div>
    </div>
@stop
