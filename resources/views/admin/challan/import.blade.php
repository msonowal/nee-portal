@extends('admin.layouts.main')
@section('page_heading','Challan')
@section('section')
	<div class="col-sm-12">
		<div class="row">
		{!! Form::open(array('route' => 'admin.challan.import', 'files' =>true)) !!}
			<div class="col-sm-6">

          		{!! Form::file('challan', '', ['class'=>'validate', 'required']) !!}
        	</div> 
            <div class="form-group">
            	<button type="submit" class="btn btn-default">Upload</button>
            </div>
         {!! Form::close() !!}   
		</div>
	</div>
	<div class="col-sm-12">
	@if($result->count())
		<div class="box-body table-responsive">
		<table class="table table-bordered table-striped">
			<thead>
				<tr>
					<th with="10%">SL No</th>	
					<th>Transaction ID</th>
					<th>Transaction Date</th>
				</tr>
			</thead>
			<tbody>
			<?php $i=($paginator-1)*($result->perPage())+1; ?>
			@foreach($result as $res)
				<tr>
					<td align="center">{{ $i }}</td>
					<td align="center">{{ $res->transaction_id }}</td>
					<td align="center">{{ $res->transaction_date }}</td>
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
@stop