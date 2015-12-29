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
		  	<div class="col m12 right-align"> <a href="{!! route('candidate.application.editstep1') !!}"> Edit</a></div>
		  		<h6>Step 1:</h6>
		  		<div class="col m12">
		  			<div class="col m6">State Quota : {!! $step1->quota !!}</div>
		  			<div class="col m6">Centre Preference 1 : {!! $step1->c_pref1 !!}</div>
		  			<div class="col m6">Centre Preference 2 : {!! $step1->c_pref2 !!}</div>
		  			<div class="col m6">Date of Birth : {!! $step1->dob !!}</div>
		  			<div class="col m6">Are you a Nerist Student : {!! $step1->nerist_stud !!}</div>
		  			<div class="col m6">Status : {!! $step1->status !!}</div>
		  			<div class="col m6">For Admission in : {!! $step1->admission_in !!}</div>
		  			<div class="col m6">Vocational Subject : {!! $step1->voc_subject !!}</div>
		  			<div class="col m6">Branch : {!! $step1->branch !!}</div>
		  			<div class="col m6">Branch Subject : {!! $step1->allied_branch !!}</div>
		  			<div class="col m6">Reservation Code : {!! $step1->reservation_code !!}</div>
		  		</div>
		  </div>
		</div>
	</div>
	<div class="card-panel hoverable">
		<div class="col s6 offset-s3">
		  <div class="row">
		  	<div class="col m12 right-align"> <a href="{!! route('candidate.application.editstep2') !!}"> Edit</a></div>	
		  		<h6>Step 2:</h6>
		  		<h6>Personal Details: </h6>
		  		<div class="col m12">
		  			<div class="col m6">Candidate Name : {!! $step2->name !!}</div>
		  			<div class="col m6">Father's Name : {!! $step2->father_name !!}</div>
		  			<div class="col m6">Guardian's Name : {!! $step2->guardian_name !!}</div>
		  			<div class="col m6">Gender : {!! $step2->gender !!}</div>
		  			<div class="col m6">Nationality : {!! $step2->nationality !!}</div>
		  			<div class="col m6">Are you Employed : {!! $step2->emp_status !!}</div>
		  			<div class="col m6">Relationship with Guardian : {!! $step2->relationship !!}</div>
		  		</div>
		  		<h6>Address Details: </h6>
		  		<div class="col m12">
		  			<div class="col m6">State : {!! $step2->state !!}</div>
		  			<div class="col m6">District : {!! $step2->district !!}</div>
		  			<div class="col m6">Post Office : {!! $step2->po !!}</div>
		  			<div class="col m6">PIN : {!! $step2->pin !!}</div>
		  			<div class="col m6">Village/Town : {!! $step2->village !!}</div>
		  			<div class="col m6">Address Line : {!! $step2->address_line !!}</div>
		  		</div>
		  </div>
		</div>
	</div>
	<div class="card-panel hoverable">
		<div class="col s6 offset-s3">
		  <div class="row">
		  	<div class="col m12 right-align"> <a href="{!! route('candidate.application.editstep3') !!}"> Edit</a></div>
		  		<h6>Step 1:</h6>
		  		<div class="col m12">
		  			<div class="col m6">Photo : {!! Html::image($step3->getPhoto(), '', array('height' => '100px','width' => '90px')) !!}</div>
		  			<div class="col m6">Signature : {!! $step3->signature !!}</div>
		  		</div>
		  </div>
		</div>
	</div>
@stop
