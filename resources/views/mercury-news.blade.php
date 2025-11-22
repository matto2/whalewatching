@extends('layouts.frontend')

@section('head')
<title>{{ pageTitle('Mercury News') }}</title>
@stop

@section('stylesheets')
@stop

@section('title')
@stop

@section('content')

					@include('includes.mercury-news')
@stop

@section('scripts')
@append