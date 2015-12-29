@extends('candidate.plane')
@section('body')
	<div class="card-panel hoverable">
		<div class="col s6 offset-s3">
		<h5>Edit Examination Details</h5>
		  {!! form_start($form) !!}
		    <div class="row">
		        <div class="col m12">

          				{!! form_row($form->quota) !!}

          				{!! form_row($form->c_pref1) !!}

                  {!! form_row($form->c_pref2) !!}

                  {!! form_row($form->dob) !!}

                  {!! form_row($form->nerist_stud) !!}

                  {!! form_row($form->admission_in) !!}

                  {!! form_row($form->voc_subject) !!}

                  {!! form_row($form->branch) !!}

                  {!! form_row($form->allied_branch) !!}

                  {!! form_row($form->reservation_code) !!}

		        </div>		   
			 </div>
		  {!! form_end($form) !!}		
		</div>
	</div>
@stop
@section('script')
<script type="text/javascript">
    var reservation_status = true; 
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
                if(reservation_status){
                  $reservation_code.val('{!! $step1->reservation_code !!}');
                  reservation_status =false;
                }
                
                return true;
            });
        }else
            $reservation_code.empty();
    }
</script>
@stop

@section('page_script')
    $('#quota').change(function(e){ getReservationCode(this, $('#reservation_code')); });

    $('#quota').trigger('change');

@stop