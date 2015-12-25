@extends('candidate.plane')
@section('body')
<h5>Welcome to the NEE ONLINE APPLICATION PORTAL</h5>
<div class="card-panel hoverable">
    <div class="col s6 offset-s3">
     <div class="row">
        <div class="input-field col m12">
        {!! form_start($form) !!}

        	{!! form_rest($form) !!}

        {!! form_end($form) !!}
        </div>
     </div>
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
                $("<option>").val('').text('--Choose--').appendTo($exam);
                $.each(msg, function(key, value) {
                    $("<option>").val(value.id).text(value.name).appendTo($exam);
                });
                return true;
            });
        }else
            $exam.empty();
    }
</script>
@stop

@section('page_script')
    $('#q_id').change(function(e){ getExamList(this, $('#exam_id')); });
@stop