@extends('candidate.plane')
@section('body')
<style type="text/css">
	p.review{
		margin: 0px;
		margin-top: 15px;
	}
</style>
<div class="card-panel hoverable white darken-1" style="padding:5px 10px;">
       <p class="white-text">
          <h6><strong>Final review of your Informations</strong></h6>
       </p>
</div>
	<div class="card-panel hoverable">
		<div class="col s6 offset-s3">
		  <div class="row">
		  	<div class="col m12 right-align"> <a class="waves-effect wave-light btn blue tooltipped" data-position="bottom" data-delay="50" data-tooltip="Click here to Edit Step1" href="{!! route('candidate.application.editstep1') !!}"><i class="material-icons prefix">mode_edit</i> Edit</a></div>
		  		<span class="card-title"> Step1 :</span>
		  		<div class="col m12">
		  			<div class="col m6"><p class="review"> State Quota : <strong>{{ $step1->quota }}</strong> </p></div>
		  			<div class="col m6"><p class="review"> Centre Preference 1 : <strong>{{ $step1->c_pref1 }}</strong> </p></div>
		  			<div class="col m6"><p class="review"> Centre Preference 2 : <strong>{{ $step1->c_pref2 }}</strong> </p></div>
		  			<div class="col m6"><p class="review"> Date of Birth : <strong>{{ $step1->dob }}</strong> </p></div>
		  			<div class="col m6"><p class="review"> Are you a Nerist Student : <strong>{{ $step1->nerist_stud }}</strong> </p></div>
		  			<div class="col m6"><p class="review"> For Admission in : <strong>{{ $step1->admission_in }}</strong> </p></div>
		  			<div class="col m6"><p class="review"> Vocational Subject : <strong>{{ $step1->voc_subject }}</strong> </p></div>
		  			<div class="col m6"><p class="review"> Branch : <strong>{{ $step1->branch }}</strong> </p></div>
		  			<div class="col m6"><p class="review"> Branch Subject : <strong>{{ $step1->allied_branch }}</strong> </p></div>
		  			<div class="col m6"><p class="review"> Reservation Code : <strong>{{ $step1->reservation_code }}</strong> </p></div>
		  		</div>
		  </div>
		</div>
	</div>
	<div class="card-panel hoverable">
		<div class="col s6 offset-s3">
		  <div class="row">
		  	<div class="col m12 right-align"> <a class="waves-effect wave-light btn blue tooltipped" data-position="bottom" data-delay="50" data-tooltip="Click here to Edit Step2" href="{!! route('candidate.application.editstep2') !!}"><i class="material-icons prefix">mode_edit</i> Edit</a></div>
		  		<span class="card-title"> Step2 :</span>
		  		<h6> Personal Details: </h6>
		  		<div class="col m12">
		  			<div class="col m6"><p class="review"> Candidate Name : <strong>{{ $step2->name }}</strong> </p></div>
		  			<div class="col m6"><p class="review"> Father's Name : <strong>{{ $step2->father_name }}</strong> </p></div>
		  			<div class="col m6"><p class="review"> Guardian's Name : <strong>{{ $step2->guardian_name }}</strong> </p></div>
		  			<div class="col m6"><p class="review"> Gender : <strong>{{ $step2->gender }}</strong> </p></div>
		  			<div class="col m6"><p class="review"> Nationality : <strong>{{ $step2->nationality }}</strong> </p></div>
		  			<div class="col m6"><p class="review"> Are you Employed : <strong>{{ $step2->emp_status }}</strong> </p></div>
		  			<div class="col m6"><p class="review"> Relationship with Guardian : <strong>{{ $step2->relationship }}</strong> </p></div>
		  		</div>
		  		<div class="col m12">
		  			<div class="col m6"><p class="review"> State : <strong>{{ $step2->state }}</strong> </p></div>
		  			<div class="col m6"><p class="review"> District : <strong>{{ $step2->district }}</strong> </p></div>
		  			<div class="col m6"><p class="review"> Post Office : <strong>{{ $step2->po }}</strong> </p></div>
		  			<div class="col m6"><p class="review"> PIN : <strong>{{ $step2->pin }}</strong> </p></div>
		  			<div class="col m6"><p class="review"> Village/Town : <strong>{{ $step2->village }}</strong> </p></div>
		  			<div class="col m6"><p class="review"> Address Line : <strong>{{ $step2->address_line }}</strong> </p></div>
		  		</div>
		  </div>
		</div>
	</div>
	<div class="card-panel hoverable">
		<div class="col s6 offset-s3">
		  <div class="row">
		  	<div class="col m12 right-align"> <a class="waves-effect wave-light btn blue tooltipped" data-position="bottom" data-delay="50" data-tooltip="Click here to Edit Step3" href="{!! route('candidate.application.editstep3') !!}"><i class="material-icons prefix">mode_edit</i> Edit</a></div>
		  		<span class="card-title">Step3 :</span>
		  		<h6>Photo and Signature: </h6>
		  		<div class="col m12">
		  			<div class="col m6">Photo : {!! Html::image($step3->getPhoto(), '', array('height' => '120px','width' => '100px')) !!}</div>
		  			<div class="col m6">Signature : {!! Html::image($step3->getSignature(), '', array('height' => '50px','width' => '150px')) !!}</div>
		  		</div>
		  </div>
		</div>
	</div>

	<div class="card-panel hoverable">
		<div class="col s6 offset-s3">
		  <div class="row">
		  	<div class="col s12">
		  		<a class="waves-effect waves-light btn col s12 btn-large modal-trigger"  href="#modal_final">Final Submit <i class="material-icons right">send</i></a>
		  	</div>
		  </div>
		</div>
	</div>

	<!--Model Start-->
	<div id="modal_final" class="modal">
    {!! Form::open(array('route'=>'candidate.application.submit')) !!}
    <div class="modal-content">
      	<p class="text-light-blue">Are you sure to submit your Application Form for
        	<span class="text-green"><strong>{{ $candidate_info->exam_id }}</strong></span> ?
            Please note that once you click the Submit button, no changes can be made.
        </p>
    </div>
    <div class="modal-footer">
      {!! Form::submit('Yes, Submit', array('name'=>'final_submit', 'class'=>'btn success')) !!}
      <a href="#" class="modal-action modal-close waves-effect waves-red btn-flat ">CANCEL</a>
    </div>
    {!! Form::close() !!}
</div>
@stop
