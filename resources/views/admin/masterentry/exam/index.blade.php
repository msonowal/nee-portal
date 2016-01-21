@extends('admin.layouts.main')
@section('page_heading','EXAMINATION LIST')
@section('sub_title') <a href="{!! URL::route('admin.masterentry.exam.create') !!}" class="btn btn-info btn-md"> Add New </a> @stop
@section('section')
	<div class="col-sm-12">
	@if($result->count())
		<div class="box-body table-responsive">
		<table class="table table-bordered table-striped">
			<thead>
				<tr>
					<th>EXAM NAME</th>
					<th>DESCRIPTION</th>
					<th>NORMAL PRICE</th>
					<th>SC/ST/PD PRICE</th>
					<th>START DATE</th>
					<th>ACTIVE</th>
					<th width="10%">ACTIONS</th>
				</tr>
			</thead>
			<tbody>
			@foreach($result as $res)
				<tr>
					<td>{{ $res->exam_name   }}</td>
					<td>{{ $res->description }}</td>
					<td>{{ $res->n_price     }}</td>
					<td>{{ $res->scst_price  }}</td>
					<td>{{ $res->start_date  }}</td>
					<td>{{ $res->active      }}</td>
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