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
                 ?>      
                {!! Form::select('exam_id', $exam_id, $s_exam, array('class'=>'form-control')) !!}
            </div>
            <div class="form-group col-sm-2">
                {!! Form::select('c_pref1', $c_pref1, $s_centre_pref1, array('id'=>'c_pref1', 'class'=>'form-control')) !!}
            </div>
            <div class="form-group col-sm-2">
                {!! Form::select('c_pref2', $c_pref2, $s_centre_pref2, array('id'=>'c_pref2', 'class'=>'form-control')) !!}
            </div>
            <div class="form-group col-sm-3">
            	{!! Form::text('pin', $s_pin, array('class'=>'form-control search-box', 'autocomplete'=>'off', 'placeholder'=>'PIN (optional)')) !!}
            </div>
            <div class="form-group col-sm-3">    
                {!! Form::submit('Submit', array('class'=>'btn btn-success')) !!}
			</div>
			
			{!! Form::close() !!}
		</div>
			<div class="form-group col-sm-12">
				<a href="{{ route('generate.excel.report') }}" class="btn btn-info genrate"><i class="fa fa-file-text-o"></i> Generate Report</a>
			</div>
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
					<th>Registration Date</th>
					<th>Transaction Type</th>
					<th>Order No.</th>
					<th>View</th>

				</tr>
			</thead>
			<tbody>
			<?php $i=($paginator-1)*($results->perPage())+1; ?>
			@foreach($results as $res)
				<tr>
					<td align="center">{{ $i }}</td>
					<td >{{ $res->exam_name }}</td>
					<td >{{ $res->name }}</td>
					<td >{{ $res->form_no }}</td>
					<td >{{ $res->mobile_no }}</td>
					<td >{{ $res->c_pref1 }}</td>
					<td >{{ $res->created_at->format('d-m-Y') }}</td>
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
		{!! $results->render() !!}
		@else
			<div class="alert alert-warning" style="text-align:center;">
				 No records found.
			</div>    		
    	@endif	
	</div>
</div>
@stop               
