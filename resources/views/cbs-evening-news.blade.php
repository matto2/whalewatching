@extends('layouts.frontend')

@section('head')
<title>{{ pageTitle('CBS Evening News') }}</title>
@stop

@section('stylesheets')
@stop

@section('title')
@stop

@section('content')

					@include('includes.cbs-evening-news')
@stop

@section('scripts')
@append