@extends('admin.layouts.main')
@section('page_heading','Search Submited Forms')
@section('section')
  <div class="col-sm-12">
	<div class="box">
		<div class="box-header">
			<div class="form-group col-sm-2">
			{!! Form::open(array('route'=>'admin.search.search_submitted', 'id' => 'applicant_search_form', 'class'=>'form-horizontal')) !!}
				 <?php $exam_id = $exams;
				       $s_exam = (Input::has('exam_id')) ? Input::get('exam_id') : null;
                 ?>      
                {!! Form::select('exam_id', $exam_id, $s_exam, array('class'=>'form-control')) !!}
            </div>
            <div class="form-group col-sm-2">
				 <?php $centre = $centre;
				       $s_centre = (Input::has('centre')) ? Input::get('centre') : null;
                 ?>      
                {!! Form::select('centre', $centre, $s_centre, array('id'=>'centre', 'class'=>'form-control')) !!}
            </div>
            <div class="form-group col-sm-3">
				 <?php $centre_location = $centre_location;
				       $s_centre_location = (Input::has('centre_location')) ? Input::get('centre_location') : null;
                 ?>      
                {!! Form::select('centre_location', $centre_location, $s_centre_location, array('id'=>'centre_location', 'class'=>'form-control')) !!}
            </div>
            <div class="form-group col-sm-2">
				 <?php $quota = $quota;
				       $s_quota = (Input::has('quota')) ? Input::get('quota') : null;
                 ?>      
                {!! Form::select('quota', $quota, $s_quota, array('class'=>'form-control')) !!}
            </div>
            <div class="form-group col-sm-3">    
                {!! Form::submit('Search', array('class'=>'btn btn-success')) !!}
			</div>
			
			{!! Form::close() !!}
		</div>
			<div class="form-group col-sm-12">
				<a href="{{ route('generate.excel.report') }}" class="btn btn-info genrate"><i class="fa fa-file-text-o"></i> Generate Report</a>
			</div>
		<div class="box-body table-responsive  col-sm-12">
		@if($results->count())
		<table class="table table-bordered table-striped">
			<thead>
				<tr>
					<th width="6%">SL No</th>	
					<th>Exam</th>
					<th>Name</th>
					<th>Form No.</th>
					<th>Mobile No.</th>
					<th>Centre Pref 1</th>
					<th>Registration Date</th>
					<th>Transaction Type</th>
					<th>Order No.</th>
					<th>View</th>

				</tr>
			</thead>
			<tbody>
			<?php $i=($paginator-1)*($results->perPage())+1; ?>
			@foreach($results as $res)
				<tr>
					<td align="center">{{ $i }}</td>
					<td >{{ $res->exam_name }}</td>
					<td >{{ $res->name }}</td>
					<td >{{ $res->form_no }}</td>
					<td >{{ $res->mobile_no }}</td>
					<td >{{ $res->c_pref1 }}</td>
					<td >{{ $res->created_at->format('d-m-Y') }}</td>
					<td >{{ $res->trans_type }}</td>
					<td >{{ $res->order_info }}</td>
					<td >
						<a target="_blank" href="{!! URL::Route('admin.candidate.view_confirmation', array($res->info_id)) !!}", class="btn btn-info btn-md pull-left">
							<i class="fa fa-eye"></i>
						</a>
					</td>
				</tr>
				<?php $i=$i+1; ?>
			@endforeach	
			</tbody>
		</table>
		</div>
		{!! $results->render() !!}
		@else
			<div class="alert alert-warning" style="text-align:center;">
				 No records found.
			</div>    		
    	@endif	
	</div>
</div>

<script type="text/javascript">
        function getCentreLocation(){
            var url = '{{ URL::route('centre.get.centre_location') }}';
            var centre = $('#centre').val();

            if(centre!=''){
                $.ajax( {
                    url: url,
                    type: 'GET',
                    data: { centre_code: centre }
                    }).done(function( msg ) {

                    $('#centre_location').empty();
                    $("<option>").val('').text('---Choose Centre Location---').appendTo('#centre_location');
                    $.each(msg, function(key, value) {
                    $("<option>").val(value.id).text(value.centre_location).appendTo('#centre_location');
                    });
                    return true;
                });
            }else{
                $('#centre_location').empty();
            }
       }
  $(document).ready(function() {
      $('#centre').change(function(e){ getCentreLocation(); }); 
    });  
</script>
@stop               
