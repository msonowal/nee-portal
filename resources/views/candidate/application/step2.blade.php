@extends('candidate.plane')
@section('body')
	<div class="card-panel hoverable">
		<div class="col s6 offset-s3">
		<h5>Personal Details</h5>
		  {!! form_start($form) !!}
		    <div class="row">
		        <div class="col m12">
		        	<div class="input-field col m6">
          				{!! form_row($form->name) !!}
        			</div>
        			<div class="input-field col m6">
          				{!! form_row($form->father_name) !!}
        			</div>
        			<div class="input-field col m6">
          				{!! form_row($form->guardian_name) !!}
        			</div>
        			<div class="input-field col m6">
          				{!! form_row($form->gender) !!}
        			</div>
        			<div class="input-field col m6">
          				{!! form_row($form->nationality) !!}
        			</div>
        			<div class="input-field col m6">
          				{!! form_row($form->emp_status) !!}
        			</div>
        			<div class="input-field col m6">
          				{!! form_row($form->relationship) !!}
        			</div>
		        </div>		   
			<h5>Address Details</h5>
		        	<div class="input-field col m6">
          				{!! form_row($form->village_town) !!}
        			</div>
        			<div class="input-field col m6">
          				{!! form_row($form->address_line) !!}
        			</div>
        			<div class="input-field col m6">
          				{!! form_row($form->post_office) !!}
        			</div>
        			<div class="input-field col m6">
          				{!! form_row($form->state) !!}
        			</div>
        			<div class="input-field col m6">
          				{!! form_row($form->district) !!}
        			</div>
        			<div class="input-field col m6">
          				{!! form_row($form->pin) !!}
        			</div>
			</div>
		  {!! form_end($form) !!}		
		</div>
	</div>
@stop