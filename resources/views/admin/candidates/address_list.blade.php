@extends('admin.layouts.main')
@section('page_heading','&emsp;Address Label of Selected Candidates')
@section('section')
  <div class="col-sm-12">
	<div class="box">
		<div class="box-header">
			<div class="form-group col-sm-3">
			{!! Form::open(array('route'=>'admin.address.generate', 'id' => 'applicant_search_form', 'class'=>'form-horizontal', 'target'=>'_blank')) !!}
				 <?php $exam = [''=>'--Select Exam--', 'neei' => 'NEE I', 'neeii_pcb' => 'NEE II Forestry', 'neeii_pcm_voc' => 'NEE II PCM & VOC', 'neeiii' => 'NEE III'];
				       $s_exam = (Input::has('exam')) ? Input::get('exam') : null;
				       $type = [''=>'--Select--', 'LIST OF SELECTED CANDIDATES' => 'ADDRESS FOR SELECTED CANDIDATES', 'LIST OF WAIT LISTED CANDIDATES' => 'ADDRESS FOR WAIT LISTED CANDIDATES', 'LIST OF WAIT LISTED CANDIDATES (EXTENDED)' => 'ADDRESS FOR WAIT LISTED CANDIDATES (EXTENDED)'];
				       $s_type = (Input::has('type')) ? Input::get('type') : null;
				       $result_type = [''=>'--Select--', 'PD'=>'PD', 'PRC'=>'PRC', 'ALL INDIA' => 'ALL INDIA', 'ARUNACHAL PRADESH' => 'ARUNACHAL PRADESH', 'ASSAM' => 'ASSAM', 'MEGHALAYA' => 'MEGHALAYA', 'MIZORAM'=>'MIZORAM', 'TRIPURA'=>'TRIPURA', 'NAGALAND'=>'NAGALAND', 'MANIPUR'=>'MANIPUR', 'SIKKIM'=>'SIKKIM', 'FLOATING' =>'FLOATING' ];
                 	   $s_result_type = (Input::has('result_type')) ? Input::get('result_type') : null;
                 ?>      
                {!! Form::select('exam', $exam, $s_exam, array('class'=>'form-control', 'required')) !!}
            </div>
            <div class="form-group col-sm-3">    
                {!! Form::select('result_type', $result_type, $s_result_type, array('class'=>'form-control')) !!}
			</div>
			<div class="form-group col-sm-3">    
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