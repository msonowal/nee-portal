@extends('layouts.plane')
@section('body')
<div class="container">
	<div class="card-panel hoverable">
		<div class="col s6 offset-s3">
		   <div class="row">
    		{!! Form::open(['route' => 'candidates.forgot']) !!}
            <div class="input-field col m12">
              {!! Form::text('email', '', ['id'=>'email','class' => 'validate', 'required'=>'true', 'autocomplete'=>'off']) !!}
              {!! Form::label('email', 'Email Address') !!}
           
              {!! Form::submit('Submit', ['class' => 'btn waves-effect waves-light blue']) !!}

	          {!! Form::close() !!}
	        </div> 
	        <div class="input-field col m6">
	            <a class="btn waves-effect waves-light blue" href="{{ route('candidate.login') }}">
	            Back to Login Page
	            </a>
	        </div> 
			<div class="input-field col m6">
            <a class="btn waves-effect waves-light blue" href="{{ route('candidate.register') }}">
             Create a New Account
            </a>
            </div>
			</div>
		</div>
	</div>
</div>
@stop
