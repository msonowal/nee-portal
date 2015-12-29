@extends('candidate.plane')
@section('body')
	<div class="card-panel hoverable">
		<div class="col s6 offset-s3">
		<h5>Edit Personal Details</h5>
		  {!! form_start($form) !!}
		    <div class="row">
		        <div class="col m12">
		        	<div class="input-field col m6">
          				{!! form_row($form->name) !!}
        			</div>
        			<div class="input-field col m6">
          				{!! form_row($form->father_name) !!}
        			</div>
        			<div class="input-field col m6">
          				{!! form_row($form->guardian_name) !!}
        			</div>
        			<div class="input-field col m6">
          				{!! form_row($form->gender) !!}
        			</div>
        			<div class="input-field col m6">
          				{!! form_row($form->nationality) !!}
        			</div>
        			<div class="input-field col m6">
          				{!! form_row($form->emp_status) !!}
        			</div>
        			<div class="input-field col m6">
          				{!! form_row($form->relationship) !!}
        			</div>
		        </div>		   
			<h5>Edit Address Details</h5>
              <div class="input-field col m6">
                  {!! form_row($form->state) !!}
              </div>
              <div class="input-field col m6">
                  {!! form_row($form->district) !!}
              </div>
              <div class="input-field col m6">
                  {!! form_row($form->po) !!}
              </div>
              <div class="input-field col m6">
                  {!! form_row($form->pin) !!}
              </div>
		        	<div class="input-field col m6">
          				{!! form_row($form->village) !!}
        			</div>
        			<div class="input-field col m6">
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
                $("<option>").val('').text('--Select District--').appendTo($district);
                $.each(msg, function(key, value) {
                    $("<option>").val(value.id).text(value.name).appendTo($district);
                });
                if(district_status){
                  $district.val('{!! $step2->district !!}');
                  district_status =false;
                }

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