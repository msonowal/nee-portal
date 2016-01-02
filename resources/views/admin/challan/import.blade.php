@extends('admin.layouts.dashboard')
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
					<th>SL No</th>	
					<th>Transaction ID</th>
					<th>Transaction Date</th>
					<th width="10%">ACTIONS</th>
				</tr>
			</thead>
			<tbody>
			<?php $i=($paginator-1)*($result->perPage())+1; ?>
			@foreach($result as $res)
				<tr>
					<td>{{ $i }}</td>
					<td>{{ $res->transaction_id }}</td>
					<td>{{ $res->transaction_date }}</td>
					<td>
						<a href="{!! URL::Route('admin.masterentry.exam.edit', array($res->id)) !!}", class="btn btn-info btn-md pull-left">
							<i class="fa fa-edit"></i>
						</a>
                        {!! Form::open(array('method'=>'DELETE', 'route'=>array('admin.masterentry.exam.destroy', $res->id))) !!}
                            <button type="submit" class="btn btn-danger btn-md pull-right">
                      				<i class="fa fa-trash"></i>
                  			</button>
                        {!! Form::close() !!}
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
@stop