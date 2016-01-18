@extends('admin.layouts.dashboard')
@section('page_heading','Submited NEE II Form List')
@section('section')
  <div class="col-sm-12">
	@if($result->count())
	<div class="box">
		<div class="box-header">
			<div class="form-group">
					<a href="{{ route('genrate.report.all') }}" class="btn btn-info"><i class="fa fa-file-text-o"></i> Generate Report</a>
			</div>
		</div>
		<div class="box-body table-responsive">
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
					<th>View</th>

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
		{!! $result->render() !!}
		@else
			<div class="alert alert-warning" style="text-align:center;">
				 No records found.
			</div>    		
    	@endif	
	</div>
</div>
@stop