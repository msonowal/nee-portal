@extends('layouts.public_layout')
@section('body')
	<div>
        <h3 class="center-align">ADMISSIONS {!! $year=Date('Y') !!}</h3>
      </div>
    <div class="center">
      <a href="{!! URL::route('candidate.register') !!}" class="waves-effect waves-light btn"><i class="large material-icons">mode_edit</i>Register</a>
      <a href="{!! URL::route('candidate.login') !!}" class="waves-effect waves-light btn">Login</a>
    </div>
@stop
