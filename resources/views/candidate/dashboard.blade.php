@extends('candidate.plane')
@section('body')
@include('candidate.navbar')
<h4><a href="{!! URL::route('candidate.application') !!}">Proceed</a></h4>
@stop