@extends('layouts.plane')
@section('body')
<div class="container">
	<div class="card-panel hoverable">
		<div class="col s6 offset-s3">
		    <div class="row">
					{!! form($form) !!}

			<div class="input-field col m3">
            <a class="btn waves-effect waves-light blue" href="{{ route('candidate.register') }}">
             Register
            </a>
            </div>
            <div class="input-field col m5">
            <a class="btn waves-effect waves-light blue" href="{{ route('candidate.forgot') }}">
             Forgot Password?
            </a>
            </div>
				<div class="input-field col m4">
	            <a class="btn waves-effect waves-light blue" href="{{ route('candidate.otp.activate') }}">
	            Activate a/c
	            </a>
	        </div>
			</div>
		</div>
	</div>
</div>
@stop
