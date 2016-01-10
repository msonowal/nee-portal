@extends('candidate.plane')
@section('body')
	<div class="card-panel hoverable">
		<div class="col s6 offset-s3">
		<h5>Examination Details</h5>
		  {!! form_start($form, ['id'=>'step1_form']) !!}
		    <div class="row">
		        <div class="col s12 m12 l12">
			        {!! form_row($form->quota) !!}
			        <div class="input-field col s12 m6 l4">
			        {!! form_widget($form->reservation_code) !!}
			        {!! form_label($form->reservation_code) !!}
			        <a class="modal-trigger" href="#modal1" data-id=""> Click here to view reservation list</a><br/><br/>
			        </div>
					{!! form_until($form, 'dob') !!}
					<div class="col s12 m12 l12">
					{!! form_row($form->save) !!}
					</div>
		        </div>
			 </div>
		  {!! form_end($form) !!}
		</div>
	</div>
<div id="modal1" class="modal">
	<div class="modal-content"> Reservation Information List
		<div id="reservation_list"> Please select a Quota first </div>
	</div>
</div>
@stop
@section('script')
<script type="text/javascript">
var reservation_code_list = @if(old('reservation_code')=='') false @else true @endif;
    function getReservationCode(quotaElement, reservationElement){
        var url = '{!! route('reservation_code.by.quota') !!}';
        var quota = $(quotaElement).val();
        $reservation_code = $(reservationElement);
        reservationElement = typeof reservationElement !== 'undefined' ? reservationElement : '';
        if(quota!=''){
            $.ajax({ url: url, type: 'GET', data: { quota: quota } }).done(function( msg ) {
            	$('#reservation_code-error').remove();
                $reservation_code.empty();
				$reservation_code.empty().html('');
				var list = '<table class="bordered"><tr><th style="width:145px;">Quota</th><th style="width:137px;">Reservation Code</th><th>Description</th></tr>';
                $("<option>").val('').text(' -- Choose Reservation Code -- ').appendTo($reservation_code);
				$.each(msg, function(key, value) {
                	$("<option>").val(value.reservation_code).attr("data-status", "active").text(value.reservation_code).appendTo($reservation_code);
					list += "<tr><td>" + value.quota.name + '</td><td><a href="#" class="reservation_list_code" data-code="'+ value.reservation_code +'">' + value.reservation_code +'</a></td><td>' + value.description + '</td></tr>';
                });
				list+='</table>';
				$('#reservation_list').html(list);
				if(reservation_code_list){
				  $reservation_code.val('{{ old('reservation_code') }}');
				  reservation_code_list = false;
				}
				$reservation_code.material_select('update');
				$reservation_code.closest('.input-field').children('span.caret').remove();
                return true;
            });
        }else
            $reservation_code.empty();
    }

		function getReservationStatus(code) {
			var url = '{!! route('reservation_code.get.status') !!}';

			if(code!=''){
					$.ajax({ url: url, type: 'GET', data: { reservation_code: code } }).done(function( msg ) {

						if(msg.status == 'inactive'){
							Materialize.toast('No seats available for code: '+code+ ' <br/>Please choose an alternative code from the list', 10000);
							$reservation_code.empty();
							$reservation_code.empty().html('');
								var list = '<table class="bordered"><tr><th style="width:145px;">Quota</th><th style="width:137px;">Reservation Code</th><th>Description</th></tr>';
								$("<option>").val('').text(' -- Choose an Alternate Reservation Code -- ').appendTo($reservation_code);
								$.each(msg.alt_codes, function(key, value) {
										$("<option>").val(value.reservation_code).text(value.reservation_code).appendTo($reservation_code);
										list += "<tr><td>" + value.quota.name + '</td><td><a href="#" class="reservation_list_code" data-code="'+ value.reservation_code +'">' + value.reservation_code +'</a></td><td>' + value.description + '</td></tr>';
								});

								$('#reservation_list').html(list);
								$reservation_code.material_select('update');
								$reservation_code.closest('.input-field').children('span.caret').remove();
								return true;
						}
					});
			}
		}
var allied_branch_status = @if(old('allied_branch')=='') false @else true @endif;
		function getAlliedBranch(branchElement, alliedBranchElement){
        var url = '{!! route('allied_branch.by.branch_id') !!}';
        var branch_id = $(branchElement).val();
        $alliedBranch = $(alliedBranchElement);
        alliedBranchElement = typeof alliedBranchElement !== 'undefined' ? alliedBranchElement : '';
        if(branch_id!=''){
            $.ajax({ url: url, type: 'GET', data: { branch_id: branch_id } }).done(function( msg ) {
            	$('#allied_branch_id-error').remove();
                $alliedBranch.empty();
				$alliedBranch.empty().html('');
                $("<option>").val('').text('-- Choose Allied Branch --').appendTo($alliedBranch);
                $.each(msg, function(key, value) {
                    $("<option>").val(value.id).text(value.allied_branch).appendTo($alliedBranch);
                });

                if(allied_branch_status){
				  $alliedBranch.val('{{ old('allied_branch') }}');
				  allied_branch_status = false;
				}
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
	$('#reservation_code').change(function(e) { getReservationStatus($('#reservation_code').val()); });
	$('body').on('click', 'a.reservation_list_code', function(e){ e.preventDefault(); $('#reservation_code').val($(this).attr('data-code')); $('#modal1').closeModal(); $('#reservation_code').material_select('update'); $('#reservation_code').trigger('change'); });

    $("#step1_form").validate({
      rules: {
        quota: {
          required: true,
        }
      }
    });
	$('#step1_form').submit(function(e) {  });
	$('#quota').trigger('change');
	$('#branch_id').trigger('change');
	$('.pref').on('change', function() {
        var me = $(this);
        if(me.val()!=''){
        	var except = me.attr('id');
	        $('.pref').each(function(key, element ) {
	            var choose = $(this);
	            var current = $(this).attr('id');
	            if( current != except) {

	                if(choose.val() == me.val()) {
	                    $(me).val('');
	                    $(me).material_select('update');
	                    showError('Exam centre preference already selected<br/>Please choose a different option');
	                    return false;
	                }
	            }
	        });
	    }
    });
@stop
