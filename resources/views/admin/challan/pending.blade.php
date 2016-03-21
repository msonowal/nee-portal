@extends('admin.layouts.main')
@section('page_heading','Challan Pending')
@section('section')
	<div class="col-sm-12">
	@if($result)
		<div class="box-body table-responsive">
		<table class="table table-bordered table-striped">
			<thead>
				<tr>
					<th with="10%">SL No</th>	
					<th>Branch ID</th>
					<th>Branch Name</th>
					<th>Transaction Type</th>
					<th>Transaction ID</th>
					<th>Transaction Date</th>
					<th>Amount</th>
				</tr>
			</thead>
			<tbody>
			<?php $i=1; ?>
			@foreach($result as $res)
				<tr>
					<td align="center">{{ $i }}</td>
					<td align="center">{{ $res->branch_id }}</td>
					<td align="center">{{ $res->branch_name }}</td>
					<td align="center">{{ $res->trans_type }}</td>
					<td align="center">{{ $res->transaction_id }}</td>
					<td align="center">{{ $res->transaction_date }}</td>
					<td align="center">{{ $res->amount }}</td>
				</tr>
				<?php $i=$i+1; ?>
			@endforeach	
			</tbody>
		</table>
		</div>
		@else
			<div class="alert alert-warning" style="text-align:center;">
				 No records found.
			</div>    		
    	@endif	
	</div>
@stop