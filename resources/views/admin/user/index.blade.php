@extends('admin.layouts.main')
@section('page_heading','User LIST')
@section('sub_title') <a href="{!! URL::route('admin.user.create') !!}" class="btn btn-info btn-md"> Add New </a> @stop
@section('section')
	<div class="col-sm-12">
	@if($result->count())
		<div class="box-body table-responsive">
		<table class="table table-bordered table-striped">
			<thead>
				<tr>
					<th>Name</th>
					<th>User Name</th>
					<th>Mobile No.</th>
					<th>Email</th>
					<th>ACTIVE</th>
					<th width="10%">ACTIONS</th>
				</tr>
			</thead>
			<tbody>
			@foreach($result as $res)
				<tr>
					<td>{{ $res->fullname }}</td>
					<td>{{ $res->username }}</td>
					<td>{{ $res->mobile_no }}</td>
					<td>{{ $res->email  }}</td>
					<td>{{ $res->active }}</td>
					<td>
						<a href="{!! URL::Route('admin.user.edit', array($res->id)) !!}", class="btn btn-info btn-md pull-left">
							<i class="fa fa-edit"></i>
						</a>
                        {!! Form::open(array('method'=>'DELETE', 'route'=>array('admin.user.destroy', $res->id))) !!}
                            <button type="submit" class="btn btn-danger btn-md pull-right">
                      				<i class="fa fa-trash"></i>
                  			</button>
                        {!! Form::close() !!}
					</td>
				</tr>
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