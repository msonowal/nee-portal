@extends('layouts.plane')
@section('body')
<div class="container">
	<div class="card-panel hoverable">
		<div class="col s6 offset-s3">
		   <div class="row">
    		<div class="col m12">
		    {!! Form::open(['route' => 'candidate.changepassword']) !!}
		    	<div class="col m12">
		    		<legend>Change your password</legend>
		    	</div>	
		        <div class="input-field col m12">
		          {!! Form::text('email', '', ['id'=>'email','class' => 'validate', 'required', 'autocomplete'=>'off']) !!}
		          {!! Form::label('email', 'Email Address') !!}
		        </div>
		        <div class="input-field col m12">
		          {!! Form::text('otp', '', ['class' => 'validate', 'required']) !!}
		          {!! Form::label('otp', 'OTP(One time Password)') !!}
		        </div>
		        <div class="input-field col m12">
		          {!! Form::password('password', ['id'=>'password','class' => 'validate', 'required']) !!}
		          {!! Form::label('password', 'New password') !!}
		        </div>
		        <div class="input-field col m12">
		          {!! Form::password('password_confirmation', ['class' => 'validate', 'required']) !!}
		          {!! Form::label('password_confirmation', 'Confirm new password') !!}
		        </div>
		        <div class="input-field col m12">
		          {!! Form::submit('Submit', ['class' => 'btn waves-effect waves-light blue']) !!}
				</div>  
				  {!! Form::close() !!} 
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
</div>
@stop
