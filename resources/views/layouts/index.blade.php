@extends('layouts.public_layout')
@section('body')
	<div class="center">
      <a href="{!! URL::route('candidate.register') !!}" class="waves-effect waves-light btn blue tooltipped" data-position="top" data-delay="50" data-tooltip="For new Registration click here">
      <i class="large material-icons">mode_edit</i>Register
      </a> &nbsp;
      <a href="{!! URL::route('candidate.login') !!}" class="waves-effect waves-light btn blue tooltipped" data-position="top" data-delay="50" data-tooltip="If already Registered click here">
      <i class="material-icons">input</i> Login</a>
    </div>
    <br/>
    <div class="row">
      <div class="col s12" id="contact">
        <div class="card-panel blue hoverable">
        <p class="flow-text white-text">

          For any academic related query please contact : +91 0360 2257401-410, ext: 6460 between from 10:00AM to 4:30PM Monday-Friday.
          <br/>
          For any academic related query a candidate can also send email in the following  Email ID :- <a class="white-text" href="mailto:info@neeonline.ac.in?subject=AcademicQuery">info@neeonline.ac.in</a>
          <br/>
          	For any technical assistance please feel free to contact our HELPLINE NO: 09707309326 between from 10:00AM to 5:00PM  Monday-Friday.
            <br/>
			For technical related query, a candidate can also send email in the following  Email ID :- <a class="white-text" href="mailto:support@neeonline.ac.in?subject=TechnicalQuery">support@neeonline.ac.in</a>
          </p>
        </div>
      </div>
    </div>
@stop
