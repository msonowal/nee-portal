@extends('admin.layouts.main')
@section('page_heading','&emsp;NEE I Wait Listed(Extended)')
@section('section')
  <div class="col-sm-12">
	<div class="box">
		<div class="box-header">
			<div class="form-group col-sm-3">
			{!! Form::open(array('route'=>'admin.search.neei_wait_listed_extended', 'id' => 'applicant_search_form', 'class'=>'form-horizontal')) !!}
				 <?php $type = [''=>'--Select--', 'PD'=>'PD', 'PRC'=>'PRC', 'ALL INDIA' => 'ALL INDIA', 'ARUNACHAL PRADESH' => 'ARUNACHAL PRADESH', 'ASSAM' => 'ASSAM', 'MEGHALAYA' => 'MEGHALAYA', 'MIZORAM'=>'MIZORAM', 'TRIPURA'=>'TRIPURA', 'NAGALAND'=>'NAGALAND', 'MANIPUR'=>'MANIPUR', 'SIKKIM'=>'SIKKIM', 'FLOATING' =>'FLOATING' ];
				       $category = [''=>'--Select--', 'FLOATING'=>'FLOATING', 'GE/GEC/OTHERS'=>'GE/GEC/OTHERS', 'GEC & OTHERS' => 'GEC & OTHERS', 'GENERAL' => 'GENERAL', 'MBC/OBC' => 'MBC/OBC', 'NON MIZO PRC' => 'NON MIZO PRC', 'OBC'=>'OBC', 'PD'=>'PD', 'PRC'=>'PRC', 'SC'=>'SC', 'SGEC/CGEC/OTHERS'=>'SGEC/CGEC/OTHERS', 'ST' =>'ST', 'ST-BHUTIA/LEPTCHA'=>'ST-BHUTIA/LEPTCHA', 'ST-GARO'=>'ST-GARO', 'ST-KHASI/JYANTIA'=>'ST-KHASI/JYANTIA', 'ST-OTHER THAN BHUTIA/LEPTCHA'=>'ST-OTHER THAN BHUTIA/LEPTCHA', 'UNRESERVED'=>'UNRESERVED' ];
				       $s_type = (Input::has('type')) ? Input::get('type') : null;
                       $s_category = (Input::has('category')) ? Input::get('category') : null; 
                 ?>      
                {!! Form::select('type', $type, $s_type, array('class'=>'form-control', 'required')) !!}
            </div>
            <div class="form-group col-sm-3">
            	{!! Form::select('category', $category, $s_category, array('class'=>'form-control', 'required')) !!}
            </div>
            <div class="form-group col-sm-3">    
                {!! Form::submit('Search', array('class'=>'btn btn-success')) !!}
			</div>
			<div class="form-group col-sm-3">
				<!--<a href="{{ route('generate.excel.report') }}" class="btn btn-info"><i class="fa fa-file-text-o"></i> Generate Report</a>-->
			</div>
			{!! Form::close() !!}
		</div>
		<div class="box-body table-responsive  col-sm-12">
		@if(Input::get('type') && Input::get('category'))
		@if($result->count())
		<table class="table table-bordered table-striped">
			<thead>
				<tr>
					<th width="6%">SL No</th>	
					<th>Exam</th>
					<th>Name</th>
					<th>Form No.</th>
					<th>Roll No.</th>
					<th>Registration Date</th>
					<th>Transaction Type</th>
					<th>Order No.</th>
					<th width="6%">View</th>

				</tr>
			</thead>
			<tbody>
			<?php $i=1; ?>
			@foreach($result as $res)
				<tr>
					<td align="center">{{ $i }}</td>
					<td >{{ $res->exam_name }}</td>
					<td >{{ $res->name }}</td>
					<td >{{ $res->form_no }}</td>
					<td >{{ $res->rollno }}</td>
					<td >{{ $res->created_at->format('d-m-Y') }}</td>
					<td >{{ $res->trans_type }}</td>
					<td >{{ $res->order_info }}</td>
					<td >
						<a target="_blank" href="{!! URL::Route('admin.candidate.view_confirmation', array($res->info_id)) !!}", id="confirmation_page" data-toggle="tooltip" data-placement="left" data-original-title="Confirmation Page" class="btn btn-info btn-md">
							<i class="fa fa-eye"></i>
						</a>
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
    	@endif
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function() {
            $('#confirmation_page').tooltip();
            $('#admit_card').tooltip();
        });
</script>
@stop