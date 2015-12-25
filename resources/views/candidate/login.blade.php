@extends('layouts.plane')
@section('body')
<div class="container">
	<div class="card-panel hoverable">
		<div class="col s6 offset-s3">
		    <div class="row">			   
					{!! form($form) !!}

		<div class="input-field col m6">
            <a class="btn waves-effect waves-light blue" href="{{ route('candidate.register') }}">
            <i class="medium material-icons">perm_identity</i>&nbsp; Register New Acount 
            </a>
        </div>
			</div>
		</div>
	</div>
</div>
@stop