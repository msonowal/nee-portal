@extends('admin.layouts.main')
@section('page_heading','Roll No. List')
@section('section')
  <div class="col-sm-12">
	<div class="box">
		<div class="box-header">
			<div class="form-group col-sm-2">
			{!! Form::open(array('route'=>'admin.candidate.roll_no_lists', 'id' => 'applicant_search_form', 'class'=>'form-horizontal')) !!}
				 <?php $exam_id = $exams;
				       $s_exam = (Input::has('exam_id')) ? Input::get('exam_id') : null;
				       $c_pref1 = $centre_pref1;
				       $s_centre_pref1 = (Input::has('c_pref1')) ? Input::get('c_pref1') : null;
				       $s_pin = (Input::has('pin')) ? Input::get('pin') : null;
				       $take = (Input::has('take')) ? Input::get('take') : null; 
                 ?>      
                {!! Form::select('exam_id', $exam_id, $s_exam, array('class'=>'form-control', 'required'=>'true')) !!}
            </div>
            <div class="form-group col-sm-2">
                {!! Form::select('c_pref1', $c_pref1, $s_centre_pref1, array('id'=>'c_pref1', 'class'=>'form-control')) !!}
            </div>
            <div class="form-group col-sm-2">
            	{!! Form::text('pin', $s_pin, array('class'=>'form-control search-box', 'autocomplete'=>'off', 'placeholder'=>'PIN (optional)')) !!}
            </div>
            <div class="form-group col-sm-2">
            	{!! Form::text('take', $take, array('class'=>'form-control search-box', 'autocomplete'=>'off', 'placeholder'=>'No. of take')) !!}
            </div>
            <div class="form-group col-sm-2">    
                {!! Form::submit('Submit', array('class'=>'btn btn-success')) !!}
			</div>
			
			{!! Form::close() !!}
		</div>
		@if(!empty($results) && $results->count())
			@if(Input::has('exam_id') || Input::has('c_pref1') || Input::has('c_pref2') || Input::has('pin') || Input::has('take'))
			
			<div class="form-group col-sm-6">
				<h4>Generated: {{ count($displayed) }}</h4>
			</div>
			<div class="form-group col-sm-6">
				<h4>Seat Remaining: {{ $centre_capacity }}</h4>
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
					<th>Roll No.</th>
					<th>Centre Pref 1</th>
					<th>Centre Pref 2</th>
					<th>Transaction Type</th>
					<th>Order No.</th>
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
					<td >{{ $res->rollno }}</td>
					<td >{{ $res->c_pref1 }}</td>
					<td >{{ $res->c_pref2 }}</td>
					<td >{{ $res->trans_type }}</td>
					<td >{{ $res->order_info }}</td>
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
