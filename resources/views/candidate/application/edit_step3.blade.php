@extends('candidate.plane')
@section('body')
<div class="card-panel hoverable white darken-1" style="padding:5px 10px;">
       <p class="white-text">
          <h6><strong>Edit Photo and Signature</strong></h6>
       </p>
</div>

<div class="card-panel hoverable">
	<div class="col s6 offset-s3">
	    <div class="row">
	    <div class="col m12">		
		  {!! Form::open(array('route' => 'candidate.application.editstep3', 'files' =>true)) !!}
		    <div class="file-field input-field">
		      <div class="btn waves-effect wave-light tooltipped" data-position="bottom" data-delay="50" data-tooltip="Click here add Photo" id="upload">
		        <span>Photo</span>
		        <input type="file" id="photo" name="photo">
		      </div>
		      <div class="file-path-wrapper center-align">
		        {!! Html::image($step3->getPhoto(), '', array('height' => '40px','width' => '40px')) !!}
		      </div>
		    </div>
		    <div class="file-field input-field">
		      <div class="btn waves-effect wave-light tooltipped" data-position="bottom" data-delay="50" data-tooltip="Click here add Signature" id="upload">
		        <span>Signature</span>
		        <input type="file" id="signature"  name="signature">
		      </div>
		      <div class="file-path-wrapper center-align">
		        {!! Html::image($step3->getSignature(), '', array('height' => '40px','width' => '70px')) !!}
		      </div>
		    </div>
		    <button class="btn waves-effect waves-light blue" style="float: right;" type="submit" id="save">Update
            	<i class="material-icons right"></i>
        	</button>
		  {!! Form::close() !!}
		 </div>
		</div>
	</div>
</div>
@stop
