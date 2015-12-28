@extends('candidate.plane')
@section('body')
<div class="card-panel hoverable white darken-1" style="padding:5px 10px;">
       <p class="white-text">
          <h6><strong>Final Review your Informations</strong></h6>
       </p>
</div>
	<div class="card-panel hoverable">
		<div class="col s6 offset-s3">
		  <div class="row">
		  		<h6>Step 1:</h6>
		  		<div class="col m12">
		  			<div class="col m6">State Quota: {!! $step1->quota !!}</div>
		  			<div class="col m6">Centre Preference 1: {!! $step1->c_pref1 !!}</div>
		  			<div class="col m6">Centre Preference 2: {!! $step1->c_pref2 !!}</div>
		  			<div class="col m6">Date of Birth: {!! $step1->dob !!}</div>
		  			<div class="col m6">Are you a Nerist Student: {!! $step1->nerist_stud !!}</div>
		  			<div class="col m6">Status: {!! $step1->status !!}</div>
		  			<div class="col m6">For Admission in: {!! $step1->admission_in !!}</div>
		  			<div class="col m6">Vocational Subject: {!! $step1->voc_subject !!}</div>
		  			<div class="col m6">Branch: {!! $step1->branch !!}</div>
		  			<div class="col m6">Branch Subject: {!! $step1->allied_branch !!}</div>
		  			<div class="col m6">Reservation Code: {!! $step1->reservation_code !!}</div>
		  		</div>
		  </div>
		</div>
	</div>
@stop
