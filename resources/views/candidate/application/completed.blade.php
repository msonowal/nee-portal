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
	  	<p>	Dear <strong>{{ $step2->name }}, </strong> 
		   	you have successfully applied for <strong>NEE {{ $year=Date('Y') }}</strong> for <strong>{{ $candidate_info->exam_id }}</strong>.
		   	You may Click <a target="_blank" href="{{ route('candidate.application.e_application') }}"> here </a> to download E-Application of your form.
		 	Please note that if you are selected for the programme you will have to carry a printout of this form, 
		    the original documents and a set of photo copies of the documents during the time of your admission.
		</p>
	  </div>
	</div>
</div>
@stop
