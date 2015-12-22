@extends('student.plane')
@section('body')
@include('student.navbar_header')
<div class="container">
	<div class="card-panel hoverable">
		<div class="col s6 offset-s3">
		<h5>Examination Details</h5>
		  {!! form_start($form) !!}
		    <div class="row">
		        <div class="col m12">
		        	<div class="input-field col m6">
          				{!! form_row($form->quota) !!}
        			</div>
        			<div class="input-field col m6">
          				{!! form_row($form->c_pref1) !!}
        			</div>
              <div class="input-field col m6">
                  {!! form_row($form->c_pref2) !!}
              </div>
              <div class="input-field col m6">
                  {!! form_row($form->nerist_stud) !!}
              </div>
              <div class="input-field col m6">
                  {!! form_row($form->status) !!}
              </div>
              <div class="input-field col m6">
                  {!! form_row($form->admission_in) !!}
              </div>
              <div class="input-field col m6">
                  {!! form_row($form->voc_subject) !!}
              </div>
              <div class="input-field col m6">
                  {!! form_row($form->branch) !!}
              </div>
              <div class="input-field col m6">
                  {!! form_row($form->allied_branch) !!}
              </div>
              <div class="input-field col m6">
                  {!! form_row($form->reserv_code) !!}
              </div>
        			
		        </div>		   
			 </div>
		  {!! form_end($form) !!}		
		</div>
	</div>
</div>
@stop