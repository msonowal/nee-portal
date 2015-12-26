@extends('candidate.plane')
@section('body')
	<div class="card-panel hoverable">
		<div class="col s6 offset-s3">
		<h5>Examination Details</h5>
		  {!! form_start($form) !!}
		    <div class="row">
		        <div class="col m12">
		        	<div class="input-field col m6">
          				{!! form_row($form->quota) !!}
        			</div>
        			<div class="input-field col m6">
          				{!! form_row($form->c_pref1) !!}
        			</div>
              <div class="input-field col m6">
                  {!! form_row($form->c_pref2) !!}
              </div>
              <div class="input-field col m6">
                  {!! form_row($form->dob) !!}
              </div>
              <div class="input-field col m6">
                  {!! form_row($form->nerist_stud) !!}
              </div>
              <div class="input-field col m6">
                  {!! form_row($form->status) !!}
              </div>
              <div class="input-field col m6">
                  {!! form_row($form->admission_in) !!}
              </div>
              <div class="input-field col m6">
                  {!! form_row($form->voc_subject) !!}
              </div>
              <div class="input-field col m6">
                  {!! form_row($form->branch) !!}
              </div>
              <div class="input-field col m6">
                  {!! form_row($form->allied_branch) !!}
              </div>
              <div class="input-field col m12">
                  {!! form_row($form->reservation_code) !!}
              </div>        			
		        </div>		   
			 </div>
		  {!! form_end($form) !!}		
		</div>
	</div>
@stop
@section('script')
<script type="text/javascript">
    function getReservationCode(quotaElement, reservationElement){
        var url = '{!! route('reservation_code.by.quota') !!}';
        var quota = $(quotaElement).val();
        $reservation_code = $(reservationElement);
        reservationElement = typeof reservationElement !== 'undefined' ? reservationElement : '';
        if(quota!=''){
            $.ajax({ url: url, type: 'GET', data: { quota: quota } }).done(function( msg ) {
                $reservation_code.empty();
                $("<option>").val('').text('--Select Reservation Code--').appendTo($reservation_code);
                $.each(msg, function(key, value) {
                    $("<option>").val(value.id).text(value.reservation_code).appendTo($reservation_code);
                });
                return true;
            });
        }else
            $reservation_code.empty();
    }
</script>
@stop

@section('page_script')
    $('#quota').change(function(e){ getReservationCode(this, $('#reservation_code')); });
@stop