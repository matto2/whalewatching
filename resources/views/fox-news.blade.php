@extends('layouts.frontend')

@section('head')
<title>{{ pageTitle('Fox News') }}</title>
@stop

@section('stylesheets')
@stop

@section('title')
@stop

@section('content')

					@include('includes.fox-news')
@stop

@section('scripts')
@append