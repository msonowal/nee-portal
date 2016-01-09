@extends('candidate.plane')
@section('body')
<h5>Net Banking Payment</h5>
<div class="card-panel hoverable">
    <div class="col s6 offset-s3">
      <div class="row">
      {!! Form::open(['url' => $url, 'class'=>'col s12', 'id'=>'netbanking_form']) !!}
        <div class="col m6">
          <h6> sss </h6>
        </div>
      </div>
          {!! Form::hidden('msg', $msg) !!}
       {!! Form::close() !!}
      </div>
    </div>
</div>
@stop

@section('page_script')

$('#netbanking_form').submit();
@stop

