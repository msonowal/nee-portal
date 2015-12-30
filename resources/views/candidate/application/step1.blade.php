@extends('candidate.plane')
@section('body')
	<div class="card-panel hoverable">
		<div class="col s6 offset-s3">
		<h5>Examination Details</h5>
		  {!! form_start($form) !!}
		    <div class="row">
		        <div class="col m12">
							{!! form_until($form, 'reservation_code') !!}
							<div class="col m12">
							{!! form_row($form->save) !!}
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
								$reservation_code.empty().html('');
                $("<option>").val('').text('--Select Reservation Code--').appendTo($reservation_code);
                $.each(msg, function(key, value) {
                    $("<option>").val(value.reservation_code).text(value.reservation_code).appendTo($reservation_code);
                });
								//$reservation_code.material_select();
								$reservation_code.material_select('update');
								$reservation_code.closest('.input-field').children('span.caret').remove();
                return true;
            });
        }else
            $reservation_code.empty();
    }

		function getAlliedBranch(branchElement, alliedBranchElement){
        var url = '{!! route('allied_branch.by.branch_id') !!}';
        var branch_id = $(branchElement).val();
        $alliedBranch = $(alliedBranchElement);
        alliedBranchElement = typeof alliedBranchElement !== 'undefined' ? alliedBranchElement : '';
        if(branch_id!=''){
            $.ajax({ url: url, type: 'GET', data: { branch_id: branch_id } }).done(function( msg ) {
                $alliedBranch.empty();
								$alliedBranch.empty().html('');
                $("<option>").val('').text('-- Select Allied Branch --').appendTo($alliedBranch);
                $.each(msg, function(key, value) {
                    $("<option>").val(value.id).text(value.allied_branch).appendTo($alliedBranch);
                });
								//$reservation_code.material_select();
								$alliedBranch.material_select('update');
								//$alliedBranch.closest('.input-field').children('span.caret').remove();
                return true;
            });
        }else
            $alliedBranch.empty();
    }
</script>
@stop

@section('page_script')
    $('#quota').change(function(e){ getReservationCode(this, $('#reservation_code')); });
		$('#branch_id').change(function(e){ getAlliedBranch(this, $('#allied_branch_id')); });
@stop
