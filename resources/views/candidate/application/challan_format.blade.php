@extends('candidate.plane')
@section('body')
<h5>Payment Options</h5>
<div class="card-panel hoverable">
    <div class="col s6 offset-s3">
      <div class="row">
        <div class="col s12">
          <div class="input-field col m12">
          		<a class="collection-item active tooltipped" data-position="bottom" data-delay="50" data-tooltip="Click here to generate Challan Copy" href="{!! route('candidate.application.challan_format') !!}">
          		Genarate Challan
          		</a>
          </div>
        </div>
      </div>
    </div>
</div>
@stop
