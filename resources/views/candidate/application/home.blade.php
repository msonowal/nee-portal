@extends('candidate.plane')
@section('body')
<h5>Welcome to the NEE ONLINE APPLICATION PORTAL</h5>
<div class="card-panel hoverable">
    <div class="col s6 offset-s3">
     <div class="row">
        <div class="col m12">

        {!! form($form, ['id'=>'home_form']) !!}

        </div>
        <button type="submit" id="submit" class="btn waves-effect waves-light blue col s12">Apply</button>
     </div>
    </div>
</div>

  <div id="modal1" class="modal">
    <div class="modal-content">
      <p class="text-light-blue">Are you sure to Apply?
            Please note that once you click the Agree button, you cann't change your Eligibility for the selected Examination.
        </p>
    </div>
    <div class="modal-footer">
      <button id="agree_button" class="modal-action modal-close waves-effect waves-green btn blue">
      Agree
      </button>
      <a href="#" class="modal-action modal-close waves-effect waves-red btn-flat ">CANCEL</a>
    </div>
  </div>

@stop
@section('script')
<script type="text/javascript">
    function getExamList(qualificationElement, examElement){
        var url = '{!! route('exam.by.qualification') !!}';
        var qualification = $(qualificationElement).val();
        $exam = $(examElement);
        examElement = typeof examElement !== 'undefined' ? examElement : '';
        if(qualification!=''){
            $.ajax({ url: url, type: 'GET', data: { q_id: qualification } }).done(function( msg ) {
                $exam.empty();
                $("<option>").val('').text(' -- Choose Exam -- ').appendTo($exam);
                $.each(msg, function(key, value) {
                    $("<option>").val(value.id).text(value.exam_name).appendTo($exam);
                });
                $exam.material_select('update');
								$exam.closest('.input-field').children('span.caret').remove();
                return true;
            });
        }else
            $exam.empty();
    }
</script>
@stop

@section('page_script')

$(document).on('click', '#submit', function(e) {
    if($("#home_form").valid()){
        $('#modal1').openModal();
      }
});

$(document).on('click', '#agree_button', function(e) {
    $('#home_form').submit();
});


    $('#q_id').change(function(e){ getExamList(this, $('#exam_id')); });

    $("#home_form").validate({ });

    $('#home_form').submit(function(e) {

    /*
      if(!$("#home_form").valid()){
        return false;
      }
        e.preventDefault();
        return false;
    */
    });

@stop
