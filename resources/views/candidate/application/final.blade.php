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
		  			<div class="col m6"><p class="review"> State Quota : {!! $step1->quota !!} </p></div>
		  			<div class="col m6"><p class="review"> Centre Preference 1 : {!! $step1->c_pref1 !!} </p></div>
		  			<div class="col m6"><p class="review"> Centre Preference 2 : {!! $step1->c_pref2 !!} </p></div>
		  			<div class="col m6"><p class="review"> Date of Birth : {!! $step1->dob !!} </p></div>
		  			<div class="col m6"><p class="review"> Are you a Nerist Student : {!! $step1->nerist_stud !!} </p></div>
		  			<div class="col m6"><p class="review"> For Admission in : {!! $step1->admission_in !!} </p></div>
		  			<div class="col m6"><p class="review"> Vocational Subject : {!! $step1->voc_subject !!} </p></div>
		  			<div class="col m6"><p class="review"> Branch : {!! $step1->branch !!} </p></div>
		  			<div class="col m6"><p class="review"> Branch Subject : {!! $step1->allied_branch !!} </p></div>
		  			<div class="col m6"><p class="review"> Reservation Code : {!! $step1->reservation_code !!} </p></div>
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
		  			<div class="col m6"><p class="review"> Candidate Name : {!! $step2->name !!} </p></div>
		  			<div class="col m6"><p class="review"> Father's Name : {!! $step2->father_name !!} </p></div>
		  			<div class="col m6"><p class="review"> Guardian's Name : {!! $step2->guardian_name !!} </p></div>
		  			<div class="col m6"><p class="review"> Gender : {!! $step2->gender !!} </p></div>
		  			<div class="col m6"><p class="review"> Nationality : {!! $step2->nationality !!} </p></div>
		  			<div class="col m6"><p class="review"> Are you Employed : {!! $step2->emp_status !!} </p></div>
		  			<div class="col m6"><p class="review"> Relationship with Guardian : {!! $step2->relationship !!} </p></div>
		  		</div>
		  		<div class="col m12">
		  			<div class="col m6"><p class="review"> State : {!! $step2->state !!} </p></div>
		  			<div class="col m6"><p class="review"> District : {!! $step2->district !!} </p></div>
		  			<div class="col m6"><p class="review"> Post Office : {!! $step2->po !!} </p></div>
		  			<div class="col m6"><p class="review"> PIN : {!! $step2->pin !!} </p></div>
		  			<div class="col m6"><p class="review"> Village/Town : {!! $step2->village !!} </p></div>
		  			<div class="col m6"><p class="review"> Address Line : {!! $step2->address_line !!} </p></div>
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
