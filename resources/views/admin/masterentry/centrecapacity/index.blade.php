@extends('admin.layouts.main')
@section('page_heading','CENTRE CAPACITY LIST')
@section('sub_title') <a href="{!! URL::route('admin.masterentry.centrecapacity.create') !!}" class="btn btn-info btn-md"> Add New </a> @stop
@section('section')
	<div class="col-sm-12">
	@if($result->count())
		<div class="box-body table-responsive">
		<table class="table table-bordered table-striped">
			<thead>
				<tr>
					<th width="6%">SL NO</th>
					<th>CENTRE</th>
					<th>CENTRE LOCATION</th>
					<th>CENTRE CAPACITY</th>
					<th width="10%">ACTIONS</th>
				</tr>
			</thead>
			<tbody>
			<?php $i=($paginator-1)*($result->perPage())+1; ?>
			@foreach($result as $res)
				<tr>
					<td align="center">{!! $i      !!}</td>
					<td>{!! $res->centre_name        !!}</td>
					<td>{!! $res->centre_location  !!}</td>
					<td>{!! $res->centre_capacity  !!}</td>
					<td>
						<a href="{!! URL::Route('admin.masterentry.centrecapacity.edit', array($res->id)) !!}", class="btn btn-info btn-md pull-left">
							<i class="fa fa-edit"></i>
						</a>
                        {!! Form::open(array('method'=>'DELETE', 'route'=>array('admin.masterentry.centrecapacity.destroy', $res->id))) !!}
                            <button type="submit" class="btn btn-danger btn-md pull-right">
                      				<i class="fa fa-trash"></i>
                  			</button>
                        {!! Form::close() !!}
					</td>
				</tr>
			<?php $i++; ?>	
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