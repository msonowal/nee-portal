@extends('student.plane')
@section('body')
@include('student.navbar')

<div class="container">
	<div class="card-panel hoverable">
		<div class="col s6 offset-s3">
		    <div class="row">			   
					{!! form($form) !!}
			</div>
		</div>
	</div>
</div>
@stop