@extends('candidate.plane')
@section('body')
<style type="text/css">
        #exams, #exams li { list-style: none;}
        #exams {padding: 0 0 0 15px; margin-left: 20px;}
        #exams li { margin-bottom: 5px; list-style: upper-roman; font-size: 20px;}
        .modal-body p{ font-size: 20px; }
</style>
    <div class="card-panel hoverable white darken-1" style="padding:5px 10px;">
       <p class="white-text">
          <h6><strong>List of applications that you have applied</strong></h6>
       </p>
    </div>
<div class="card-panel hoverable">
    <div class="col s6 offset-s3">
     <div class="row">
        <div class="collection col m12">
        @if($exams->count())
	    	<ul id="exams">
		    	@foreach($exams as $e)
		    		<li>   
                    	<a class="collection-item active tooltipped modal-trigger proceed" data-position="right" data-delay="50" data-tooltip="Click here to Online Application Process" href="#modal1" data-id="{!! $e->id !!}" data-name="{!! $e->exam_name !!}">
                    		{!! $e->exam_name !!} --> {!! $e->description !!} 
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

<div id="modal1" class="modal">
    {!! Form::open(array('route'=>'candidate.proceed')) !!}
    <div class="modal-content">
      <!-- Model Content -->
    </div>
    <div class="modal-footer">
      {!! Form::submit('Proceed', array('name'=>'proceed', 'class'=>'btn success')) !!}
      <a href="#!" class="modal-action modal-close waves-effect waves-red btn-flat ">CANCEL</a>
    </div>
    {!! Form::close() !!}
</div>
@stop

@section('script')
    @parent
    <script type="text/javascript">
            $('.proceed').click(function() {
                var me = $(this);
                var info_id = me.attr('data-id');
                var exam_name = me.attr('data-name');
                $('.modal-content').html('<input type="hidden" name="candidate_info_id" value="'+info_id+'" /> <p>Proceed to Online Application Process for <b style="color: #A81642">'+exam_name+'</b></p>');
            });
    </script>
@stop