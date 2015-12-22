@extends('admin.layouts.dashboard')
@section('page_heading','BRANCH LIST')
@section('sub_title') <a href="{!! URL::route('admin.masterentry.branch.create') !!}" class="btn btn-info btn-md"> Add New </a> @stop
@section('section')
	<div class="col-sm-12">
	@if($result->count())
		<div class="box-body table-responsive">
		<table class="table table-bordered table-striped">
			<thead>
				<tr>
					<th width="6%">SL NO</th>
					<th>BRANCH NAME</th>
					<th width="10%">ACTIONS</th>
				</tr>
			</thead>
			<tbody>
			<?php $i=1; ?>
			@foreach($result as $res)
				<tr>
					<td align="center">{!! $i   !!}</td>
					<td>{!! $res->branch_name   !!}</td>
					<td>
						<a href="{!! URL::Route('admin.masterentry.branch.edit', array($res->id)) !!}", class="btn btn-info btn-md pull-left">
							<i class="fa fa-edit"></i>
						</a>
                        {!! Form::open(array('method'=>'DELETE', 'route'=>array('admin.masterentry.branch.destroy', $res->id))) !!}
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
		@else
			<div class="alert alert-warning" style="text-align:center;">
				 No records found.
			</div>    		
    	@endif	
	</div>
@stop