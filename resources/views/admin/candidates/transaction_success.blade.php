@extends('admin.layouts.main')
@section('page_heading','Success Transaction List')
@section('section')
  <div class="col-sm-12">
	<div class="box">
		<div class="box-header">
			<div class="form-group col-sm-3">
			{!! Form::open(array('route'=>'admin.search.transaction_success', 'id' => 'applicant_search_form', 'class'=>'form-horizontal')) !!}
				 <?php $type = [''=>'--Select--', 'form_no' => 'Form No', 'mobile_no' => 'Mobile No', 'order_info' => 'Order No', 'name' => 'Candidate Name'];
				       $s_type = (Input::has('type')) ? Input::get('type') : null;
                       $s_val = (Input::has('value')) ? Input::get('value') : null; 
                 ?>      
                {!! Form::select('type', $type, $s_type, array('class'=>'form-control', 'required')) !!}
            </div>
            <div class="form-group col-sm-3">
            	{!! Form::text('value', $s_val, array('class'=>'form-control search-box', 'autocomplete'=>'off')) !!}
            </div>
            <div class="form-group col-sm-3">    
                {!! Form::submit('Search', array('class'=>'btn btn-success')) !!}
			</div>
			<div class="form-group col-sm-3">
				<a href="{{ route('genrate.report.transaction_success') }}" class="btn btn-info"><i class="fa fa-file-text-o"></i> Generate Report</a>
			</div>
			{!! Form::close() !!}
		</div>
		<div class="box-body table-responsive col-sm-12">
		@if($result->count())
		<table class="table table-bordered table-striped">
			<thead>
				<tr>
					<th width="6%">SL No</th>	
					<th>Exam</th>
					<th>Name</th>
					<th>Form No</th>
					<th>Registration Date</th>
					<th>Transaction Type</th>
					<th>Order No.</th>
				</tr>
			</thead>
			<tbody>
			<?php $i=($paginator-1)*($result->perPage())+1; ?>
			@foreach($result as $res)
				<tr>
					<td align="center">{{ $i }}</td>
					<td >{{ $res->exam_name }}</td>
					<td >{{ $res->name }}</td>
					<td >{{ $res->form_no }}</td>
					<td >{{ $res->created_at->format('d-m-Y') }}</td>
					<td >{{ $res->trans_type }}</td>
					<td >{{ $res->order_info }}</td>
				</tr>
				<?php $i=$i+1; ?>
			@endforeach	
			</tbody>
		</table>
		</div>
		{!! $result->render() !!}
		@else
			<div class="alert alert-warning" style="text-align:center;">
				 No records found.
			</div>    		
    	@endif	
	</div>
  </div>		
@stop