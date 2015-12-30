@extends('candidate.plane')
@section('body')
	<div class="card-panel hoverable">
		  {!! form_start($form) !!}
		    <div class="row">
					<div class="section">
						<h5>Personal Details</h5>

						{!! form_until($form, 'relationship') !!}
					</div>
					<div class="clearfix divider"></div>
						<div class="section">
							<h5>Address Details</h5>

						{!! form_until($form, 'address_line') !!}
			   </div>
				 <div class="clearfix divider"></div>
				 <div class="col s12 m12 l12" style="margin-top:20px;">
				 {!! form_row($form->save) !!}
				 </div>
			 </div>
		   {!! form_end($form) !!}
	</div>
@stop
@section('script')
<script type="text/javascript">
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
@stop
