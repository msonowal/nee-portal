@extends('candidate.plane')
@section('body')
<style type="text/css">
        #exams, #exams li { list-style: none;}
        #exams {padding: 0 0 0 15px; margin-left: 20px;}
        #exams li { margin-bottom: 5px; list-style: upper-roman; font-size: 20px;}
        .modal-body p{ font-size: 20px; }
</style>
<div class="card-panel hoverable">
    <div class="col s6 offset-s3">
     <div class="row">
        <div class="input-field col m12">
        @if($exams->count())
	    	<ul id="exams">
		    	@foreach($exams as $e)
		    		<li>   
                    	<a class="btn tooltipped" data-position="right" data-delay="50" data-tooltip="Click here to Online Application Process" href="{!! route('candidate.application.step1') !!}" data-id="{!! $e->id !!}" data-name="{!! $e->exam_name !!}"  data-target='#processModal' data-toggle='modal' class="process-now" style=" color: #fff;">
                    		{!! $e->exam_name !!} <i class="material-icons right"> send </i>
                    	</a>
                    </li>
		    	@endforeach
	    	</ul>
	    @else
	    	Not Applied yet. <a href="{!! route('candidate.home') !!}">Apply Now</a>
	    @endif
        </div>        
      </div>
  </div>
</div>  
@stop