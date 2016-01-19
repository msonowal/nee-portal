@extends('admin.layouts.main')
@section('page_heading','ADD CENTRE')
@section('section')

<div class="col-sm-8">  
        <div class="box">
        	<div class="box-body table-responsive">
					<table class="table table-bordered table-striped">
					    <tr>
							<td>
								{!! form($form) !!}
							</td>
						</tr>
						
					</table>
			</div>
		</div>
	</div>
@stop