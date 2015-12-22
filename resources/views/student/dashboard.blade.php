@extends('student.plane')
@section('body')
@include('student.navbar_header')
<h4><a href="{!! URL::route('student.application') !!}">Proceed</a></h4>
@stop