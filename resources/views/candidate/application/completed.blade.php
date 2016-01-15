@extends('candidate.plane')
@section('body')
<div class="card-panel hoverable white darken-1" style="padding:5px 10px;">
       <p class="white-text">
          <h5>NEE {{date('Y')}} Online Form Submission Completed</h5>
       </p>
</div>
<div class="card-panel hoverable">
<div class="row">
	  <div class="col m12">
	  	<blockquote>
	  		Dear <strong>{{ $step2->name }}, </strong> 
		   	you have successfully applied for <strong>NEE {{ $year=Date('Y') }}</strong> for <strong>{{ $candidate_info->exam_id }}</strong>.
		   	You may click the following button to download Confirmation Page.
		 	Please note that if you are selected for the programme you will have to carry a printout of this form, 
		    the original documents and a set of photo copies of the documents during the time of your admission.
		</blockquote>
	  </div>
	  <div class="col m12">
			<a class="right btn blue waves-effect waves-light" target="_blank" href="{{ route('candidate.application.view_confirmation') }}">
			 &nbsp; Click to View 
			</a>
	  </div>
   </div>
</div>
@stop
