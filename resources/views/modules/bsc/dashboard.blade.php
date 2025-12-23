@extends('layouts.dashboard')
@include('modules.bsc.layout.app')
@section('title', 'Dashboard')

@section('content_header')

@stop

@section('content')
    
    <p>Welcome to this beautiful admin panel.</p>
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
@stop