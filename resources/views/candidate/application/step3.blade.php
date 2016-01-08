@extends('candidate.plane')
@section('body')
<div class="card-panel hoverable white darken-1" style="padding:5px 10px;">
       <p class="white-text">
          <h6><strong>Upload a recent passport sized Photo and scanned Signature</strong></h6>
       </p>
</div>

<div class="card-panel hoverable">
<div class="row">
	  <div class="col m12">
		  {!! Form::open(array('route' => 'candidate.application.step3', 'files' =>true)) !!}

		    <div class="file-field input-field col s12 m12 l12">
		      <div class="btn waves-effect wave-light" id="upload">
		        <span>Photo</span>
		        <input type="file" id="photo" name="photo">
		      </div>
		      <div class="file-path-wrapper">
		        <input class="file-path validate" type="text">
		      </div>
          <img style="width:100px;height:120px;" id="photo_upload_preview" src="{{ asset('images/default.jpg') }}" alt="your passport image" />
		    </div>
		    <div class="file-field input-field col s12 m12 l12">
		      <div class="btn waves-effect wave-light" id="upload">
		        <span>Signature</span>
		        <input type="file" id="signature"  name="signature">
		      </div>
		      <div class="file-path-wrapper">
		        <input class="file-path validate" type="text">
		      </div>
          <img style="width:150px;height:50px;" id="signature_upload_preview" src="{{ asset('images/default.jpg') }}" alt="your signature image" />
		    </div>
		    <button class="btn waves-effect waves-light blue" style="float: right;" type="submit" id="save">
          Save &amp; Continue
            	<i class="material-icons right"></i>
        	</button>
		  {!! Form::close() !!}
		 </div>
		</div>
	</div>
@stop

@section('page_script')
$("#photo").change(function () { readURL(this, 'photo_upload_preview');});
$("#signature").change(function () { readURL(this, 'signature_upload_preview');});
$(document).on('click', '#save', function(e) {
      if($('#photo').val()==''){
        e.preventDefault();
        var msg = '<span>You must upload your photo.</span>';
        Materialize.toast(msg, 5000);
      }
      if($('#signature').val()==''){
        e.preventDefault();
        var msg = '<span>You must upload your signature.</span>';
        Materialize.toast(msg, 5000);
      }
});
@stop
