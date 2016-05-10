@extends('admin.layouts.main')
@section('page_heading','&emsp;Address List of Selected Candidates')
@section('section')
  <div class="col-sm-12">
	<div class="box">
		<div class="box-header">
			<div class="form-group col-sm-3">
			{!! Form::open(array('route'=>'admin.address.generate', 'id' => 'applicant_search_form', 'class'=>'form-horizontal', 'target'=>'_blank')) !!}
				 <?php $type = [''=>'--Select Exam--', '1' => 'NEE I', '2' => 'NEE II', '3' => 'NEE III'];
				       $s_type = (Input::has('type')) ? Input::get('type') : null;
                 ?>      
                {!! Form::select('type', $type, $s_type, array('class'=>'form-control', 'required')) !!}
            </div>
            <div class="form-group col-sm-3">    
                {!! Form::submit('Generate', array('class'=>'btn btn-success')) !!}
			</div>
			<div class="form-group col-sm-3">
				<!--<a href="{{ route('generate.excel.report') }}" class="btn btn-info"><i class="fa fa-file-text-o"></i> Generate Report</a>-->
			</div>
			{!! Form::close() !!}
		</div>
	</div>
</div>
@stop