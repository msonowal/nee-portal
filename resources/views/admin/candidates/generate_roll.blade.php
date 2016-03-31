@extends('admin.layouts.main')
@section('page_heading','Roll No. Generation')
@section('section')
  <div class="col-sm-12">
	<div class="box">
		<div class="box-header">
			<div class="form-group col-sm-2">
			{!! Form::open(array('route'=>'admin.search.candidate_list', 'id' => 'applicant_search_form', 'class'=>'form-horizontal')) !!}
				 <?php $exam_id = $exams;
				       $s_exam = (Input::has('exam_id')) ? Input::get('exam_id') : null;
				       $c_pref1 = $centre_pref1;
				       $s_centre_pref1 = (Input::has('c_pref1')) ? Input::get('c_pref1') : null;
				       $c_pref2 = $centre_pref2;
				       $s_centre_pref2 = (Input::has('c_pref2')) ? Input::get('c_pref2') : null;
				       $s_pin = (Input::has('pin')) ? Input::get('pin') : null;
				       $take = (Input::has('take')) ? Input::get('take') : null;
				       $paper_code = (Input::has('paper_code')) ? Input::get('paper_code') : null; 
                 ?>      
                {!! Form::select('exam_id', $exam_id, $s_exam, array('class'=>'form-control', 'required'=>'true')) !!}
            </div>
            <div class="form-group col-sm-2">
                {!! Form::select('c_pref1', $c_pref1, $s_centre_pref1, array('id'=>'c_pref1', 'class'=>'form-control')) !!}
            </div>
            <div class="form-group col-sm-2">
                {!! Form::select('c_pref2', $c_pref2, $s_centre_pref2, array('id'=>'c_pref2', 'class'=>'form-control')) !!}
            </div>
            <div class="form-group col-sm-2">
            	{!! Form::text('pin', $s_pin, array('class'=>'form-control search-box', 'autocomplete'=>'off', 'placeholder'=>'PIN (optional)')) !!}
            </div>
            <div class="form-group col-sm-2">
            	{!! Form::text('take', $take, array('class'=>'form-control search-box', 'autocomplete'=>'off', 'placeholder'=>'No. of take', 'required'=>'true')) !!}
            </div>
            <div class="form-group col-sm-2">
            	{!! Form::text('paper_code', $paper_code, array('class'=>'form-control search-box', 'autocomplete'=>'off', 'placeholder'=>'Paper code')) !!}
            </div>
            <div class="form-group col-sm-2">    
                {!! Form::submit('Submit', array('class'=>'btn btn-success')) !!}
			</div>
			
			{!! Form::close() !!}
		</div>
		@if(!empty($results) && $results->count())
			@if(Input::has('exam_id') || Input::has('c_pref1') || Input::has('c_pref2') || Input::has('pin') || Input::has('take'))
			
			<div class="form-group col-sm-3">
			{!! Form::open(array('route'=>'admin.roll_no.generate', 'id' => 'generate_roll_nos', 'class'=>'form-horizontal', 'method'=>'PUT')) !!}
				@if(Input::has('c_pref2'))
					{!! Form::hidden('c_pref2', Input::get('c_pref2')) !!}
				@else
					{!! Form::hidden('c_pref1', Input::get('c_pref1')) !!}
				@endif
					{!! Form::hidden('exam_id', Input::get('exam_id'))!!}
					{!! Form::hidden('pin', Input::get('pin'))!!}
					{!! Form::hidden('take', Input::get('take'))!!}
					{!! Form::hidden('paper_code', Input::get('paper_code'))!!}
			{!! Form::submit('Generate Roll Numbers', array('class'=>'btn btn-success')) !!}
			</div>
			<div class="form-group col-sm-3">
				<h4>Total: {{ count($total) }}</h4>
			</div>
			<div class="form-group col-sm-3">
				<h4>Displayed: {{ count($displayed) }}</h4>
			</div>
			<div class="form-group col-sm-3">
				<h4>Centre Capacity: {{ $centre_capacity }}</h4>
			</div>
			{!! Form::close() !!}
		   @endif	
		@endif	
		<div class="box-body table-responsive  col-sm-12">
		@if(!empty($results) && $results->count())
		<table class="table table-bordered table-striped">
			<thead>
				<tr>
					<th width="6%">SL No</th>	
					<th>Exam</th>
					<th>Name</th>
					<th>Form No.</th>
					<th>Mobile No.</th>
					<th>Centre Pref 1</th>
					<th>Centre Pref 2</th>
					<th>Pin</th>
					<th>Paper Code</th>
					<th>View</th>

				</tr>
			</thead>
			<tbody>
			<?php $i=1; ?>
			@foreach($results as $res)
				<tr>
					<td align="center">{{ $i }}</td>
					<td >{{ $res->exam_name }}</td>
					<td >{{ $res->name }}</td>
					<td >{{ $res->form_no }}</td>
					<td >{{ $res->mobile_no }}</td>
					<td >{{ $res->c_pref1 }}</td>
					<td >{{ $res->c_pref2 }}</td>
					<td >{{ $res->pin }}</td>
					<td >{{ $res->paper_code }}</td>
					<td >
						<a target="_blank" href="{!! URL::Route('admin.candidate.view_confirmation', array($res->info_id)) !!}", class="btn btn-info btn-md pull-left">
							<i class="fa fa-eye"></i>
						</a>
					</td>
				</tr>
				<?php $i=$i+1; ?>
			@endforeach	
			</tbody>
		</table>
		</div>
		@else
			<div class="alert alert-warning" style="text-align:center;">
				 Records not found.
			</div>    		
    	@endif	
	</div>
</div>
@stop               
