@extends('admin.layouts.main')
@section('page_heading','ALLIED BRANCH LIST')
@section('sub_title') <a href="{!! URL::route('admin.masterentry.alliedbranch.create') !!}" class="btn btn-info btn-md"> Add New </a> @stop
@section('section')
	<div class="col-sm-12">
	@if($result->count())
		<div class="box-body table-responsive">
		<table class="table table-bordered table-striped">
			<thead>
				<tr>
					<th width="6%">SL NO</th>
					<th>BRANCH NAME</th>
					<th>ALLIED BRANCH</th>
					<th width="10%">ACTIONS</th>
				</tr>
			</thead>
			<tbody>
			<?php $i=($paginator-1)*($result->perPage())+1; ?>
			@foreach($result as $res)
				<tr>
					<td align="center">{!! $i   !!}</td>
					<td>{!! $res->branch_id      !!}</td>
					<td>{!! $res->allied_branch  !!}</td>
					<td>
						<a href="{!! URL::Route('admin.masterentry.alliedbranch.edit', array($res->id)) !!}", class="btn btn-info btn-md pull-left">
							<i class="fa fa-edit"></i>
						</a>
                        {!! Form::open(array('method'=>'DELETE', 'route'=>array('admin.masterentry.alliedbranch.destroy', $res->id))) !!}
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