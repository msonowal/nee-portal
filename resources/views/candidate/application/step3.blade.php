@extends('candidate.plane')
@section('body')
<div class="card-panel hoverable white darken-1" style="padding:5px 10px;">
       <p class="white-text">
          <h6><strong>Upload Photo and Signature</strong></h6>
       </p>
</div>

<div class="card-panel hoverable">
	<div class="col s6 offset-s3">
	    <div class="row">
	    <div class="col m12">		
		  {!! Form::open(array('route' => 'candidate.application.step3', 'files' =>true)) !!}
		    <div class="file-field input-field">
		      <div class="btn waves-effect wave-light" id="upload" onclick="$('#photo').click();">
		        <span>Photo</span>
		        <input type="file" id="photo" name="photo">
		      </div>
		      <div class="file-path-wrapper">
		        <input class="file-path validate" type="text">
		      </div>
		    </div>
		    <div class="file-field input-field">
		      <div class="btn waves-effect wave-light" id="upload" onclick="$('#signature').click();">
		        <span>Signature</span>
		        <input type="file" id="signature"  name="signature">
		      </div>
		      <div class="file-path-wrapper">
		        <input class="file-path validate" type="text">
		      </div>
		    </div>
		    <button class="btn waves-effect waves-light blue" style="float: right;" type="submit" id="save">Save
            	<i class="material-icons right"></i>
        	</button>
		  {!! Form::close() !!}
		 </div>
		</div>
	</div>
</div>
@stop
@section('script')
<script type="text/javascript">
	$(document).on('click', '#save', function(e) {
				if($('#photo').val()==''){
					e.preventDefault();
					var $msg = $('<span>You must upload your photo.</span>');
  					Materialize.toast($msg, 5000, 'rounded');
				}

				if($('#signature').val()==''){
					e.preventDefault();
					var $msg = $('<span>You must upload your signature.</span>');
  					Materialize.toast($msg, 5000, 'rounded');
				}
			});
</script>
@stop
