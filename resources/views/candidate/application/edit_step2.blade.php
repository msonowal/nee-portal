@extends('candidate.plane')
@section('body')
	<div class="card-panel hoverable">
		<div class="col s6 offset-s3">
		<h5>Edit Personal Details</h5>
		  {!! form_start($form) !!}
		    <div class="row">

          				{!! form_row($form->name) !!}

          				{!! form_row($form->father_name) !!}
        			
          				{!! form_row($form->guardian_name) !!}
        			
          				{!! form_row($form->gender) !!}
        			
          				{!! form_row($form->nationality) !!}
        			
          				{!! form_row($form->emp_status) !!}
        			
          				{!! form_row($form->relationship) !!}
        					   
			            <h5>Edit Address Details</h5>
              
                  {!! form_row($form->state) !!}
              
                  {!! form_row($form->district) !!}
              
                  {!! form_row($form->po) !!}
             
                  {!! form_row($form->pin) !!}
              
          				{!! form_row($form->village) !!}
        			
          				{!! form_row($form->address_line) !!}
        		</div>
			</div>
		  {!! form_end($form) !!}		
		</div>
	</div>
@stop
@section('script')
<script type="text/javascript">
  var district_status =true;
    function getDistrictList(stateElement, districtElement){
        var url = '{!! route('district.by.state') !!}';
        var state = $(stateElement).val();
        $district = $(districtElement);
        districtElement = typeof districtElement !== 'undefined' ? districtElement : '';
        if(state!=''){
            $.ajax({ url: url, type: 'GET', data: { state_id: state } }).done(function( msg ) {
                $district.empty();
                $district.empty().html('');
                $("<option>").val('').text('--Select District--').appendTo($district);
                $.each(msg, function(key, value) {
                    $("<option>").val(value.id).text(value.name).appendTo($district);
                });
                if(district_status){
                  $district.val('{!! $step2->district !!}');
                  district_status =false;
                }

                $district.material_select('update');
                $district.closest('.input-field').children('span.caret').remove();
                return true;
            });
        }else
            $district.empty();
    }
</script>
@stop

@section('page_script')
    $('#state').change(function(e){ getDistrictList(this, $('#district')); });

    $('#state').trigger('change');
@stop