@extends('admin.layouts.main')
@section('page_heading','Challan Verification')
@section('section')
  <div class="col-sm-12">
	<div class="box">
		<div class="box-header">
			<div class="form-group col-sm-4">
			{!! Form::open(array('route'=>'admin.challan.verifications', 'id' => 'applicant_search_form', 'class'=>'form-horizontal')) !!}
				 <?php
				       $transaction_id = (Input::has('transaction_id')) ? Input::get('transaction_id') : null;
                       $transaction_date = (Input::has('transaction_date')) ? Input::get('transaction_date') : null; 
                 ?>
                {!! Form::text('transaction_id', $transaction_id, array('class'=>'form-control search-box', 'autocomplete'=>'off', 'placeholder'=>'Transaction Id')) !!}      
            </div>
            <div class="form-group col-sm-4">
                {!! Form::hidden('info_id', $info_id) !!}
            	{!! Form::text('transaction_date', $transaction_date, array('class'=>'form-control search-box', 'id'=>'transaction_date','autocomplete'=>'off', 'placeholder'=>'Date of transaction')) !!}
            </div>
            <div class="form-group col-sm-4">    
                {!! Form::submit('Submit', array('class'=>'btn btn-success')) !!}
			</div>
			{!! Form::close() !!}
		</div>
	</div>
</div>
@stop
